@extends('website.layout')

@section('title', __('partners.page_title'))

@section('content')
<main>
    <section class="py-16 md:py-20 relative overflow-hidden bg-white dark:bg-[#0C0C0C] transition-colors duration-500">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 text-primary border border-primary/20 mb-8 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest">{{ __('partners.badge') }}</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 dark:text-white mb-8 leading-[1.2] tracking-tight">
                    {{ __('partners.hero_title') }} <span class="text-primary">{{ __('partners.hero_title_highlight') }}</span>
                </h1>

                <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-14 leading-relaxed opacity-90">
                    {{ __('partners.hero_subtitle') }}
                </p>

                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#partners-grid" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center">
                        {{ __('partners.cta_become') }}
                    </a>
                    <a href="{{ config('app.annual_report_url', '#') }}" target="_blank" rel="noopener" class="bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg border border-slate-200 dark:border-white/20 hover:bg-slate-200 dark:hover:bg-white/20 transition-all inline-flex items-center justify-center">
                        {{ __('partners.cta_report') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-30 mt-2 md:mt-4">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden text-center">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">handshake</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="250">+{{ $totalPartners }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('partners.stat1_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden text-center">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">groups</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="1200000">1.2M</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('partners.stat2_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden text-center">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">account_balance</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="85">85</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('partners.stat3_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden text-center">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">trending_up</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="15">15%</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('partners.stat4_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="partners-grid" class="py-16 md:py-20 bg-white dark:bg-transparent transition-colors duration-300 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-10">
                <div class="relative">
                    <div class="absolute rtl:-right-6 ltr:-left-6 top-1/2 -translate-y-1/2 w-2 h-16 bg-primary rounded-full"></div>
                    <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-4 leading-none">
                        {{ __('partners.section_title') }}
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 text-lg max-w-md leading-relaxed">
                        {{ __('partners.section_subtitle') }}
                    </p>
                </div>

                <div class="inline-flex p-1.5 bg-slate-100 dark:bg-white/5 rounded-2xl border border-slate-200 dark:border-white/10" id="partners-filter-tabs">
                    <button type="button" class="partners-filter-btn px-8 py-3 rounded-xl text-sm font-bold transition-all {{ $type === 'company' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 dark:text-slate-400 hover:text-primary' }}" data-type="company">
                        {{ __('partners.filter_company') }}
                    </button>
                    <button type="button" class="partners-filter-btn px-8 py-3 rounded-xl text-sm font-bold transition-all {{ $type === 'individual' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 dark:text-slate-400 hover:text-primary' }}" data-type="individual">
                        {{ __('partners.filter_individual') }}
                    </button>
                </div>
            </div>

            <div id="partners-list-wrap" data-initial-type="{{ $type }}" data-initial-page="{{ $partners->currentPage() }}">
                @include('website.partials.partners_list', ['partners' => $partners])
            </div>
        </div>
    </section>

    <section class="bg-slate-50 dark:bg-[#1a1a1a] py-16 md:py-20 transition-colors duration-300">
        <div class="max-w-[1280px] mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-primary/5 dark:bg-primary/10 rounded-[2.5rem] p-12 md:p-24 text-center border border-primary/10 dark:border-primary/20 relative overflow-hidden shadow-sm">
                <div class="absolute -top-10 -end-10 p-12 opacity-[0.08]">
                    <span class="material-symbols-outlined text-[20rem] text-primary">campaign</span>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight text-slate-900 dark:text-white">
                        {{ __('partners.cta_title') }}
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-16 leading-relaxed font-medium">
                        {{ __('partners.cta_subtitle') }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        @php
                            $policyPdf = config('app.partnership_policy_pdf');
                            $whatsappUrl = config('app.whatsapp_contact');
                            if (!$whatsappUrl && class_exists(\App\Models\SiteSetting::class)) {
                                $site = \App\Models\SiteSetting::get();
                                $phone = $site->contact_phone ?? '';
                                if ($phone) {
                                    $whatsappUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $phone);
                                }
                            }
                        @endphp
                        @if($policyPdf ?? false)
                        <a href="{{ asset($policyPdf) }}" download class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary hover:bg-opacity-90 text-white px-10 py-4 rounded-full font-bold text-lg transition-all shadow-lg shadow-primary/30 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform group-hover:translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>{{ __('partners.cta_policy_pdf') }}</span>
                        </a>
                        @else
                        <a href="#" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary hover:bg-opacity-90 text-white px-10 py-4 rounded-full font-bold text-lg transition-all shadow-lg shadow-primary/30 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform group-hover:translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>{{ __('partners.cta_policy_pdf') }}</span>
                        </a>
                        @endif

                        <a href="{{ $whatsappUrl ?? 'https://wa.me/' }}" target="_blank" rel="noopener" class="w-full sm:w-auto flex items-center justify-center gap-2 border-2 border-[#25D366]/40 text-[#25D366] hover:bg-[#25D366] hover:text-white hover:border-[#25D366] px-10 py-4 rounded-full font-bold text-lg transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            <span>{{ __('partners.cta_whatsapp') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
(function() {
    var partnersUrl = @json(localized_route('partners.index'));
    var $wrap = $('#partners-list-wrap');
    var currentType = $wrap.data('initial-type') || 'company';
    var currentPage = parseInt($wrap.data('initial-page'), 10) || 1;

    function setActiveFilter(type) {
        $('.partners-filter-btn').removeClass('bg-primary text-white shadow-lg shadow-primary/20')
            .addClass('text-slate-500 dark:text-slate-400 hover:text-primary');
        $('.partners-filter-btn[data-type="' + type + '"]').addClass('bg-primary text-white shadow-lg shadow-primary/20')
            .removeClass('text-slate-500 dark:text-slate-400 hover:text-primary');
    }

    function loadPartners(type, page) {
        type = type || currentType;
        page = page || 1;
        currentType = type;
        currentPage = page;

        $wrap.addClass('opacity-60 pointer-events-none');

        $.ajax({
            url: partnersUrl,
            type: 'GET',
            data: { type: type, page: page, ajax: 1 },
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(data) {
                $wrap.html(data.html).removeClass('opacity-60 pointer-events-none');
                setActiveFilter(data.type);
                if (typeof history !== 'undefined' && history.replaceState) {
                    var url = partnersUrl + (partnersUrl.indexOf('?') !== -1 ? '&' : '?') + 'type=' + data.type + '&page=' + data.current_page;
                    history.replaceState({ type: data.type, page: data.current_page }, '', url);
                }
            },
            error: function() {
                $wrap.removeClass('opacity-60 pointer-events-none');
            }
        });
    }

    $(document).on('click', '.partners-filter-btn', function() {
        var type = $(this).data('type');
        loadPartners(type, 1);
    });

    $(document).on('click', '#partners-list-wrap .partners-pagination-link', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        if (!href || href === '#') return;
        var match = href.match(/[?&]page=(\d+)/);
        var page = match ? parseInt(match[1], 10) : 1;
        loadPartners(currentType, page);
    });
})();
</script>
@endsection
