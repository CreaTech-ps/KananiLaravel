@extends('store.layout')

@section('title', __('ui.checkout_complete_title') ?? 'إتمام الشراء')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@26.5.1/build/css/intlTelInput.css">
<style>
    .iti { width: 100%; }
    .iti__input { width: 100% !important; }
    .iti--allow-dropdown .iti__flag-container { {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 0; }
    .iti--allow-dropdown.iti--rtl .iti__flag-container { {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: auto; {{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 0; }
</style>
@endpush

@section('content')
<main class="max-w-[1240px] mx-auto px-6 py-12">
    <div class="mb-14 relative">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primarys/10 text-primarys border border-primarys/20 mb-4 backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-primarys animate-pulse"></span>
            <span class="text-[10px] font-bold uppercase tracking-widest">{{ __('ui.store_view_cart') ?? 'سلة المشتريات' }}</span>
        </div>
        <h2 class="text-4xl md:text-5xl font-black mb-4 leading-tight">
            {{ __('ui.checkout_complete_title') ?? 'إتمام عملية' }} <span class="text-primarys" style="color:#96194A;">{{ __('ui.checkout_complete_subtitle') ?? 'الشراء' }}</span>
        </h2>
        <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl leading-relaxed">
            {{ __('ui.checkout_complete_desc') ?? 'يرجى مراجعة طلبك وإدخال بيانات الشحن والتسليم لإتمام العملية.' }}
        </p>
    </div>

    <form action="{{ route('store.checkout.complete.submit') }}" method="POST" id="complete-purchase-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white dark:bg-surface-darks border border-slate-200 dark:border-primarys/10 rounded-2xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primarys">local_shipping</span>
                        {{ __('ui.checkout_shipping_title') ?? 'تفاصيل الشحن والتسليم' }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_buyer_name') ?? 'الاسم الكامل للمشتري' }}</label>
                            <input type="text" name="buyer_name" required placeholder="{{ __('ui.checkout_buyer_name_placeholder') ?? 'أدخل اسمك الثلاثي' }}"
                                class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys focus:border-primarys transition-all p-3"
                                value="{{ old('buyer_name') }}">
                            @error('buyer_name')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_country') ?? 'الدولة' }}</label>
                            <select name="country" required class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys focus:border-primarys transition-all p-3 appearance-none">
                                <option value="PS" {{ old('country','PS') == 'PS' ? 'selected' : '' }}>{{ __('ui.country_PS') }}</option>
                                <option value="JO" {{ old('country') == 'JO' ? 'selected' : '' }}>{{ __('ui.country_JO') }}</option>
                                <option value="AE" {{ old('country') == 'AE' ? 'selected' : '' }}>{{ __('ui.country_AE') }}</option>
                                <option value="SA" {{ old('country') == 'SA' ? 'selected' : '' }}>{{ __('ui.country_SA') }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_phone') ?? 'رقم الهاتف' }}</label>
                            <input type="tel" id="buyer-phone" name="phone" required class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys focus:border-primarys p-3" placeholder="{{ __('ui.checkout_phone_placeholder') ?? '599 000 000' }}" value="{{ (old('phone_prefix') ? old('phone_prefix') : '') . (old('phone') ?? '') }}">
                            <input type="hidden" name="phone_prefix" id="phone-prefix" value="{{ old('phone_prefix', '+970') }}">
                            @error('phone')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_delivery_date') ?? 'وقت التسليم المفضل' }}</label>
                            <input type="date" name="delivery_date" id="delivery-date" required min="{{ date('Y-m-d') }}"
                                class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys focus:border-primarys p-3"
                                value="{{ old('delivery_date') }}">
                            @error('delivery_date')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_address') ?? 'العنوان بالتفصيل' }}</label>
                            <input type="text" name="address" required placeholder="{{ __('ui.checkout_address_placeholder') ?? 'المدينة، الحي، الشارع، أقرب معلم' }}"
                                class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys focus:border-primarys p-3"
                                value="{{ old('address') }}">
                            @error('address')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2 py-4 border-t border-slate-100 dark:border-primarys/5 mt-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="receiver-toggle" name="same_receiver" value="1" {{ old('same_receiver', true) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primarys"></div>
                                <span class="ms-3 text-sm font-bold">{{ __('ui.checkout_same_receiver') ?? 'المستلم هو نفسه المشتري' }}</span>
                            </label>
                        </div>

                        <div id="receiver-details" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 {{ old('same_receiver', true) ? 'hidden' : '' }}">
                            <div class="space-y-2">
                                <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_receiver_name') ?? 'اسم المستلم' }}</label>
                                <input type="text" name="receiver_name" placeholder="{{ __('ui.checkout_receiver_name_placeholder') ?? 'اسم الشخص الذي سيتسلم الطلب' }}"
                                    class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys p-3"
                                    value="{{ old('receiver_name') }}">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold opacity-70">{{ __('ui.checkout_receiver_phone') ?? 'رقم هاتف المستلم' }}</label>
                                <input type="tel" id="receiver-phone" name="receiver_phone" class="w-full bg-transparent border border-slate-200 dark:border-primarys/10 rounded-xl focus:ring-2 focus:ring-primarys p-3" placeholder="{{ __('ui.checkout_phone_placeholder') ?? '599 000 000' }}" value="{{ (old('receiver_phone_prefix') ? old('receiver_phone_prefix') : '') . (old('receiver_phone') ?? '') }}">
                                <input type="hidden" name="receiver_phone_prefix" id="receiver-phone-prefix" value="{{ old('receiver_phone_prefix', '+970') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-white dark:bg-surface-darks border border-slate-200 dark:border-primarys/10 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primarys">receipt_long</span>
                            {{ __('ui.checkout_order_summary') ?? 'ملخص الطلب' }}
                        </h3>

                        <div class="space-y-4 mb-6">
                            @foreach($items as $item)
                            <div class="flex gap-4 items-center">
                                <div class="size-16 rounded-lg bg-slate-100 dark:bg-primarys/5 overflow-hidden shrink-0 border border-primarys/10">
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/80x80?text=Product' }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold line-clamp-1">{{ $item['name'] }}</h4>
                                    <p class="text-xs text-slate-500">{{ __('ui.store_quantity') ?? 'الكمية' }}: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="text-sm font-bold text-primarys">{{ number_format($item['subtotal'], 0) }} {{ __('ui.currency_nis') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 pt-6 border-t border-slate-200 dark:border-primarys/10">
                            <div class="flex justify-between text-sm">
                                <span class="opacity-60">{{ __('ui.checkout_subtotal') ?? 'المجموع الفرعي' }}</span>
                                <span class="font-medium">{{ number_format($subtotal ?? $total, 0) }} {{ __('ui.currency_nis') }}</span>
                            </div>
                            @if(($shipping_cost ?? 0) > 0)
                            <div class="flex justify-between text-sm">
                                <span class="opacity-60">{{ __('ui.checkout_shipping_cost') ?? 'تكلفة الشحن' }}</span>
                                <span class="font-medium">{{ number_format($shipping_cost, 0) }} {{ __('ui.currency_nis') }}</span>
                            </div>
                            @else
                            <div class="flex justify-between text-sm">
                                <span class="opacity-60">{{ __('ui.checkout_shipping_cost') ?? 'تكلفة الشحن' }}</span>
                                <span class="font-medium text-green-500">{{ __('ui.checkout_free') ?? 'مجاني' }}</span>
                            </div>
                            @endif
                            @if(($discount_total ?? 0) > 0)
                            <div class="flex justify-between text-sm">
                                <span class="opacity-60">{{ __('ui.invoice_discount_total') ?? 'إجمالي الخصم' }}</span>
                                <span class="font-medium text-green-500">-{{ number_format($discount_total, 0) }} {{ __('ui.currency_nis') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-xl font-black pt-3 border-t border-dashed border-slate-200 dark:border-primarys/10">
                                <span>{{ __('ui.checkout_total') ?? 'الإجمالي' }}</span>
                                <span class="text-primarys">{{ number_format($total, 0) }} {{ __('ui.currency_nis') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-8 bg-primarys hover:opacity-90 text-white py-4 rounded-xl font-black transition-all flex items-center justify-center gap-2 shadow-lg shadow-primarys/20" style="background-color:#96194A;">
                            <span class="material-symbols-outlined">verified_user</span>
                            {{ __('ui.checkout_confirm_order') ?? 'تأكيد طلب الشراء' }}
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </form>
</main>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@26.5.1/build/js/intlTelInput.min.js"></script>
<script>
(function() {
    var locale = '{{ app()->getLocale() }}';
    var isAr = locale === 'ar';
    var preferredCountries = ['ps', 'jo', 'il', 'sa', 'ae', 'eg', 'lb', 'sy', 'iq', 'ye', 'om', 'kw', 'bh', 'qa', 'ma', 'tn', 'dz', 'ly', 'sd'];
    var countryOptions = {
        preferredCountries: preferredCountries,
        initialCountry: 'ps',
        separateDialCode: true,
        countryNameLocale: isAr ? 'ar' : 'en'
    };

    function syncPhonePrefix(iti, prefixEl) {
        if (!iti || !prefixEl) return;
        var d = iti.getSelectedCountryData();
        prefixEl.value = d.dialCode ? '+' + d.dialCode : '';
    }

    if (typeof intlTelInput !== 'undefined') {
        var buyerInput = document.getElementById('buyer-phone');
        var receiverInput = document.getElementById('receiver-phone');
        var prefixEl = document.getElementById('phone-prefix');
        var receiverPrefixEl = document.getElementById('receiver-phone-prefix');
        if (buyerInput) {
            window.itiBuyer = intlTelInput(buyerInput, Object.assign({}, countryOptions, {
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@26.5.1/build/js/utils.js'
            }));
            buyerInput.addEventListener('countrychange', function() { syncPhonePrefix(window.itiBuyer, prefixEl); });
            syncPhonePrefix(window.itiBuyer, prefixEl);
        }
        if (receiverInput) {
            window.itiReceiver = intlTelInput(receiverInput, Object.assign({}, countryOptions, {
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@26.5.1/build/js/utils.js'
            }));
            receiverInput.addEventListener('countrychange', function() { syncPhonePrefix(window.itiReceiver, receiverPrefixEl); });
            syncPhonePrefix(window.itiReceiver, receiverPrefixEl);
        }
    }

    var form = document.getElementById('complete-purchase-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            var buyerInput = document.getElementById('buyer-phone');
            var receiverInput = document.getElementById('receiver-phone');
            var prefixEl = document.getElementById('phone-prefix');
            var receiverPrefixEl = document.getElementById('receiver-phone-prefix');
            if (window.itiBuyer && prefixEl) {
                var d = window.itiBuyer.getSelectedCountryData();
                var full = window.itiBuyer.getNumber();
                prefixEl.value = full ? '+' + d.dialCode : (d.dialCode ? '+' + d.dialCode : '+970');
                if (full && buyerInput) {
                    var digits = full.replace(/\D/g, '');
                    buyerInput.value = digits.startsWith(d.dialCode) ? digits.slice(d.dialCode.length) : digits;
                }
            }
            if (window.itiReceiver && receiverPrefixEl) {
                var rd = window.itiReceiver.getSelectedCountryData();
                var rfull = window.itiReceiver.getNumber();
                receiverPrefixEl.value = rfull ? '+' + rd.dialCode : (rd.dialCode ? '+' + rd.dialCode : '+970');
                if (rfull && receiverInput) {
                    var rdigits = rfull.replace(/\D/g, '');
                    receiverInput.value = rdigits.startsWith(rd.dialCode) ? rdigits.slice(rd.dialCode.length) : rdigits;
                }
            }
        });
    }

    var toggle = document.getElementById('receiver-toggle');
    var receiverDetails = document.getElementById('receiver-details');
    if (toggle && receiverDetails) {
        toggle.addEventListener('change', function() {
            if (this.checked) {
                receiverDetails.classList.add('hidden');
            } else {
                receiverDetails.classList.remove('hidden');
            }
        });
    }
})();
</script>
@endpush
@endsection
