@extends('cp.layout')

@section('title', 'طلب #' . $order->order_number)

@section('content')
<div class="space-y-6 max-w-4xl">
    {{-- رأس الطلب --}}
    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="p-6 bg-gradient-to-l from-primary/5 to-transparent dark:from-primary/10 border-b border-slate-200 dark:border-slate-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">receipt_long</span>
                        طلب <span class="font-mono text-primary">#{{ $order->order_number }}</span>
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $order->created_at->translatedFormat('l، d F Y - H:i') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @php
                        $statusClass = match($order->status) {
                            'pending' => 'bg-amber-500/20 text-amber-700 dark:text-amber-400 border-amber-200',
                            'processing' => 'bg-blue-500/20 text-blue-700 dark:text-blue-400 border-blue-200',
                            'completed' => 'bg-primary/20 text-primary border-primary/30',
                            'cancelled' => 'bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300 border-slate-300',
                            default => 'bg-slate-200 border-slate-300',
                        };
                    @endphp
                    <span class="inline-flex px-4 py-2 rounded-xl text-sm font-bold border {{ $statusClass }}">{{ $order->status_label }}</span>
                </div>
            </div>
        </div>

        {{-- تغيير الحالة --}}
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
            <form action="{{ route('cp.store.orders.status', $order) }}" method="POST" class="flex flex-wrap items-end gap-3">
                @csrf
                <div class="min-w-[180px]">
                    <label for="status" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">تحديث الحالة</label>
                    <select name="status" id="status" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="notes" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">ملاحظات</label>
                    <input type="text" name="notes" id="notes" value="{{ old('notes', $order->notes) }}" placeholder="ملاحظة داخلية..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm" />
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-medium transition-colors">حفظ</button>
            </form>
        </div>

        <div class="grid md:grid-cols-2 gap-6 p-6">
            {{-- المشتري --}}
            <div>
                <h3 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">person</span>
                    بيانات المشتري
                </h3>
                <div class="space-y-2 text-sm">
                    <p><span class="text-slate-500">الاسم:</span> <strong class="text-slate-800 dark:text-white">{{ $order->buyer_name }}</strong></p>
                    <p><span class="text-slate-500">الهاتف:</span> <a href="tel:{{ $order->phone }}" class="text-primary hover:underline">{{ $order->phone }}</a></p>
                    <p><span class="text-slate-500">العنوان:</span> {{ $order->address }}</p>
                    <p><span class="text-slate-500">الدولة:</span> {{ __('ui.country_' . $order->country) ?? $order->country }}</p>
                    <p><span class="text-slate-500">تاريخ التسليم:</span> {{ $order->delivery_date?->format('Y-m-d') }}</p>
                </div>
            </div>
            {{-- المستلم --}}
            <div>
                <h3 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">local_shipping</span>
                    بيانات المستلم
                </h3>
                <div class="space-y-2 text-sm">
                    <p><span class="text-slate-500">الاسم:</span> <strong class="text-slate-800 dark:text-white">{{ $order->receiver_name ?? $order->buyer_name }}</strong></p>
                    <p><span class="text-slate-500">الهاتف:</span> <a href="tel:{{ $order->receiver_phone ?? $order->phone }}" class="text-primary hover:underline">{{ $order->receiver_phone ?? $order->phone }}</a></p>
                    <p><span class="text-slate-500">العنوان:</span> {{ $order->address }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- المنتجات --}}
    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                المنتجات
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">المنتج</th>
                        <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 text-center">الكمية</th>
                        <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 text-end">السعر</th>
                        <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 text-end">الخصم</th>
                        <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 text-end">المجموع</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if(!empty($item['image']))
                                        <img src="{{ $item['image'] }}" alt="" class="w-12 h-12 object-cover rounded-lg" />
                                    @else
                                        <span class="w-12 h-12 flex items-center justify-center rounded-lg bg-slate-200 dark:bg-slate-600 text-slate-400">
                                            <span class="material-symbols-outlined">image</span>
                                        </span>
                                    @endif
                                    <span class="font-medium text-slate-800 dark:text-white">{{ $item['name'] ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">{{ $item['quantity'] ?? 0 }}</td>
                            <td class="px-4 py-3 text-end">{{ number_format($item['price'] ?? 0, 0) }} شيكل</td>
                            <td class="px-4 py-3 text-end text-green-600 dark:text-green-400">{{ ($item['discount'] ?? 0) > 0 ? '-' . number_format($item['discount'], 0) : '0' }}</td>
                            <td class="px-4 py-3 text-end font-bold text-slate-800 dark:text-white">{{ number_format($item['subtotal'] ?? 0, 0) }} شيكل</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- الإجماليات --}}
        <div class="p-6 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/30">
            <div class="max-w-xs ms-auto space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">المجموع الفرعي</span>
                    <span>{{ number_format($order->subtotal, 0) }} شيكل</span>
                </div>
                @if($order->shipping_cost > 0)
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">رسوم الشحن</span>
                    <span>{{ number_format($order->shipping_cost, 0) }} شيكل</span>
                </div>
                @endif
                @if($order->discount_total > 0)
                <div class="flex justify-between text-sm text-green-600 dark:text-green-400">
                    <span>الخصم</span>
                    <span>-{{ number_format($order->discount_total, 0) }} شيكل</span>
                </div>
                @endif
                <div class="flex justify-between text-lg font-bold pt-3 border-t border-slate-200 dark:border-slate-600">
                    <span class="text-slate-800 dark:text-white">الإجمالي</span>
                    <span class="text-primary">{{ number_format($order->total, 0) }} شيكل</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('cp.store.orders.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
            <span class="material-symbols-outlined">arrow_forward</span>
            العودة للقائمة
        </a>
        <a href="tel:{{ $order->phone }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
            <span class="material-symbols-outlined">call</span>
            الاتصال بالمشتري
        </a>
    </div>
</div>
@endsection
