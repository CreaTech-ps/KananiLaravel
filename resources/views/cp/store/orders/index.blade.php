@extends('cp.layout')

@section('title', 'طلبات المتجر')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">shopping_cart</span>
            طلبات المتجر
        </h2>
    </div>

    {{-- إحصائيات سريعة --}}
    @php
        $stats = [
            'total' => \App\Models\StoreOrder::count(),
            'pending' => \App\Models\StoreOrder::where('status', 'pending')->count(),
            'processing' => \App\Models\StoreOrder::where('status', 'processing')->count(),
            'completed' => \App\Models\StoreOrder::where('status', 'completed')->count(),
        ];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">إجمالي الطلبات</p>
            <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['total'] }}</p>
        </div>
        <div class="rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 p-4 shadow-sm">
            <p class="text-sm text-amber-600 dark:text-amber-400 mb-1">قيد الانتظار</p>
            <p class="text-2xl font-bold text-amber-700 dark:text-amber-300">{{ $stats['pending'] }}</p>
        </div>
        <div class="rounded-2xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 shadow-sm">
            <p class="text-sm text-blue-600 dark:text-blue-400 mb-1">قيد التجهيز</p>
            <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $stats['processing'] }}</p>
        </div>
        <div class="rounded-2xl bg-primary/10 dark:bg-primary/20 border border-primary/20 p-4 shadow-sm">
            <p class="text-sm text-primary mb-1">مكتمل</p>
            <p class="text-2xl font-bold text-primary">{{ $stats['completed'] }}</p>
        </div>
    </div>

    {{-- تصفية --}}
    <form action="{{ route('cp.store.orders.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[220px]">
                <label for="q" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">بحث</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="رقم الطلب، الاسم، الهاتف..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm" />
            </div>
            <div class="min-w-[160px]">
                <label for="status" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">الحالة</label>
                <select name="status" id="status" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                    <option value="">— الكل —</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>مكتمل</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                </select>
            </div>
            <div class="min-w-[150px]">
                <label for="from" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">من تاريخ</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm" />
            </div>
            <div class="min-w-[150px]">
                <label for="to" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">إلى تاريخ</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm" />
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
            @if(request()->hasAny(['q', 'status', 'from', 'to']))
                <a href="{{ route('cp.store.orders.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">إعادة تعيين</a>
            @endif
        </div>
    </form>

    {{-- قائمة الطلبات --}}
    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($orders->isEmpty())
            <div class="p-16 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-6xl mb-4 block opacity-40">receipt_long</span>
                <p class="text-lg mb-2">لا توجد طلبات حتى الآن</p>
                <p class="text-sm">ستظهر الطلبات هنا عند إتمام العملاء لعملية الشراء</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">رقم الطلب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">المشتري</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الهاتف</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الإجمالي</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">التاريخ</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-24">إجراء</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($orders as $order)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-4 py-3">
                                    <span class="font-mono font-bold text-primary">{{ $order->order_number }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="font-medium text-slate-800 dark:text-white">{{ $order->buyer_name }}</span>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">{{ $order->address }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="tel:{{ $order->phone }}" class="text-primary hover:underline">{{ $order->phone }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="font-bold text-slate-800 dark:text-white">{{ number_format($order->total, 0) }}</span>
                                    <span class="text-xs text-slate-500">شيكل</span>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusClass = match($order->status) {
                                            'pending' => 'bg-amber-500/20 text-amber-700 dark:text-amber-400',
                                            'processing' => 'bg-blue-500/20 text-blue-700 dark:text-blue-400',
                                            'completed' => 'bg-primary/20 text-primary',
                                            'cancelled' => 'bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300',
                                            default => 'bg-slate-200 text-slate-600',
                                        };
                                    @endphp
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClass }}">{{ $order->status_label }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                                    {{ $order->created_at->format('Y-m-d') }}<br>
                                    <span class="text-xs">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('cp.store.orders.show', $order) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/10 hover:bg-primary/20 text-primary text-sm font-medium transition-colors">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                        عرض
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
