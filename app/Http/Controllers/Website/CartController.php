<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private const SESSION_KEY = 'store_cart';

    private function getCart(): array
    {
        return session(self::SESSION_KEY, []);
    }

    private function saveCart(array $cart): void
    {
        session([self::SESSION_KEY => $cart]);
        session()->save();
    }

    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:store_products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $productId = (int) $validated['product_id'];
        $quantity = (int) ($validated['quantity'] ?? 1);

        $product = StoreProduct::where('is_active', true)->find($productId);
        if (!$product) {
            return response()->json(['ok' => false, 'message' => __('ui.store_product_not_found')], 404);
        }

        $stock = $product->stock ?? 999;
        $cart = $this->getCart();
        $current = $cart[$productId] ?? 0;
        $newQty = min($current + $quantity, $stock);
        $cart[$productId] = $newQty;

        if ($newQty <= 0) {
            unset($cart[$productId]);
        }

        $this->saveCart($cart);
        $totalItems = array_sum($cart);

        return response()->json([
            'ok' => true,
            'count' => $totalItems,
            'quantity' => $newQty,
        ]);
    }

    public function count(): JsonResponse
    {
        $cart = $this->getCart();
        return response()->json(['count' => array_sum($cart)])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function items(): JsonResponse
    {
        return response()->json($this->buildCartItemsData())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    private function buildCartItemsData(): array
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return ['items' => [], 'count' => 0, 'total' => 0];
        }

        $productIds = array_map('intval', array_keys($cart));
        $products = StoreProduct::whereIn('id', $productIds)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $items = [];
        $subtotal = 0;
        $discountTotal = 0;
        foreach ($cart as $productId => $quantity) {
            $product = $products->get((int) $productId);
            if (!$product) {
                continue;
            }
            $price = (float) $product->price;
            $oldPrice = (float) ($product->old_price ?? $price);
            $discountPercent = (int) ($product->discount_percent ?? 0);
            $itemDiscount = 0;
            if ($oldPrice > $price && $discountPercent > 0) {
                $itemDiscount = ($oldPrice - $price) * $quantity;
            }
            $itemSubtotal = $price * $quantity;
            $subtotal += $itemSubtotal;
            $discountTotal += $itemDiscount;
            $slug = localized($product, 'slug') ?? $product->slug_ar ?? $product->id;
            $items[] = [
                'id' => $product->id,
                'name' => localized($product, 'name') ?? $product->name_ar ?? '',
                'slug' => $slug,
                'image' => $product->image_path ? asset('storage/' . $product->image_path) : null,
                'price' => $price,
                'old_price' => $oldPrice,
                'discount_percent' => $discountPercent,
                'quantity' => $quantity,
                'subtotal' => round($itemSubtotal, 2),
                'discount' => round($itemDiscount, 2),
            ];
        }

        $shippingCost = (float) (config('app.store.shipping_cost', 0) ?? 0);
        $total = $subtotal + $shippingCost;

        return [
            'items' => $items,
            'count' => array_sum($cart),
            'subtotal' => round($subtotal, 2),
            'discount_total' => round($discountTotal, 2),
            'shipping_cost' => round($shippingCost, 2),
            'total' => round($total, 2),
        ];
    }

    public function index()
    {
        $data = $this->buildCartItemsData();
        return view('store.cart', $data);
    }

    public function buyNow(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:store_products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $productId = (int) $validated['product_id'];
        $quantity = (int) ($validated['quantity'] ?? 1);

        $product = StoreProduct::where('is_active', true)->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', __('ui.store_product_not_found'));
        }

        $stock = $product->stock ?? 999;
        $qty = min($quantity, $stock);
        $this->saveCart([$productId => $qty]);

        return redirect()->route('store.checkout.complete');
    }

    public function checkout(Request $request)
    {
        return redirect()->route('store.checkout.complete');
    }

    public function completePurchase()
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('store.cart')->with('error', __('ui.store_cart_empty'));
        }

        $data = $this->buildCartItemsData();
        return view('store.complete-purchase', [
            'items' => $data['items'],
            'subtotal' => $data['subtotal'],
            'discount_total' => $data['discount_total'],
            'shipping_cost' => $data['shipping_cost'],
            'total' => $data['total'],
            'count' => $data['count'],
        ]);
    }

    public function completePurchaseSubmit(Request $request)
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('store.cart')->with('error', __('ui.store_cart_empty'));
        }

        $validated = $request->validate([
            'buyer_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:20'],
            'phone_prefix' => ['nullable', 'string', 'max:10'],
            'delivery_date' => ['required', 'date', 'after_or_equal:today'],
            'address' => ['required', 'string', 'max:500'],
            'same_receiver' => ['nullable'],
            'receiver_name' => ['nullable', 'string', 'max:255'],
            'receiver_phone' => ['nullable', 'string', 'max:20'],
            'receiver_phone_prefix' => ['nullable', 'string', 'max:10'],
        ], [], [
            'buyer_name' => __('ui.checkout_buyer_name') ?? 'الاسم',
            'phone' => __('ui.checkout_phone') ?? 'الهاتف',
            'delivery_date' => __('ui.checkout_delivery_date') ?? 'تاريخ التسليم',
            'address' => __('ui.checkout_address') ?? 'العنوان',
        ]);

        $data = $this->buildCartItemsData();
        $orderNumber = 'ORD-' . str_pad((string) random_int(10000, 99999), 5, '0', STR_PAD_LEFT);

        $normalizePhone = function ($prefix, $num) {
            $digits = preg_replace('/\D/', '', ($prefix ?? '') . ($num ?? ''));
            return $digits ? '+' . ltrim($digits, '0') : (($prefix ?? '') . ($num ?? ''));
        };
        $phoneFull = $normalizePhone($validated['phone_prefix'] ?? '', $validated['phone'] ?? '');
        $sameReceiver = !empty($validated['same_receiver']) || ($validated['same_receiver'] ?? false);
        $receiverName = $sameReceiver ? $validated['buyer_name'] : ($validated['receiver_name'] ?? '');
        $receiverPhone = $sameReceiver
            ? $phoneFull
            : $normalizePhone($validated['receiver_phone_prefix'] ?? '', $validated['receiver_phone'] ?? '');

        $order = StoreOrder::create([
            'order_number' => $orderNumber,
            'buyer_name' => $validated['buyer_name'],
            'phone' => $phoneFull,
            'address' => $validated['address'],
            'country' => $validated['country'],
            'delivery_date' => $validated['delivery_date'],
            'receiver_name' => $receiverName,
            'receiver_phone' => $receiverPhone,
            'subtotal' => $data['subtotal'],
            'discount_total' => $data['discount_total'],
            'shipping_cost' => $data['shipping_cost'],
            'total' => $data['total'],
            'items_data' => $data['items'],
        ]);

        session([
            'store_last_order' => [
                'order_number' => $orderNumber,
                'items' => $data['items'],
                'subtotal' => $data['subtotal'],
                'discount_total' => $data['discount_total'],
                'shipping_cost' => $data['shipping_cost'],
                'total' => $data['total'],
                'datetime' => now()->translatedFormat('d F Y - H:i'),
                'country' => $validated['country'],
                'delivery_date' => $validated['delivery_date'],
                'buyer_name' => $validated['buyer_name'],
                'phone' => $phoneFull,
                'address' => $validated['address'],
                'receiver_name' => $receiverName,
                'receiver_phone' => $receiverPhone,
            ],
        ]);
        session()->save();
        $this->saveCart([]);

        return redirect()->route('store.checkout.success', ['id' => $order->id]);
    }

    public function checkoutSuccess($id = null)
    {
        $order = null;
        if ($id) {
            $dbOrder = StoreOrder::find($id);
            if ($dbOrder) {
                $order = [
                    'order_number' => $dbOrder->order_number,
                    'items' => $dbOrder->items_data ?? [],
                    'subtotal' => (float) $dbOrder->subtotal,
                    'discount_total' => (float) $dbOrder->discount_total,
                    'shipping_cost' => (float) $dbOrder->shipping_cost,
                    'total' => (float) $dbOrder->total,
                    'datetime' => $dbOrder->created_at->translatedFormat('d F Y - H:i'),
                    'country' => $dbOrder->country,
                    'delivery_date' => $dbOrder->delivery_date?->format('Y-m-d'),
                    'buyer_name' => $dbOrder->buyer_name,
                    'phone' => $dbOrder->phone,
                    'address' => $dbOrder->address,
                    'receiver_name' => $dbOrder->receiver_name ?? $dbOrder->buyer_name,
                    'receiver_phone' => $dbOrder->receiver_phone ?? $dbOrder->phone,
                ];
            }
        }
        if (empty($order)) {
            $order = session('store_last_order', []);
        }
        if (empty($order)) {
            return redirect()->route('store.index');
        }

        session()->forget('store_last_order');
        session()->save();

        $store = config('app.store', []);
        $invoiceUrl = route('store.index') . '?order=' . ($order['order_number'] ?? '');

        return view('store.checkout-success', [
            'order' => $order,
            'orderNumber' => $order['order_number'] ?? 'ORD-00000',
            'items' => $order['items'] ?? [],
            'subtotal' => $order['subtotal'] ?? 0,
            'discountTotal' => $order['discount_total'] ?? 0,
            'shippingCost' => $order['shipping_cost'] ?? 0,
            'total' => $order['total'] ?? 0,
            'datetime' => $order['datetime'] ?? now()->translatedFormat('d F Y - H:i'),
            'store' => $store,
            'invoiceUrl' => $invoiceUrl,
        ]);
    }

    public function remove(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = $this->getCart();
        unset($cart[(int) $validated['product_id']]);
        $this->saveCart($cart);

        return response()->json(['ok' => true, 'count' => array_sum($cart)]);
    }
}
