@extends('store.layout')

@section('title', __('ui.checkout_success_title'))

@section('content')
<main class="flex-grow py-16 px-6 relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primarys/5 to-transparent pointer-events-none"></div>

    <div class="max-w-[800px] mx-auto w-full bg-white dark:bg-surface-darks border border-slate-200 dark:border-primarys/10 rounded-2xl shadow-xl overflow-hidden relative z-10">

        {{-- Success Header --}}
        <div class="p-8 md:p-12 text-center border-b border-slate-200 dark:border-primarys/10">
            <div class="mb-6 flex justify-center">
                <div class="size-20 rounded-full bg-primarys/10 border border-primarys/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primarys text-5xl" style="color: #96194A;">check_circle</span>
                </div>
            </div>
            <h1 class="text-2xl md:text-3xl font-black mb-2 leading-tight">
                {{ __('ui.checkout_success_title') ?? 'تمت عملية الدفع' }} <span class="text-primarys" style="color: #96194A;">{{ __('ui.checkout_success_badge') ?? 'بنجاح!' }}</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 opacity-90">
                {{ __('ui.checkout_success_desc') ?? 'شكراً لدعمكم لطلاب جامعة بيرزيت.' }}
            </p>
            <p class="text-slate-500 dark:text-slate-400 text-xs">{{ __('ui.invoice_order_id') ?? 'رقم الطلب' }}: <span class="font-mono font-bold text-primarys" style="color: #96194A;">#{{ $orderNumber ?? 'ORD-00000' }}</span></p>
        </div>

        {{-- Invoice Body --}}
        <div class="p-8 md:p-12" id="invoice-content">
            {{-- Store Details --}}
            <div class="mb-8 pb-6 border-b border-slate-200 dark:border-primarys/10">
                <h2 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">{{ __('ui.invoice_store_info') ?? 'معلومات المتجر' }}</h2>
                <p class="text-lg font-black text-slate-900 dark:text-white">{{ $store['name'] ?? config('app.name') }}</p>
                <div class="mt-2 space-y-1 text-sm text-slate-600 dark:text-slate-300">
                    <p><span class="material-symbols-outlined text-base align-middle opacity-70">location_on</span> {{ $store['address'] ?? '—' }}</p>
                    <p><span class="material-symbols-outlined text-base align-middle opacity-70">call</span> {{ $store['phone'] ?? '—' }}</p>
                    <p><span class="material-symbols-outlined text-base align-middle opacity-70">mail</span> {{ $store['email'] ?? '—' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                {{-- Buyer Details --}}
                <div>
                    <h2 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">{{ __('ui.invoice_buyer') ?? 'بيانات المشتري' }}</h2>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $order['buyer_name'] ?? '—' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">{{ __('ui.checkout_phone') ?? 'الهاتف' }}: {{ $order['phone'] ?? '—' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.checkout_address') ?? 'العنوان' }}: {{ $order['address'] ?? '—' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.checkout_country') ?? 'الدولة' }}: {{ __('ui.country_' . ($order['country'] ?? 'PS')) ?? ($order['country'] ?? '—') }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.checkout_delivery_date') ?? 'تاريخ التسليم' }}: {{ $order['delivery_date'] ?? '—' }}</p>
                </div>
                {{-- Receiver Details --}}
                <div>
                    <h2 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">{{ __('ui.invoice_receiver') ?? 'بيانات المستلم' }}</h2>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $order['receiver_name'] ?? $order['buyer_name'] ?? '—' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">{{ __('ui.checkout_receiver_phone') ?? 'هاتف المستلم' }}: {{ $order['receiver_phone'] ?? $order['phone'] ?? '—' }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.checkout_address') ?? 'العنوان' }}: {{ $order['address'] ?? '—' }}</p>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="mb-8">
                <h2 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-4">{{ __('ui.invoice_products') ?? 'المنتجات' }}</h2>
                <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-primarys/10">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-start py-3 px-4 font-bold">{{ __('ui.invoice_product_name') ?? 'المنتج' }}</th>
                                <th class="text-center py-3 px-4 font-bold">{{ __('ui.invoice_qty') ?? 'الكمية' }}</th>
                                <th class="text-end py-3 px-4 font-bold">{{ __('ui.invoice_unit_price') ?? 'السعر' }}</th>
                                <th class="text-end py-3 px-4 font-bold">{{ __('ui.invoice_discount') ?? 'الخصم' }}</th>
                                <th class="text-end py-3 px-4 font-bold">{{ __('ui.invoice_item_total') ?? 'المجموع' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items ?? [] as $item)
                            <tr class="border-t border-slate-200 dark:border-primarys/10">
                                <td class="py-3 px-4 font-medium">{{ $item['name'] ?? '—' }}</td>
                                <td class="py-3 px-4 text-center">{{ $item['quantity'] ?? 0 }}</td>
                                <td class="py-3 px-4 text-end">{{ number_format($item['price'] ?? 0, 2) }} {{ __('ui.currency_nis') }}</td>
                                <td class="py-3 px-4 text-end {{ ($item['discount'] ?? 0) > 0 ? 'text-green-600 dark:text-green-400' : '' }}">
                                    {{ ($item['discount'] ?? 0) > 0 ? '-' . number_format($item['discount'], 2) : '0.00' }} {{ __('ui.currency_nis') }}
                                </td>
                                <td class="py-3 px-4 text-end font-bold">{{ number_format($item['subtotal'] ?? 0, 2) }} {{ __('ui.currency_nis') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Totals --}}
            <div class="max-w-xs ms-auto space-y-2 mb-8">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">{{ __('ui.checkout_subtotal') ?? 'المجموع الفرعي' }}</span>
                    <span class="font-medium">{{ number_format($subtotal ?? 0, 2) }} {{ __('ui.currency_nis') }}</span>
                </div>
                @if(($shippingCost ?? 0) > 0)
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">{{ __('ui.checkout_shipping_cost') ?? 'رسوم الشحن' }}</span>
                    <span class="font-medium">{{ number_format($shippingCost ?? 0, 2) }} {{ __('ui.currency_nis') }}</span>
                </div>
                @else
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">{{ __('ui.checkout_shipping_cost') ?? 'رسوم الشحن' }}</span>
                    <span class="font-medium text-green-600 dark:text-green-400">{{ __('ui.checkout_free') ?? 'مجاني' }}</span>
                </div>
                @endif
                @if(($discountTotal ?? 0) > 0)
                <div class="flex justify-between text-sm">
                    <span class="text-slate-600 dark:text-slate-400">{{ __('ui.invoice_discount_total') ?? 'إجمالي الخصم' }}</span>
                    <span class="font-medium text-green-600 dark:text-green-400">-{{ number_format($discountTotal ?? 0, 2) }} {{ __('ui.currency_nis') }}</span>
                </div>
                @endif
                <div class="flex justify-between text-lg font-black pt-3 border-t-2 border-slate-200 dark:border-primarys/20">
                    <span>{{ __('ui.checkout_total') ?? 'الإجمالي' }}</span>
                    <span class="text-primarys" style="color: #96194A;">{{ number_format($total ?? 0, 2) }} {{ __('ui.currency_nis') }}</span>
                </div>
            </div>

            {{-- Footer: Date & QR --}}
            <div class="pt-8 border-t border-slate-200 dark:border-primarys/10 flex flex-col sm:flex-row items-center justify-between gap-6">
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('ui.checkout_datetime') ?? 'التاريخ والوقت' }}: <strong>{{ $datetime ?? now()->translatedFormat('d F Y - H:i') }}</strong></p>
                <div class="flex flex-col items-center gap-2">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data={{ urlencode($invoiceUrl ?? route('store.index') . '?order=' . ($orderNumber ?? '')) }}&format=svg" alt="QR" class="w-[140px] h-[140px] bg-white p-2 rounded-lg border border-slate-200 dark:border-primarys/10" width="140" height="140" />
                    <span class="text-xs text-slate-500 dark:text-slate-400">{{ __('ui.invoice_qr_hint') ?? 'رمز الطلب للتحقق' }}</span>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="invoice-actions p-8 md:p-12 pt-0 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('store.index') }}" class="flex-1 bg-primarys hover:bg-primarys/90 text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-primarys/20" style="background-color: #96194A;">
                <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                {{ __('ui.checkout_back_to_store') ?? 'العودة للمتجر' }}
            </a>
            <button type="button" onclick="window.print()" class="flex-1 bg-white dark:bg-transparent hover:bg-slate-50 dark:hover:bg-primarys/10 text-slate-700 dark:text-white font-bold py-4 rounded-xl border border-slate-200 dark:border-primarys/20 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">print</span>
                {{ __('ui.checkout_download_invoice') ?? 'طباعة الفاتورة' }}
            </button>
        </div>
    </div>
</main>

@push('styles')
<style media="print">
    body * { visibility: hidden; }
    main, main * { visibility: visible; }
    main { position: absolute; left: 0; top: 0; width: 100%; }
    .fixed, .invoice-actions { display: none !important; visibility: hidden !important; }
    a[href]:after { content: none !important; }
</style>
@endpush
@endsection
