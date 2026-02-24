<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use App\Models\StoreColor;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreProductController extends Controller
{
    public function index(Request $request)
    {
        $query = StoreProduct::with('category')->orderByDesc('created_at');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name_ar', 'like', "%{$q}%")
                    ->orWhere('name_en', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = StoreCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('cp.store.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $item = new StoreProduct();
        $item->is_active = true;
        $item->stock = 0;
        $item->price = 0;
        $categories = StoreCategory::where('is_active', true)->orderBy('sort_order')->get();
        $colors = StoreColor::orderBy('name_ar')->get();

        return view('cp.store.products.form', [
            'item' => $item,
            'title' => 'إضافة منتج',
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $imagePaths = $this->handleProductImages($request);
        if (empty($imagePaths)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'images_new' => ['يجب إضافة صورة واحدة على الأقل للمنتج.'],
            ]);
        }
        $validated['images'] = $imagePaths;
        $validated['image_path'] = $imagePaths[0];

        $validated['slug_ar'] = ($validated['slug_ar'] ?? null) ?: Str::slug($validated['name_ar']);
        $validated['slug_en'] = ($validated['slug_en'] ?? null) ?: Str::slug($validated['name_en'] ?? $validated['name_ar']);

        $product = StoreProduct::create($validated);

        $this->syncSizes($product, $request);
        $this->syncColors($product, $request);

        return redirect()->route('cp.store.products.index')->with('success', 'تم إضافة المنتج بنجاح.');
    }

    public function edit(StoreProduct $product)
    {
        $item = $product->load('sizes', 'colors');
        $categories = StoreCategory::where('is_active', true)->orderBy('sort_order')->get();
        $colors = StoreColor::orderBy('name_ar')->get();

        return view('cp.store.products.form', [
            'item' => $item,
            'title' => 'تعديل المنتج',
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    public function update(Request $request, StoreProduct $product)
    {
        $validated = $this->validateProduct($request, $product);

        $imagePaths = $this->handleProductImages($request, $product);
        if (empty($imagePaths)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'images_new' => ['يجب أن يحتوي المنتج على صورة واحدة على الأقل.'],
            ]);
        }
        // حذف الصور القديمة التي لم تعد مستخدمة
            $oldPaths = $product->image_paths ?? [];
            foreach ($oldPaths as $old) {
                if (!in_array($old, $imagePaths, true)) {
                    Storage::disk('public')->delete($old);
                }
            }
        $validated['images'] = $imagePaths;
        $validated['image_path'] = $imagePaths[0] ?? null;

        $validated['slug_ar'] = ($validated['slug_ar'] ?? null) ?: Str::slug($validated['name_ar']);
        $validated['slug_en'] = ($validated['slug_en'] ?? null) ?: Str::slug($validated['name_en'] ?? $validated['name_ar']);

        $product->update($validated);

        $this->syncSizes($product, $request);
        $this->syncColors($product, $request);

        return redirect()->route('cp.store.products.index')->with('success', 'تم تحديث المنتج بنجاح.');
    }

    public function destroy(Request $request, StoreProduct $product)
    {
        foreach ($product->image_paths as $path) {
            Storage::disk('public')->delete($path);
        }
        $product->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم حذف المنتج.']);
        }
        return redirect()->route('cp.store.products.index')->with('success', 'تم حذف المنتج.');
    }

    private function validateProduct(Request $request, ?StoreProduct $product = null): array
    {
        $rules = [
            'category_id' => ['nullable', 'exists:store_categories,id'],
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'slug_ar' => ['nullable', 'string', 'max:255'],
            'slug_en' => ['nullable', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'images_new' => ['nullable', 'array'],
            'images_new.*' => ['image', 'max:2048'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'sizes' => ['nullable', 'array'],
            'sizes.*' => ['nullable', 'string', 'max:100'],
            'color_ids' => ['nullable', 'array'],
            'color_ids.*' => ['exists:store_colors,id'],
        ];

        $validated = $request->validate($rules);

        $imagesKeep = $request->input('images_keep', []);
        $imagesNewCount = $request->hasFile('images_new') ? count(array_filter($request->file('images_new'))) : 0;
        $totalImages = (is_array($imagesKeep) ? count($imagesKeep) : 0) + $imagesNewCount;
        if ($totalImages > 4) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'images_new' => ['الحد الأقصى 4 صور للمنتج.'],
            ]);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['stock'] = (int) ($request->stock ?? 0);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);

        $oldPrice = (float) ($validated['old_price'] ?? 0);
        $discount = (int) ($validated['discount_percent'] ?? 0);
        $price = (float) ($validated['price'] ?? 0);

        if ($oldPrice > 0) {
            if ($discount > 0 && $discount <= 100) {
                $validated['price'] = round($oldPrice * (1 - $discount / 100), 2);
            } elseif ($price > 0 && $price < $oldPrice) {
                $validated['discount_percent'] = (int) round((($oldPrice - $price) / $oldPrice) * 100);
            }
        } else {
            $validated['old_price'] = null;
            $validated['discount_percent'] = 0;
        }

        return $validated;
    }

    private function handleProductImages(Request $request, ?StoreProduct $product = null): ?array
    {
        $existing = $request->input('images_keep', []);
        if (!is_array($existing)) {
            $existing = [];
        }

        $newPaths = [];
        $maxNew = 4 - count($existing);
        if ($maxNew > 0 && $request->hasFile('images_new')) {
            $files = array_slice(array_filter($request->file('images_new')), 0, $maxNew);
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $newPaths[] = $file->store('store/products', 'public');
                }
            }
        }

        $allPaths = array_values(array_merge($existing, $newPaths));
        $allPaths = array_unique($allPaths);
        $allPaths = array_slice($allPaths, 0, 4);

        if (empty($allPaths)) {
            return $product ? [] : null;
        }

        return $allPaths;
    }

    private function syncSizes(StoreProduct $product, Request $request): void
    {
        $product->sizes()->delete();
        $sizes = array_filter($request->input('sizes', []));
        foreach ($sizes as $size) {
            if (trim($size)) {
                $product->sizes()->create(['size_ar' => trim($size), 'size_en' => trim($size)]);
            }
        }
    }

    private function syncColors(StoreProduct $product, Request $request): void
    {
        $product->colors()->sync($request->input('color_ids', []));
    }
}
