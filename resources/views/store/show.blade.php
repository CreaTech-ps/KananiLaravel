@extends('store.layout')

@section('title', $product ? (localized($product, 'name') ?? $product->name_ar ?? 'تفاصيل المنتج') : (__('ui.store_product') ?? 'المنتج'))

@section('content')
@if(!$product)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <p class="text-slate-500 dark:text-slate-400">{{ __('ui.store_product_not_found') ?? 'المنتج غير موجود' }}</p>
        <a href="{{ route('store.index') }}" class="inline-block mt-4 text-primarys font-bold hover:underline">{{ __('ui.store_back') ?? 'العودة للمتجر' }}</a>
    </div>
@else
@php
    $name = localized($product, 'name') ?? $product->name_ar ?? '';
    $description = localized($product, 'description') ?? $product->description_ar ?? '';
    $price = $product->price ?? 0;
    $oldPrice = $product->old_price ?? null;
    $discountPercent = $product->discount_percent ?? null;
    $imagePath = $product->image_path ?? null;
    $imageUrl = $imagePath ? asset('storage/' . $imagePath) : 'https://via.placeholder.com/600x700?text=Product';
    $slug = localized($product, 'slug') ?? $product->slug_ar ?? $product->id;
    $categoryName = $product->category ? (localized($product->category, 'name') ?? $product->category->name_ar) : null;
    $firstSize = $product->sizes->first();
    $dimensions = $firstSize ? (localized($firstSize, 'size') ?? $firstSize->size_ar ?? '') : '';
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumbs --}}
    <nav class="flex items-center gap-2 text-sm mb-8 text-slate-500 dark:text-slate-400">
        <a class="hover:text-primarys" href="{{ url('/') }}">{{ __('ui.nav_home') ?? 'الرئيسية' }}</a>
        <span class="material-symbols-outlined text-xs">chevron_left</span>
        <a class="hover:text-primarys" href="{{ route('store.index') }}">{{ __('ui.store_nav') }}</a>
        @if($categoryName)
            <span class="material-symbols-outlined text-xs">chevron_left</span>
            <a class="hover:text-primarys" href="{{ route('store.index', ['category' => $product->category_id]) }}">{{ $categoryName }}</a>
        @endif
        <span class="material-symbols-outlined text-xs">chevron_left</span>
        <span class="font-medium text-slate-900 dark:text-slate-100">{{ $name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mx-6">
        {{-- معرض الصور --}}
        <div class="lg:col-span-6 space-y-4">
            <div class="relative rounded-xl overflow-hidden bg-primarys/5 border border-primarys/10 group">
                <img alt="{{ $name }}" id="main-product-image"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    src="{{ $imageUrl }}" />
                @if($discountPercent)
                    <div class="absolute top-4 left-4 z-10 bg-primarys text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                        {{ $discountPercent }}% {{ __('ui.store_discount') ?? 'خصم' }}
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-4 gap-4">
                <button type="button" class="thumb-btn aspect-square rounded-lg overflow-hidden border-2 border-primarys ring-2 ring-primarys ring-offset-2 ring-offset-background-darks"
                    data-src="{{ $imageUrl }}">
                    <img class="w-full h-full object-cover" src="{{ $imageUrl }}" alt="" />
                </button>
                @for($i = 1; $i <= 3; $i++)
                    <button type="button" class="thumb-btn aspect-square rounded-lg overflow-hidden border border-primarys/10 hover:border-primarys transition-colors"
                        data-src="{{ $imageUrl }}">
                        <img class="w-full h-full object-cover" src="{{ $imageUrl }}" alt="" />
                    </button>
                @endfor
            </div>
        </div>

        {{-- معلومات المنتج --}}
        <div class="lg:col-span-6 flex flex-col">
            <div class="mb-2">
                <span class="inline-flex items-center rounded-full bg-primarys/10 px-2.5 py-0.5 text-xs font-medium text-primarys uppercase tracking-wider">{{ __('ui.store_heritage_badge') }}</span>
            </div>
            <h1 class="text-3xl font-bold mb-1">{{ $name }}</h1>
            @if($categoryName)
                <h2 class="text-xl text-primarys font-medium mb-4" dir="rtl">{{ $name }} - {{ $categoryName }}</h2>
            @endif
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($price) }} {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                    @if($oldPrice)
                        <span class="text-xl text-slate-500 line-through">{{ number_format($oldPrice) }} {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                    @endif
                </div>
            </div>

            @if($description)
                <p class="text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">{{ $description }}</p>
            @endif

            {{-- المواصفات --}}
            <div class="space-y-4 mb-8">
                @if($product->sizes->isNotEmpty())
                    <div class="flex items-center justify-between py-3 border-b border-primarys/10">
                        <span class="text-sm font-medium text-slate-500">{{ __('ui.store_dimensions') ?? 'الأبعاد' }}</span>
                        <span class="text-sm font-semibold">{{ $product->sizes->pluck('size_ar')->join(' / ') }}</span>
                    </div>
                @endif
                @if($product->colors->isNotEmpty())
                    <div class="flex items-center justify-between py-3 border-b border-primarys/10">
                        <span class="text-sm font-medium text-slate-500">{{ __('ui.store_colors') ?? 'الألوان' }}</span>
                        <span class="text-sm font-semibold">
                            @foreach($product->colors as $c)
                                @if($c->hex_code)
                                    <span class="inline-block w-4 h-4 rounded-full border border-slate-300 align-middle mx-0.5" style="background-color: {{ $c->hex_code }}" title="{{ localized($c, 'name') }}"></span>
                                @else
                                    {{ localized($c, 'name') }}{{ !$loop->last ? '، ' : '' }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                @endif
                <div class="flex items-center justify-between py-3 border-b border-primarys/10">
                    <span class="text-sm font-medium text-slate-500">{{ __('ui.store_stock') ?? 'المخزون' }}</span>
                    <span class="text-sm font-semibold">{{ $product->stock ?? 0 }}</span>
                </div>
            </div>

            {{-- الكمية وإضافة للسلة --}}
            <div class="space-y-4 mt-auto">
                <div class="flex gap-4">
                    <div class="flex items-center border border-primarys/20 rounded-xl bg-primarys/5 w-fit overflow-hidden">
                        <button type="button" id="btn-minus"
                            class="p-3 hover:bg-primarys/10 text-slate-500 hover:text-primarys transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                            <span class="material-symbols-outlined text-[20px] font-bold">remove</span>
                        </button>
                        <div class="w-12 text-center overflow-hidden">
                            <span id="quantity-display" class="block text-lg font-black">1</span>
                        </div>
                        <button type="button" id="btn-plus"
                            class="p-3 hover:bg-primarys/10 text-slate-500 hover:text-primarys transition-all">
                            <span class="material-symbols-outlined text-[20px] font-bold">add</span>
                        </button>
                    </div>
                    <button type="button" class="store-add-to-cart-btn flex-1 bg-primarys hover:bg-primarys/90 text-white font-bold py-3 px-6 rounded-lg transition-all flex items-center justify-center gap-2"
                        data-product-id="{{ $product->id }}" data-quantity-source="#quantity-display">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        {{ __('ui.store_add_to_cart') ?? 'أضف إلى السلة' }}
                    </button>
                </div>
                <form action="{{ route('store.cart.buy-now') }}" method="POST" class="w-full" id="store-buy-now-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="buy-now-quantity" value="1">
                    <button type="submit" class="block w-full text-center border border-primarys/30 py-3 rounded-lg font-medium hover:bg-primarys/5 transition-colors">
                        {{ __('ui.store_buy_now') ?? 'اشتري الآن' }}
                    </button>
                </form>
            </div>

            {{-- Trust Badges --}}
            <div class="mt-8 grid grid-cols-2 gap-4">
                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <span class="material-symbols-outlined text-primarys text-lg">verified_user</span>
                    {{ __('ui.store_authentic_craft') }}
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <span class="material-symbols-outlined text-primarys text-lg">local_shipping</span>
                    {{ __('ui.store_worldwide_shipping') }}
                </div>
            </div>
        </div>
    </div>

    {{-- منتجات ذات صلة --}}
    @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <section class="mt-20 mx-6">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl font-bold">{{ __('ui.store_related') ?? 'قد يعجبك أيضاً' }}</h3>
            <a class="text-primarys font-medium flex items-center gap-1 hover:underline" href="{{ route('store.index') }}">
                {{ __('ui.store_view_all') ?? 'عرض المتجر' }}
                <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $rel)
                @php
                    $rName = localized($rel, 'name') ?? $rel->name_ar ?? '';
                    $rPrice = $rel->price ?? 0;
                    $rImageUrl = $rel->image_path ? asset('storage/' . $rel->image_path) : 'https://via.placeholder.com/400x400?text=Product';
                    $rSlug = localized($rel, 'slug') ?? $rel->slug_ar ?? $rel->id;
                    $rCat = $rel->category ? (localized($rel->category, 'name') ?? $rel->category->name_ar) : '';
                @endphp
                <a href="{{ route('store.product.show', ['slug' => $rSlug]) }}" class="related-card bg-white dark:bg-surface-darks rounded-xl border border-slate-200 dark:border-primarys/10 overflow-hidden flex flex-col cursor-pointer group transition-all duration-300 hover:shadow-2xl hover:shadow-primarys/10 hover:-translate-y-2">
                    <div class="aspect-square relative overflow-hidden">
                        <img src="{{ $rImageUrl }}" alt="{{ $rName }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        @if($rel->discount_percent)
                            <div class="absolute top-3 left-3 z-10 bg-primarys text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-md">
                                {{ $rel->discount_percent }}% {{ __('ui.store_discount') ?? 'خصم' }}
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold group-hover:text-primarys transition-colors duration-300">{{ $rName }}</h3>
                            <span class="text-primarys font-bold">{{ number_format($rPrice) }} ₪</span>
                        </div>
                        @if($rCat)
                            <span class="text-xs px-1 text-slate-400">{{ $rCat }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
</div>

@push('scripts')
<script>
(function() {
    var form = document.getElementById('store-buy-now-form');
    if (form) {
        form.addEventListener('submit', function() {
            var qty = document.getElementById('quantity-display');
            var inp = document.getElementById('buy-now-quantity');
            if (qty && inp) inp.value = qty.textContent || 1;
        });
    }

    var qty = 1;
    var maxStock = {{ $product ? ($product->stock ?? 999) : 999 }};
    var displayEl = document.getElementById('quantity-display');
    var btnMinus = document.getElementById('btn-minus');
    var btnPlus = document.getElementById('btn-plus');

    function updateQuantity(delta) {
        qty = Math.max(1, Math.min(maxStock, qty + delta));
        if (displayEl) displayEl.textContent = qty;
        if (btnMinus) btnMinus.disabled = qty <= 1;
    }

    if (btnMinus) btnMinus.addEventListener('click', function() { updateQuantity(-1); });
    if (btnPlus) btnPlus.addEventListener('click', function() { updateQuantity(1); });

    document.querySelectorAll('.thumb-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var img = this.querySelector('img');
            var src = this.getAttribute('data-src') || (img ? img.src : '');
            if (src) {
                var main = document.getElementById('main-product-image');
                if (main) main.src = src;
            }
            document.querySelectorAll('.thumb-btn').forEach(function(b) {
                b.classList.remove('border-2', 'border-primarys', 'ring-2', 'ring-primarys', 'ring-offset-2');
                b.classList.add('border', 'border-primarys/10');
            });
            this.classList.remove('border', 'border-primarys/10');
            this.classList.add('border-2', 'border-primarys', 'ring-2', 'ring-primarys', 'ring-offset-2', 'ring-offset-background-darks');
        });
    });
})();
</script>
@endpush
@endif
@endsection
