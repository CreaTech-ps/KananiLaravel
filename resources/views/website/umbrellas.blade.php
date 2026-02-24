@extends('website.layout')

@section('title', __('parasols.page_title'))

@section('content')
<main>
    <section class="py-16 md:py-20 relative overflow-hidden bg-white dark:bg-[#0C0C0C] transition-colors duration-500">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 text-primary border border-primary/20 mb-8 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest">{{ __('parasols.badge') }}</span>
                </div>

                @php
                    $heroTitle = localized($settings, 'hero_title') ?? __('parasols.hero_title');
                    $heroParts = str_contains($heroTitle, ':') ? explode(':', $heroTitle, 2) : [$heroTitle, null];
                @endphp

                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 dark:text-white mb-8 leading-[1.2] tracking-tight">
                    {{ trim($heroParts[0]) }}{{ $heroParts[1] ? ': ' : '' }}@if($heroParts[1])<span class="text-primary">{{ trim($heroParts[1]) }}</span>@endif
                </h1>

                <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-14 leading-relaxed opacity-90">
                    {{ localized($settings, 'hero_subtitle') ?? __('parasols.hero_subtitle') }}
                </p>

                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#spaces" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center">
                        {{ localized($settings, 'cta_primary_text') ?? __('parasols.cta_primary') }}
                    </a>
                    @if(!empty($settings->cta_secondary_url))
                    <a href="{{ $settings->cta_secondary_url }}" target="_blank" rel="noopener"
                        class="bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg border border-slate-200 dark:border-white/20 hover:bg-slate-200 dark:hover:bg-white/20 transition-all inline-flex items-center justify-center">
                        {{ localized($settings, 'cta_secondary_text') ?? __('parasols.cta_secondary') }}
                    </a>
                    @else
                    <a href="#spaces" class="bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg border border-slate-200 dark:border-white/20 hover:bg-slate-200 dark:hover:bg-white/20 transition-all inline-flex items-center justify-center">
                        {{ localized($settings, 'cta_secondary_text') ?? __('parasols.cta_secondary') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-30 mt-4">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">umbrella</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ str_replace(['+', ','], '', $settings->stat1_value ?? '120') }}">{{ $settings->stat1_value ?? '120+' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ localized($settings, 'stat1_label') ?? __('parasols.stat1_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">school</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ str_replace(',', '', $settings->stat2_value ?? '1500') }}">{{ $settings->stat2_value ?? '1,500' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ localized($settings, 'stat2_label') ?? __('parasols.stat2_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">location_city</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ $settings->stat3_value ?? '3' }}">{{ $settings->stat3_value ?? '3' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ localized($settings, 'stat3_label') ?? __('parasols.stat3_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">leaderboard</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ str_replace('%', '', $settings->stat4_value ?? '98') }}">{{ $settings->stat4_value ?? '98%' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ localized($settings, 'stat4_label') ?? __('parasols.stat4_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="spaces" class="py-16 md:py-20 bg-slate-50/50 dark:bg-[#0a0a0a]">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-10">
                <div class="max-w-xl">
                    <h2 class="text-4xl md:text-5xl font-black mb-6 text-slate-900 dark:text-white leading-tight">
                        @php
                            $sectionTitle = localized($settings, 'section_title') ?? __('parasols.section_title');
                            $sectionParts = str_contains($sectionTitle, ' في ') ? explode(' في ', $sectionTitle, 2) : [$sectionTitle, null];
                        @endphp
                        {{ trim($sectionParts[0]) }}@if($sectionParts[1]) في <span class="text-primary">{{ trim($sectionParts[1]) }}</span>@endif
                    </h2>
                    <div class="inline-flex items-center gap-2 bg-white dark:bg-card-dark px-4 py-2 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm">
                        <span class="material-symbols-outlined text-primary text-xl">layers</span>
                        <span class="text-sm font-bold text-slate-600 dark:text-slate-300" id="parasols-count-text">{{ __('parasols.spaces_available', ['count' => $totalSpaces]) }}</span>
                    </div>
                </div>

                @if($regions->isNotEmpty())
                <div class="flex flex-wrap items-center gap-2 p-1.5 bg-slate-200/50 dark:bg-white/5 backdrop-blur-md rounded-2xl border border-white/20" id="parasols-filter">
                    @php $currentRegion = request('region') ? (int) request('region') : null; @endphp
                    <button type="button" class="parasols-filter-btn px-8 py-3 rounded-xl font-bold transition-all {{ !$currentRegion ? 'bg-primary text-white shadow-lg shadow-primary/20 scale-105' : 'hover:bg-white dark:hover:bg-white/10 text-slate-600 dark:text-slate-400' }}" data-region="">{{ __('parasols.filter_all') }}</button>
                    @foreach($regions as $region)
                    <button type="button" class="parasols-filter-btn px-8 py-3 rounded-xl font-bold transition-all {{ $currentRegion === (int) $region->id ? 'bg-primary text-white shadow-lg shadow-primary/20 scale-105' : 'hover:bg-white dark:hover:bg-white/10 text-slate-600 dark:text-slate-400' }}" data-region="{{ $region->id }}">{{ localized($region, 'name') }}</button>
                    @endforeach
                </div>
                @endif
            </div>

            <div id="parasols-grid-wrap">
                @include('website.partials.parasols_spaces', ['images' => $images, 'totalSpaces' => $totalSpaces])
            </div>

            <div class="mt-20 text-center">
                <a href="#spaces" class="group relative px-12 py-5 rounded-2xl font-black transition-all bg-white dark:bg-card-dark border border-slate-200 dark:border-white/10 hover:border-primary/50 text-slate-900 dark:text-white shadow-xl hover:shadow-primary/10 inline-flex items-center gap-4 overflow-hidden">
                    <span class="relative z-10">{{ __('parasols.explore_all') }}</span>
                    <span class="material-symbols-outlined relative z-10 group-hover:translate-y-1 transition-transform rtl:rotate-180">south</span>
                    <div class="absolute inset-0 bg-primary/5 scale-x-0 group-hover:scale-x-100 transition-transform origin-left rtl:origin-right"></div>
                </a>
            </div>
        </div>
    </section>

    <section class="pb-32">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="bg-primary/5 dark:bg-primary/10 rounded-[2.5rem] p-12 md:p-24 text-center border border-primary/10 dark:border-primary/20 relative overflow-hidden shadow-sm">
                <div class="absolute -top-10 -end-10 p-12 opacity-[0.03] dark:opacity-[0.08]">
                    <span class="material-symbols-outlined text-[20rem] text-primary">campaign</span>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight text-slate-900 dark:text-white">{{ __('parasols.cta_title') }}</h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-16 leading-relaxed font-medium">
                        {{ __('parasols.cta_subtitle') }}
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        @php
                            $siteSettings = \App\Models\SiteSetting::get();
                            $whatsappNumber = $siteSettings->contact_phone ?? null;
                            $whatsappUrl = null;
                            if ($whatsappNumber) {
                                // تنظيف الرقم من أي أحرف غير رقمية
                                $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                                // إنشاء رابط واتساب
                                $whatsappUrl = 'https://wa.me/' . $cleanNumber;
                            }
                        @endphp
                        @if($whatsappUrl)
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-3">
                            {{ __('parasols.cta_contact') }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                        @elseif(!empty($settings->whatsapp_url))
                        <a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-3">
                            {{ __('parasols.cta_contact') }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                        @else
                        <a href="{{ $settings->cta_contact_url ?? '#' }}" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-3">
                            {{ __('parasols.cta_contact') }}
                            <span class="material-symbols-outlined">send</span>
                        </a>
                        @endif
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
    var spacesUrl = @json(localized_route('parasols.spaces'));
    var countTextTemplate = @json(__('parasols.spaces_available', ['count' => '__COUNT__']));
    var $wrap = $('#parasols-grid-wrap');
    var $countText = $('#parasols-count-text');
    var $filterBtns = $('.parasols-filter-btn');

    function setActiveBtn(regionId) {
        $filterBtns.removeClass('bg-primary text-white shadow-lg shadow-primary/20 scale-105').addClass('hover:bg-white dark:hover:bg-white/10 text-slate-600 dark:text-slate-400');
        $filterBtns.filter(function() {
            return $(this).data('region') === regionId || ($(this).data('region') === '' && !regionId);
        }).addClass('bg-primary text-white shadow-lg shadow-primary/20 scale-105').removeClass('hover:bg-white dark:hover:bg-white/10 text-slate-600 dark:text-slate-400');
    }

    $filterBtns.on('click', function() {
        var regionId = $(this).data('region');
        setActiveBtn(regionId === '' ? null : regionId);
        $wrap.addClass('opacity-60 pointer-events-none');
        $.ajax({
            url: spacesUrl,
            type: 'GET',
            data: { region: regionId || undefined },
            dataType: 'json',
            success: function(data) {
                $wrap.html(data.html).removeClass('opacity-60 pointer-events-none');
                if ($countText.length) $countText.text(countTextTemplate.replace('__COUNT__', data.total));
            },
            error: function() {
                $wrap.removeClass('opacity-60 pointer-events-none');
            }
        });
    });
})();
</script>
@endsection
