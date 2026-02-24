@extends('store.layout')

@section('title', __('ui.store_embroidery') ?? 'متجر المطرزات')

@section('content')
{{-- Hero Section --}}
<section class="py-14 md:py-20 relative overflow-hidden transition-colors duration-500">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primarys/5 to-transparent pointer-events-none"></div>
    <div class="max-w-[1240px] mx-auto px-6 lg:px-12 w-full">
        <div class="text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primarys/10 text-primarys border border-primarys/20 mb-8 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-primarys animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-widest">{{ __('ui.store_embroidery') ?? 'متجر المطرزات' }}</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                {{ __('ui.store_hero_title') ?? 'تراثنا الفلسطيني' }} <br />
                <span class="text-primarys" style="color: #96194A;">{{ __('ui.store_hero_subtitle') ?? 'في كل غرزة' }}</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-14 leading-relaxed opacity-90">
                {{ __('ui.store_hero_desc') ?? 'اكتشفوا أجود أنواع المطرزات اليدوية التي صنعت بحب بأيدي نساء فلسطينيات، تجمع بين أصالة التراث وحداثة التصميم.' }}
            </p>
        </div>
    </div>
</section>

<div class="flex flex-col lg:flex-row gap-10 mx-6 lg:mx-20" id="store-main" data-filter-url="{{ route('store.filter') }}" data-search="{{ request('q', '') }}">
    @include('store.partials.sidebar')

    <div class="flex-1">
        <div class="flex items-center justify-between mb-8">
            @php
                $prods = $products ?? collect();
                $total = $prods instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $prods->total() : $prods->count();
                $from = $prods instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $prods->firstItem() : 1;
                $to = $prods instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $prods->lastItem() : $prods->count();
            @endphp
            <p class="text-sm text-slate-500 dark:text-[#9cbaaf]" id="store-showing-text" data-tpl="{{ __('ui.store_showing') }} {from}-{to} {{ __('ui.store_of') }} {total} {{ __('ui.store_product') }}">
                {{ __('ui.store_showing') ?? 'عرض' }} {{ $from }}-{{ $to }} {{ __('ui.store_of') ?? 'من أصل' }} {{ $total }} {{ __('ui.store_product') ?? 'منتج' }}
            </p>
            <div class="flex items-center gap-2">
                <span class="text-sm">{{ __('ui.store_sort_by') ?? 'ترتيب حسب:' }}</span>
                <select class="bg-transparent border-none text-sm font-bold text-primarys focus:ring-0 cursor-pointer" style="color: #96194A;" name="sort" id="store-sort">
                    <option value="newest">{{ __('ui.store_sort_newest') ?? 'الأحدث' }}</option>
                    <option value="price_asc">{{ __('ui.store_sort_price_low') ?? 'السعر: من الأقل' }}</option>
                    <option value="price_desc">{{ __('ui.store_sort_price_high') ?? 'السعر: من الأعلى' }}</option>
                </select>
            </div>
        </div>

        <div id="store-products-wrapper">
            @include('store.partials.products-grid', ['products' => $products ?? collect()])
        </div>
    </div>
</div>
@push('styles')
<style>
/* شريط تمرير جانبي — لون ناعم، حركة انسيابية */
.store-sidebar-categories {
    scroll-behavior: smooth;
    padding-inline-end: 4px;
    scrollbar-width: thin;
    scrollbar-color: rgba(150, 25, 74, 0.35) transparent;
}
.store-sidebar-categories::-webkit-scrollbar {
    width: 6px;
}
.store-sidebar-categories::-webkit-scrollbar-track {
    background: transparent;
}
.store-sidebar-categories::-webkit-scrollbar-thumb {
    background: rgba(150, 25, 74, 0.3);
    border-radius: 3px;
}
.store-sidebar-categories::-webkit-scrollbar-thumb:hover {
    background: rgba(150, 25, 74, 0.5);
}
.dark .store-sidebar-categories {
    scrollbar-color: rgba(150, 25, 74, 0.4) transparent;
}
.dark .store-sidebar-categories::-webkit-scrollbar-thumb {
    background: rgba(150, 25, 74, 0.35);
}
.dark .store-sidebar-categories::-webkit-scrollbar-thumb:hover {
    background: rgba(150, 25, 74, 0.55);
}
</style>
@endpush
@push('scripts')
<script src="{{ asset('js/store-filter.js') }}"></script>
@endpush
@endsection
