@extends('website.layout')

@section('title', __('ui.news_archive_title'))

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16 md:pb-20">
    <nav class="flex items-center text-xs gap-2 text-slate-500 dark:text-slate-400 mb-6">
        <a class="hover:text-primary transition-colors" href="{{ localized_route('home') }}">{{ __('ui.nav_home') }}</a>
        <span class="material-symbols-outlined text-[14px]">chevron_left</span>
        <span class="text-text-dark-gray dark:text-white font-semibold">{{ __('ui.news_archive_title') }}</span>
    </nav>

    <section class="py-16 md:py-20 relative overflow-hidden bg-white dark:bg-[#0C0C0C] transition-colors duration-500 mb-12">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 text-primary border border-primary/20 mb-8 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest">{{ __('ui.news_archive_badge') }}</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 dark:text-white mb-8 leading-[1.2] tracking-tight">
                    {{ __('ui.news_archive_title') }}
                </h1>

                <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed opacity-90">
                    {{ __('ui.news_archive_subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- لوحة التصفية --}}
        @php
            $isRTL = app()->getLocale() === 'ar';
            // في العربية (RTL): السايدبار في اليسار (order-1)، القائمة في اليمين (order-2)
            // في الإنجليزية (LTR): السايدبار في اليمين (order-2)، القائمة في اليسار (order-1)
            $sidebarOrder = $isRTL ? 'order-2 lg:order-1' : 'order-2 lg:order-2';
            $contentOrder = $isRTL ? 'order-1 lg:order-2' : 'order-1 lg:order-1';
        @endphp
        <aside class="lg:col-span-3 {{ $sidebarOrder }} lg:sticky lg:top-28">
            <div
                class="bg-white dark:bg-bg-dark-card p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-2 mb-6 text-primary">
                    <span class="material-symbols-outlined">filter_list</span>
                    <h2 class="text-lg font-bold">{{ __('ui.filter_results') }}</h2>
                </div>
                <form id="news-filter-form" method="GET" action="{{ localized_route('news.index') }}" class="space-y-6" data-news-url="{{ url(localized_route('news.index')) }}">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-slate-600 dark:text-slate-400">{{ __('ui.select_year') }}</label>
                        <select name="year"
                            class="w-full bg-slate-50 dark:bg-bg-dark-main border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-primary focus:border-primary transition-all cursor-pointer text-sm dark:text-slate-300">
                            <option value="">{{ __('ui.all_years') }}</option>
                            @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-slate-600 dark:text-slate-400">{{ __('ui.month') }}</label>
                        <select name="month"
                            class="w-full bg-slate-50 dark:bg-bg-dark-main border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 focus:ring-primary focus:border-primary transition-all cursor-pointer text-sm dark:text-slate-300">
                            <option value="">{{ __('ui.all_months') }}</option>
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
                            @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" id="news-filter-submit"
                            class="flex-1 bg-primary hover:brightness-110 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                            <span class="btn-text">{{ __('ui.apply_filters') }}</span>
                        </button>
                        <span id="news-filter-clear-wrap" class="{{ request()->hasAny(['year', 'month']) ? '' : 'hidden' }}">
                            <a href="{{ localized_route('news.index') }}" id="news-filter-clear"
                                class="news-clear-link px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors inline-flex items-center justify-center"
                                title="{{ __('ui.clear_all') }}">✕</a>
                        </span>
                    </div>
                </form>
            </div>
        </aside>

        {{-- قائمة الأخبار --}}
        <section class="lg:col-span-9 {{ $contentOrder }}" id="news-list-wrapper" data-news-base="{{ url(localized_route('news.index')) }}">
            <div id="news-list-container">
                @include('website.partials.news-list')
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
(function() {
    var $ = window.jQuery;
    if (!$) return;

    var $form = $('#news-filter-form');
    var $container = $('#news-list-container');
    var $wrapper = $('#news-list-wrapper');
    var $submitBtn = $('#news-filter-submit');
    var $clearWrap = $('#news-filter-clear-wrap');
    var baseUrl = $form.data('news-url');

    function setLoading(loading) {
        if (loading) {
            $submitBtn.prop('disabled', true);
            $submitBtn.find('.btn-text').hide();
            if (!$submitBtn.find('.news-loading-spinner').length) {
                $submitBtn.append('<span class="news-loading-spinner material-symbols-outlined animate-spin" style="font-size:20px">progress_activity</span>');
            }
        } else {
            $submitBtn.prop('disabled', false);
            $submitBtn.find('.btn-text').show();
            $submitBtn.find('.news-loading-spinner').remove();
        }
    }

    function loadNews(url) {
        setLoading(true);
        $.ajax({
            url: url,
            type: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(res) {
                if (res && res.html) {
                    $container.html(res.html);
                    updateHistory(url);
                    updateClearButton(url);
                    $('html, body').animate({ scrollTop: $wrapper.offset().top - 100 }, 300);
                }
            },
            error: function() {
                window.location.href = url;
            },
            complete: function() {
                setLoading(false);
            }
        });
    }

    function updateHistory(url) {
        if (window.history && window.history.pushState) {
            window.history.pushState({}, '', url);
        }
    }

    function updateClearButton(url) {
        var params = new URLSearchParams(new URL(url, window.location.origin).search);
        if (params.has('year') || params.has('month')) {
            $clearWrap.removeClass('hidden');
            $('#news-filter-clear').attr('href', baseUrl);
        } else {
            $clearWrap.addClass('hidden');
        }
    }

    function isNewsIndexLink(href) {
        if (!href || href.indexOf('#') === 0) return false;
        try {
            var full = new URL(href, window.location.origin);
            var base = new URL(baseUrl, window.location.origin);
            return full.pathname === base.pathname && full.origin === base.origin;
        } catch (e) {
            return false;
        }
    }

    $form.on('submit', function(e) {
        e.preventDefault();
        var params = new URLSearchParams($(this).serialize());
        var url = baseUrl + (params.toString() ? '?' + params.toString() : '');
        loadNews(url);
        return false;
    });

    $('#news-filter-clear').on('click', function(e) {
        e.preventDefault();
        loadNews(baseUrl);
        $form.find('[name="year"]').val('');
        $form.find('[name="month"]').val('');
        return false;
    });

    $wrapper.on('click', 'a.news-clear-link', function(e) {
        e.preventDefault();
        loadNews(baseUrl);
        $form.find('[name="year"]').val('');
        $form.find('[name="month"]').val('');
        return false;
    });

    $wrapper.on('click', 'a[href]', function(e) {
        if ($(this).hasClass('news-clear-link')) return;
        var href = $(this).attr('href');
        if (isNewsIndexLink(href)) {
            e.preventDefault();
            loadNews(href);
            return false;
        }
    });
})();
</script>
@endpush
@endsection
