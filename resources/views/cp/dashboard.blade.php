@extends('cp.layout')

@section('title', 'لوحة التحكم')

@section('content')
<div class="space-y-8">
    {{-- بطاقات الإحصائيات --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        <a href="{{ route('cp.store.products.index') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-lg hover:border-primary/40 dark:hover:border-primary/50 transition-all duration-300">
            <div class="absolute top-0 left-0 w-20 h-20 bg-primary/5 dark:bg-primary/10 rounded-full -translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ number_format($stats['products']) }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">منتج</p>
                </div>
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">shopping_bag</span>
                </span>
            </div>
            <p class="mt-3 text-xs text-primary font-medium opacity-0 group-hover:opacity-100 transition-opacity">عرض المنتجات ←</p>
        </a>

        <a href="{{ route('cp.store.categories.index') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-lg hover:border-primary/40 dark:hover:border-primary/50 transition-all duration-300">
            <div class="absolute top-0 left-0 w-20 h-20 bg-primary/5 dark:bg-primary/10 rounded-full -translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ number_format($stats['categories']) }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">فئة</p>
                </div>
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">category</span>
                </span>
            </div>
            <p class="mt-3 text-xs text-primary font-medium opacity-0 group-hover:opacity-100 transition-opacity">إدارة الفئات ←</p>
        </a>

        <a href="{{ route('cp.store.orders.index') }}" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-lg hover:border-primary/40 dark:hover:border-primary/50 transition-all duration-300">
            <div class="absolute top-0 left-0 w-20 h-20 bg-primary/5 dark:bg-primary/10 rounded-full -translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ number_format($stats['orders']) }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">إجمالي الطلبات</p>
                </div>
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">receipt_long</span>
                </span>
            </div>
            <p class="mt-3 text-xs text-primary font-medium opacity-0 group-hover:opacity-100 transition-opacity">عرض الطلبات ←</p>
        </a>

        <a href="{{ route('cp.store.orders.index') }}?status=pending" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 border border-amber-200 dark:border-amber-800 p-6 shadow-sm hover:shadow-lg hover:border-amber-400 dark:hover:border-amber-600 transition-all duration-300">
            <div class="absolute top-0 left-0 w-20 h-20 bg-amber-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-start justify-between">
                <div>
                    <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mb-1">{{ number_format($stats['pending_orders']) }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">طلبات قيد الانتظار</p>
                </div>
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </span>
            </div>
            <p class="mt-3 text-xs text-amber-600 dark:text-amber-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity">متابعة الطلبات ←</p>
        </a>

        <div class="rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 border border-slate-200 dark:border-slate-600 p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mb-1">{{ number_format($stats['total_revenue'], 0) }} <span class="text-sm font-normal text-slate-500">ش.ج</span></p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">إيرادات مكتملة</p>
                </div>
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-slate-200/50 dark:bg-slate-600/50 text-slate-600 dark:text-slate-300">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </span>
            </div>
        </div>
    </section>

    {{-- الطلبات الأخيرة + إجراءات سريعة --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- آخر الطلبات --}}
        <section class="xl:col-span-2 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span>
                    آخر الطلبات
                </h3>
                <a href="{{ route('cp.store.orders.index') }}" class="text-sm text-primary font-medium hover:underline">عرض الكل</a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($recentOrders as $order)
                    <a href="{{ route('cp.store.orders.show', $order) }}" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div class="flex items-center gap-4 min-w-0">
                            <span class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-lg">receipt</span>
                            </span>
                            <div class="min-w-0">
                                <p class="font-medium text-slate-800 dark:text-white truncate">{{ $order->buyer_name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $order->order_number }} · {{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="font-bold text-slate-800 dark:text-white">{{ number_format($order->total, 0) }} ش.ج</span>
                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium
                                @if($order->status === 'pending') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400
                                @elseif($order->status === 'processing') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                                @elseif($order->status === 'completed') bg-primary/10 text-primary
                                @else bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400
                                @endif">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-3 opacity-50">inbox</span>
                        <p>لا توجد طلبات حتى الآن</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- إجراءات سريعة --}}
        <section class="space-y-4">
            <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">bolt</span>
                    إجراءات سريعة
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('cp.store.products.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-primary/5 dark:bg-primary/10 hover:bg-primary/10 dark:hover:bg-primary/20 text-slate-700 dark:text-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-primary">add_circle</span>
                        <span>إضافة منتج جديد</span>
                    </a>
                    <a href="{{ route('cp.store.categories.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-slate-500">folder</span>
                        <span>إدارة الفئات</span>
                    </a>
                    <a href="{{ route('cp.store.orders.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-slate-500">list_alt</span>
                        <span>جميع الطلبات</span>
                    </a>
                </div>
            </div>

            <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary/30 dark:hover:border-primary/40 transition-all group">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 text-primary group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-2xl">open_in_new</span>
                </span>
                <div>
                    <p class="font-bold text-slate-800 dark:text-white">عرض المتجر</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">زيارة الموقع للمستخدمين</p>
                </div>
            </a>
        </section>
    </div>
</div>
@endsection
