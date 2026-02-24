<aside class="w-full lg:w-64 shrink-0" id="store-sidebar" data-max-price="{{ $maxPrice ?? 1500 }}">
    <div class="sticky top-28 bg-white dark:bg-surface-darks rounded-2xl p-6 border border-slate-200 dark:border-primarys/10 shadow-sm">
        <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primarys" style="color: #96194A;">filter_list</span>
            {{ __('ui.store_categories') ?? 'الفئات' }}
        </h3>
        <div class="space-y-2">
            <a href="{{ route('store.index') }}" class="store-filter-category w-full flex items-center justify-between p-3 rounded-lg {{ !request()->has('category') ? 'bg-primarys text-white font-medium' : 'hover:bg-primarys/10' }} transition-colors" data-category="">
                <span>{{ __('ui.store_all') ?? 'الكل' }}</span>
                <span class="text-xs store-cat-count {{ !request()->has('category') ? 'opacity-70' : 'text-slate-500 dark:text-slate-400' }}">{{ $totalProducts ?? 0 }}</span>
            </a>
            @foreach($categories ?? [] as $cat)
                <a href="{{ route('store.index', ['category' => $cat->slug ?? $cat->id]) }}" class="store-filter-category w-full flex items-center justify-between p-3 rounded-lg {{ request('category') == ($cat->slug ?? $cat->id) ? 'bg-primarys text-white font-medium' : 'hover:bg-primarys/10' }} transition-colors" data-category="{{ $cat->slug ?? $cat->id }}">
                    <span>{{ localized($cat, 'name') ?? $cat->name_ar ?? $cat->name }}</span>
                    <span class="text-xs store-cat-count {{ request('category') == ($cat->slug ?? $cat->id) ? 'opacity-70' : 'text-slate-500 dark:text-slate-400' }}">{{ $cat->products_count ?? 0 }}</span>
                </a>
            @endforeach
        </div>
        <div class="mt-8 pt-8 border-t border-primarys/10">
            <h3 class="text-sm font-bold mb-4">{{ __('ui.store_price_range') ?? 'نطاق السعر' }}</h3>
            <div class="space-y-4">
                <input type="range" class="w-full accent-primarys" id="price-range"
                       min="{{ $minPrice ?? 0 }}" max="{{ $maxPrice ?? 1500 }}"
                       value="{{ request('max_price', $maxPrice ?? 1500) }}" />
                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-[#9cbaaf]">
                    <span>0 {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                    <span id="price-range-value">{{ request('max_price', $maxPrice ?? 1500) }} {{ __('ui.currency_nis') ?? 'NIS' }}</span>
                </div>
            </div>
        </div>
    </div>
</aside>
