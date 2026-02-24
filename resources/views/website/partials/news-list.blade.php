{{-- الجزء الديناميكي من صفحة الأخبار (يُستخدم مع AJAX) --}}
{{-- الفلاتر النشطة --}}
@if(request()->hasAny(['year', 'month']))
<div class="flex flex-wrap items-center justify-between gap-4 mb-8">
    <div class="flex flex-wrap items-center gap-3">
        <span class="text-slate-500 dark:text-slate-400 text-sm font-medium">{{ __('ui.active_filters') }}</span>
        @if(request('year'))
        <span
            class="inline-flex items-center gap-2 bg-primary/10 text-primary px-3 py-1.5 rounded-full text-xs font-bold border border-primary/20">
            {{ __('ui.year_label') }} {{ request('year') }}
        </span>
        @endif
        @if(request('month'))
        @php
        $months = [
            '01' => __('ui.month_january'),
            '02' => __('ui.month_february'),
            '03' => __('ui.month_march'),
            '04' => __('ui.month_april'),
            '05' => __('ui.month_may'),
            '06' => __('ui.month_june'),
            '07' => __('ui.month_july'),
            '08' => __('ui.month_august'),
            '09' => __('ui.month_september'),
            '10' => __('ui.month_october'),
            '11' => __('ui.month_november'),
            '12' => __('ui.month_december'),
        ];
        @endphp
        <span
            class="inline-flex items-center gap-2 bg-primary/10 text-primary px-3 py-1.5 rounded-full text-xs font-bold border border-primary/20">
            {{ $months[request('month')] ?? request('month') }}
        </span>
        @endif
    </div>
    <a href="{{ localized_route('news.index') }}"
        class="news-clear-link text-sm font-bold text-slate-500 hover:text-primary transition-colors">{{ __('ui.clear_all') }}</a>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($news as $item)
    <article
        class="bg-white dark:bg-bg-dark-card rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 hover:shadow-xl transition-all group flex flex-col">
        <a href="{{ localized_route('news.show', ['slug' => current_slug($item)]) }}" class="block">
            <div class="relative h-44 overflow-hidden">
                <img alt="{{ localized($item, 'title') }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/400x200?text=' . urlencode(__('ui.news_placeholder')) }}" 
                    loading="lazy" width="400" height="200" />
            </div>
        </a>
        <div class="p-5 flex-1 flex flex-col">
            <div class="flex items-center gap-2 text-slate-400 text-[11px] mb-3">
                <span class="material-symbols-outlined text-sm">calendar_month</span>
                {{ $item->published_at?->locale(app()->getLocale())->translatedFormat('d F Y') ?? '—' }}
            </div>
            <h3 class="text-base font-bold mb-3 leading-tight group-hover:text-primary transition-colors">
                <a href="{{ localized_route('news.show', ['slug' => current_slug($item)]) }}">{{ localized($item, 'title') }}</a>
            </h3>
            <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed line-clamp-3 mb-6">
                {{ Str::limit(localized($item, 'summary') ?? localized($item, 'title'), 120) }}
            </p>
            <div
                class="flex items-center justify-between mt-auto border-t border-slate-100 dark:border-slate-800/50 pt-4">
                <a class="flex items-center gap-1 text-primary font-bold text-xs hover:translate-x-[-4px] transition-transform"
                    href="{{ localized_route('news.show', ['slug' => current_slug($item)]) }}">
                    {{ __('ui.read_more') }}
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                </a>
                <button type="button" data-url="{{ url(localized_route('news.show', ['slug' => current_slug($item)])) }}"
                    onclick="navigator.clipboard.writeText(this.dataset.url)"
                    class="text-slate-400 hover:text-primary transition-colors share-btn" title="{{ __('ui.copy_link_title') }}">
                    <span class="material-symbols-outlined text-lg">share</span>
                </button>
            </div>
        </div>
    </article>
    @empty
    <div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">
        <span class="material-symbols-outlined text-6xl mb-4 block opacity-50">newspaper</span>
        <p class="text-lg font-medium">{{ __('ui.no_news_found') }}</p>
        <a href="{{ localized_route('news.index') }}" class="news-clear-link inline-block mt-4 text-primary font-bold hover:underline">{{ __('ui.view_all_news') }}</a>
    </div>
    @endforelse
</div>

{{-- الترقيم --}}
@if($news->hasPages())
<nav class="flex justify-center items-center gap-3 mt-16 news-pagination">
    {{ $news->links('pagination::tailwind') }}
</nav>
@endif
