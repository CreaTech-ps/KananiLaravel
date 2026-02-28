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
<div class="group bg-white dark:bg-surface-darks rounded-xl overflow-hidden border border-slate-200 dark:border-primarys/10 hover:border-primarys/40 transition-all hover:shadow-lg flex flex-col h-full">
    <a href="{{ $productUrl }}" class="block relative aspect-[3/4] overflow-hidden bg-slate-200 dark:bg-[#283933] shrink-0 max-h-56">
        @if($discountPercent)
            <span class="absolute top-4 right-4 bg-orange-500 text-white text-[10px] font-black px-2 py-1 rounded z-10 shadow-lg shadow-orange-500/20">
                {{ __('ui.store_discount') ?? 'خصم' }} {{ $discountPercent }}%
            </span>
        @endif
        <img alt="{{ $name }}"
             class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform duration-500"
             src="{{ $imageUrl }}" loading="lazy" />
    </a>
    <div class="p-4 flex flex-col flex-1">
        <a href="{{ $productUrl }}" class="flex justify-between items-start gap-2 mb-1">
            <h4 class="text-base font-bold line-clamp-2">{{ $name }}</h4>
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
            <p class="text-xs text-slate-500 dark:text-[#9cbaaf] mb-2 line-clamp-2">{{ Str::limit($description, 60) }}</p>
        @endif
        @if($sizeText)
            <div class="flex items-center gap-1 mb-3 text-xs text-slate-500 dark:text-[#9cbaaf]">
                <span class="material-symbols-outlined text-sm">straighten</span>
                <span>{{ __('ui.store_size') ?? 'مقاس' }}: {{ $sizeText }}</span>
            </div>
        @endif
        <button type="button" class="store-add-to-cart-btn w-full mt-auto bg-primarys hover:bg-primarys/5 text-white hover:text-primarys py-2.5 rounded-lg text-sm font-bold transition-all flex items-center justify-center gap-1.5 border border-primarys/10"
            data-product-id="{{ $product->id }}" data-product-url="{{ $productUrl }}">
            <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
            {{ __('ui.store_add_to_cart') ?? 'إضافة للسلة' }}
        </button>
    </div>
</div>
