@php
    $name = localized($product ?? null, 'name') ?? $product->name_ar ?? $product->name ?? '';
    $description = localized($product ?? null, 'description') ?? $product->description_ar ?? $product->description ?? '';
    $price = $product->price ?? 0;
    $oldPrice = $product->old_price ?? null;
    $discountPercent = $product->discount_percent ?? null;
    $imagePath = $product->image_path ?? null;
    $imageUrl = $imagePath ? asset('storage/' . $imagePath) : 'https://via.placeholder.com/400x500?text=Product';
    $slug = localized($product ?? null, 'slug') ?? $product->slug_ar ?? $product->slug ?? $product->id;
    $size = $product->sizes->first() ?? null;
    $sizeText = $size ? (localized($size, 'size') ?? $size->size_ar ?? $size->size ?? '') : '';
    $productUrl = Route::has('store.product.show') ? route('store.product.show', ['slug' => $slug]) : '#';
@endphp
<div class="group bg-white dark:bg-surface-darks rounded-2xl overflow-hidden border border-slate-200 dark:border-primarys/10 hover:border-primarys/40 transition-all hover:shadow-xl flex flex-col h-full">
    <a href="{{ $productUrl }}" class="block relative aspect-[4/5] overflow-hidden bg-slate-200 dark:bg-[#283933] shrink-0">
        @if($discountPercent)
            <span class="absolute top-4 right-4 bg-orange-500 text-white text-[10px] font-black px-2 py-1 rounded z-10 shadow-lg shadow-orange-500/20">
                {{ __('ui.store_discount') ?? 'خصم' }} {{ $discountPercent }}%
            </span>
        @endif
        <img alt="{{ $name }}"
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
             src="{{ $imageUrl }}" loading="lazy" />
    </a>
    <div class="p-5 flex flex-col flex-1">
        <a href="{{ $productUrl }}" class="flex justify-between items-start mb-2">
            <h4 class="text-lg font-bold">{{ $name }}</h4>
            <span class="text-primarys font-bold" style="color: #96194A;">
                <span class="flex flex-col items-end">
                    <span class="text-primarys">{{ number_format($price) }} {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                    @if($oldPrice)
                        <span class="text-[10px] text-slate-500 line-through">{{ number_format($oldPrice) }} {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                    @endif
                </span>
            </span>
        </a>
        @if($description)
            <p class="text-sm text-slate-500 dark:text-[#9cbaaf] mb-4 line-clamp-2">{{ Str::limit($description, 80) }}</p>
        @endif
        @if($sizeText)
            <div class="flex items-center gap-2 mb-6 text-xs text-slate-500 dark:text-[#9cbaaf]">
                <span class="material-symbols-outlined text-sm">straighten</span>
                <span>{{ __('ui.store_size') ?? 'مقاس' }}: {{ $sizeText }}</span>
            </div>
        @endif
        <button type="button" class="store-add-to-cart-btn w-full mt-auto bg-primarys hover:bg-primarys/5 text-white hover:text-primarys py-3 rounded-xl font-bold transition-all flex items-center justify-center gap-2 border border-primarys/10"
            data-product-id="{{ $product->id }}" data-product-url="{{ $productUrl }}">
            <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
            {{ __('ui.store_add_to_cart') ?? 'إضافة للسلة' }}
        </button>
    </div>
</div>
