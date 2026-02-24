@extends('store.layout')

@section('title', __('ui.store_view_cart'))

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-2xl font-bold mb-8">{{ __('ui.store_view_cart') }}</h1>

    @if(empty($items))
        <div class="bg-white dark:bg-surface-darks rounded-2xl border border-slate-200 dark:border-primarys/10 p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-600 mb-4">shopping_cart</span>
            <p class="text-slate-500 dark:text-slate-400 mb-6">{{ __('ui.store_cart_empty') }}</p>
            <a href="{{ route('store.index') }}" class="inline-flex items-center gap-2 bg-primarys text-white font-bold py-3 px-6 rounded-xl hover:opacity-90 transition-opacity" style="background-color:#96194A;">
                <span class="material-symbols-outlined">shopping_bag</span>
                {{ __('ui.store_nav') }}
            </a>
        </div>
    @else
        <div class="space-y-6">
            <div class="bg-white dark:bg-surface-darks rounded-2xl border border-slate-200 dark:border-primarys/10 overflow-hidden">
                <div class="divide-y divide-slate-200 dark:divide-white/5">
                    @foreach($items as $item)
                        <div class="flex gap-4 p-4 items-center">
                            <a href="{{ route('store.product.show', ['slug' => $item['slug'] ?? $item['id']]) }}" class="shrink-0">
                                <img src="{{ $item['image'] ?? 'https://via.placeholder.com/80x80?text=Product' }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded-lg" />
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('store.product.show', ['slug' => $item['slug'] ?? $item['id']]) }}" class="font-bold hover:text-primarys transition-colors">{{ $item['name'] }}</a>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $item['quantity'] }} × {{ number_format($item['price'], 0) }} {{ __('ui.currency_nis') }}</p>
                            </div>
                            <span class="font-bold text-primarys">{{ number_format($item['subtotal'], 0) }} {{ __('ui.currency_nis') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-surface-darks rounded-2xl border border-slate-200 dark:border-primarys/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-lg font-bold">{{ __('ui.store_cart_total') }}</span>
                    <span class="text-2xl font-black text-primarys">{{ number_format($total, 0) }} {{ __('ui.currency_nis') }}</span>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('store.checkout.complete') }}" class="flex-1 bg-primarys hover:bg-primarys/90 text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg" style="background-color:#96194A;">
                        <span class="material-symbols-outlined text-[20px]">payments</span>
                        {{ __('ui.checkout_pay_now') ?? 'إتمام الدفع' }}
                    </a>
                    <a href="{{ route('store.index') }}" class="flex-1 border border-primarys/30 py-4 rounded-xl font-bold text-center hover:bg-primarys/5 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        {{ __('ui.store_nav') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
