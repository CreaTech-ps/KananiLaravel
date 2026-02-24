<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\StoreOrder;
use Illuminate\Http\Request;

class StoreOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = StoreOrder::orderByDesc('created_at');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('order_number', 'like', "%{$q}%")
                    ->orWhere('buyer_name', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('cp.store.orders.index', compact('orders'));
    }

    public function show(StoreOrder $order)
    {
        return view('cp.store.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, StoreOrder $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update([
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? $order->notes,
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }
}
