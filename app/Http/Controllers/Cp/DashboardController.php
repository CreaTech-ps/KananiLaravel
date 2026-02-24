<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use App\Models\StoreOrder;
use App\Models\StoreProduct;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = StoreProduct::count();
        $categoriesCount = StoreCategory::count();
        $ordersCount = StoreOrder::count();
        $pendingOrdersCount = StoreOrder::where('status', 'pending')->count();
        $totalRevenue = StoreOrder::whereIn('status', ['processing', 'completed'])->sum('total');

        $recentOrders = StoreOrder::latest()->take(5)->get();

        $stats = [
            'products' => $productsCount,
            'categories' => $categoriesCount,
            'orders' => $ordersCount,
            'pending_orders' => $pendingOrdersCount,
            'total_revenue' => $totalRevenue,
        ];

        return view('cp.dashboard', compact('stats', 'recentOrders'));
    }
}
