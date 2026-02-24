<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6" id="store-products-grid">
    @forelse($products ?? [] as $product)
        @include('store.partials.product-card', ['product' => $product])
    @empty
        <div class="col-span-full text-center py-20 text-slate-500 dark:text-slate-400">
            {{ __('ui.store_no_products') ?? 'لا توجد منتجات حالياً' }}
        </div>
    @endforelse
</div>
@if(isset($products) && $products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $products->hasPages())
<div class="flex justify-center mt-16 mb-20 gap-2" id="store-pagination" data-base-url="{{ url()->current() }}">
    @if ($products->onFirstPage())
        <span class="w-10 h-10 rounded-lg flex items-center justify-center border border-primarys/20 text-slate-400 cursor-not-allowed">
            <span class="material-symbols-outlined">chevron_right</span>
        </span>
    @else
        <a href="{{ $products->previousPageUrl() }}" class="store-filter-pagination w-10 h-10 rounded-lg flex items-center justify-center border border-primarys/20 hover:bg-primarys hover:text-white transition-colors" data-page="{{ $products->currentPage() - 1 }}">
            <span class="material-symbols-outlined">chevron_right</span>
        </a>
    @endif
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="store-filter-pagination w-10 h-10 rounded-lg flex items-center justify-center {{ $products->currentPage() == $page ? 'bg-primarys text-white font-bold' : 'border border-primarys/20 hover:bg-primarys/10' }} transition-colors" data-page="{{ $page }}">
            {{ $page }}
        </a>
    @endforeach
    @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="store-filter-pagination w-10 h-10 rounded-lg flex items-center justify-center border border-primarys/20 hover:bg-primarys hover:text-white transition-colors" data-page="{{ $products->currentPage() + 1 }}">
            <span class="material-symbols-outlined">chevron_left</span>
        </a>
    @else
        <span class="w-10 h-10 rounded-lg flex items-center justify-center border border-primarys/20 text-slate-400 cursor-not-allowed">
            <span class="material-symbols-outlined">chevron_left</span>
        </span>
    @endif
</div>
@endif
