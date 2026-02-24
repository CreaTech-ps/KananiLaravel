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
    $imageUrls = array_map(fn($p) => asset('storage/' . $p), $product->image_paths ?? []);
    $mainImageUrl = $imageUrls[0] ?? 'https://via.placeholder.com/600x700?text=Product';
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
        <div class="lg:col-span-6 space-y-4 w-full">
            <div class="relative w-full rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-600 flex items-center justify-center aspect-square group">
                <img alt="{{ $name }}" id="main-product-image"
                    class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-[1.02]"
                    src="{{ $mainImageUrl }}" />
                @if($discountPercent)
                    <div class="absolute top-4 left-4 z-10 bg-primarys text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                        {{ $discountPercent }}% {{ __('ui.store_discount') ?? 'خصم' }}
                    </div>
                @endif
            </div>
            @if(count($imageUrls) > 1)
            <div class="grid gap-2 grid-cols-4">
                @foreach($imageUrls as $idx => $url)
                    <button type="button" class="thumb-btn aspect-square rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 border-2 transition-all {{ $idx === 0 ? 'border-primarys ring-2 ring-primarys ring-offset-2 ring-offset-background-darks' : 'border-slate-200 dark:border-slate-600 hover:border-primarys/50' }}"
                        data-src="{{ $url }}">
                        <img class="w-full h-full object-contain" src="{{ $url }}" alt="{{ $name }} - {{ $idx + 1 }}" />
                    </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- معلومات المنتج --}}
        <div class="lg:col-span-6 flex flex-col">
            <div class="mb-2">
                <span class="inline-flex items-center rounded-full bg-primarys/10 px-2.5 py-0.5 text-xs font-medium text-primarys uppercase tracking-wider">{{ __('ui.store_heritage_badge') }}</span>
            </div>
            <div class="flex items-center gap-4 mb-1">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $name }}</h1>
                @php
                    $productUrl = route('store.product.show', ['slug' => $slug]);
                    $shareText = $name . ' - ' . number_format($price) . ' ' . (__('ui.currency_nis') ?? 'شيكل');
                    $shareTextEnc = rawurlencode($shareText);
                    $shareUrlEnc = rawurlencode($productUrl);
                @endphp
                <div class="relative group">
                    <button type="button" id="product-share-trigger" class="w-10 h-10 flex items-center justify-center rounded-full text-slate-500 dark:text-slate-400 hover:bg-primarys/10 hover:text-primarys transition-all shrink-0" title="{{ __('ui.share') ?? 'مشاركة' }}" aria-haspopup="true" aria-expanded="false">
                        <span class="material-symbols-outlined text-[24px]">share</span>
                    </button>
                    <div id="product-share-dropdown" class="absolute top-full mt-2 start-0 min-w-[180px] py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-xl shadow-xl opacity-0 invisible transition-all duration-200 z-50">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrlEnc }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <span class="text-[#1877F2]"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></span>
                            <span>Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrlEnc }}&text={{ $shareTextEnc }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <span><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></span>
                            <span>X (Twitter)</span>
                        </a>
                        <a href="https://wa.me/?text={{ $shareTextEnc }}%20{{ $shareUrlEnc }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <span class="text-[#25D366]"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></path></svg></span>
                            <span>WhatsApp</span>
                        </a>
                        <a href="https://t.me/share/url?url={{ $shareUrlEnc }}&text={{ $shareTextEnc }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <span class="text-[#0088cc]"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg></span>
                            <span>Telegram</span>
                        </a>
                        <button type="button" class="product-share-copy w-full flex items-center gap-2 px-4 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-start" data-url="{{ $productUrl }}">
                            <span class="material-symbols-outlined text-[18px] text-slate-500">link</span>
                            <span>{{ __('ui.copy_link') ?? 'نسخ الرابط' }}</span>
                        </button>
                    </div>
                </div>
            </div>
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

    var shareTrigger = document.getElementById('product-share-trigger');
    var shareDropdown = document.getElementById('product-share-dropdown');
    if (shareTrigger && shareDropdown) {
        shareTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            var isHidden = shareDropdown.classList.contains('opacity-0');
            shareDropdown.classList.toggle('opacity-0', !isHidden);
            shareDropdown.classList.toggle('invisible', !isHidden);
        });
        document.addEventListener('click', function() {
            shareDropdown.classList.add('opacity-0', 'invisible');
        });
        shareDropdown.addEventListener('click', function(e) { e.stopPropagation(); });
    }

    document.querySelectorAll('.product-share-copy').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var url = this.getAttribute('data-url') || window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                var t = document.createElement('div');
                t.className = 'fixed bottom-24 left-1/2 -translate-x-1/2 z-[200] px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white text-sm font-medium rounded-lg shadow-lg';
                t.textContent = '{{ __("ui.link_copied") ?? "تم نسخ الرابط" }}';
                document.body.appendChild(t);
                setTimeout(function() { t.remove(); }, 1500);
            });
            var dd = document.getElementById('product-share-dropdown');
            if (dd) { dd.classList.add('opacity-0', 'invisible'); dd.classList.remove('opacity-100', 'visible'); }
        });
    });

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
