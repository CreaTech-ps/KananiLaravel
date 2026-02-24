@extends('website.layout')

@section('title', __('ui.grants_page_title'))

@section('content')
<main class="py-16 md:py-20">
    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-20">
        <div class="relative inline-block mb-6">
            <div class="absolute ltr:-left-6 rtl:-right-6 top-1/2 -translate-y-1/2 w-2 h-16 bg-primary rounded-full"></div>
            <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight text-slate-900 dark:text-white">
                {{ __('ui.grants_page_title') }}
            </h1>
        </div>
        <p class="text-slate-500 dark:text-slate-400 text-xl max-w-2xl leading-relaxed mt-4">
            {{ __('ui.grants_intro') }}
        </p>
    </section>

    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @forelse($scholarships as $scholarship)
            @php
                $endDate = $scholarship->application_end_date;
                $daysLeft = $endDate ? now()->diffInDays($endDate, false) : null;
                $badgeClass = 'bg-orange-500/90';
                $badgeText = __('ui.ends_soon');
                if ($endDate && $daysLeft !== null) {
                    if ($daysLeft <= 0) {
                        $badgeClass = 'bg-red-500/90';
                        $badgeText = __('ui.apply_ended');
                    } elseif ($daysLeft <= 3) {
                        $badgeClass = 'bg-red-500/90';
                        $badgeText = __('ui.ends_in_days', ['days' => max(1, (int) round($daysLeft))]);
                    } elseif ($daysLeft <= 14) {
                        $badgeClass = 'bg-orange-500/90';
                        $badgeText = __('ui.ends_soon');
                    } else {
                        $badgeText = __('ui.ends_on', ['date' => $endDate->locale(app()->getLocale())->translatedFormat('d F')]);
                        $badgeClass = 'bg-blue-500/90';
                    }
                }
            @endphp
            <a href="{{ localized_route('grants.show', ['slug' => current_slug($scholarship)]) }}"
                class="scholarship-card bg-white dark:bg-slate-900/40 backdrop-blur-xl border border-slate-200/60 dark:border-white/5 rounded-[32px] overflow-hidden flex flex-col group transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 block">

                <div class="relative h-64 overflow-hidden">
                    <img alt="{{ localized($scholarship, 'title') }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="{{ $scholarship->image_path ? asset('storage/' . $scholarship->image_path) : 'https://images.unsplash.com/photo-1579152276507-735ee11d3f9a?q=80&w=800' }}" 
                        loading="lazy" width="400" height="300" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    @if($endDate)
                    <div class="absolute top-5 end-5 {{ $badgeClass }} backdrop-blur-md text-white text-[11px] font-black px-4 py-2 rounded-full flex items-center gap-2 shadow-lg z-10">
                        <span class="material-symbols-outlined text-sm">alarm</span> {{ $badgeText }}
                    </div>
                    @endif
                </div>

                <div class="p-8 lg:p-10 flex flex-col flex-grow">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-[10px] font-black text-primary uppercase tracking-widest bg-primary/10 px-4 py-1.5 rounded-full border border-primary/20">
                            {{ __('ui.stat_scholarship') }}
                        </span>
                        <div class="flex items-center gap-1.5 text-emerald-500 text-[10px] font-black uppercase">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span> {{ __('ui.open') }}
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-slate-900 dark:text-white group-hover:text-primary transition-colors duration-300">
                        {{ localized($scholarship, 'title') }}
                    </h3>

                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-8 leading-relaxed line-clamp-3">
                        {{ Str::limit(localized($scholarship, 'summary'), 120) }}
                    </p>

                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-8 border-t border-slate-100 dark:border-white/5 pt-6">
                            <div class="flex-1">
                                @if($scholarship->coverage_percentage)
                                <span class="text-[10px] font-bold text-slate-400 block mb-1 uppercase tracking-tighter">{{ __('ui.grants_coverage_label') }}</span>
                                <span class="font-black text-primary text-2xl">{{ $scholarship->coverage_percentage }}%</span>
                                @elseif($scholarship->estimated_value)
                                <span class="text-[10px] font-bold text-slate-400 block mb-1 uppercase tracking-tighter">{{ __('ui.grants_value_label') }}</span>
                                <span class="font-black text-primary text-2xl">{{ $scholarship->estimated_value }}</span>
                                @else
                                <span class="text-[10px] font-bold text-slate-400 block mb-1 uppercase tracking-tighter">{{ __('ui.application_deadline') }}</span>
                                <span class="font-black text-primary text-2xl">{{ $endDate ? $endDate->locale(app()->getLocale())->translatedFormat('d/m/Y') : '—' }}</span>
                                @endif
                            </div>
                            @if($scholarship->estimated_value && !$scholarship->coverage_percentage)
                            <span class="text-slate-400 text-xs italic bg-slate-100 dark:bg-white/5 px-2 py-1 rounded">{{ __('ui.grants_per_year') }}</span>
                            @endif
                        </div>

                        <span class="w-full bg-slate-900 dark:bg-primary text-white font-black py-4 rounded-2xl flex items-center justify-center gap-3 transition-all duration-300 hover:gap-5 group/btn overflow-hidden relative shadow-xl shadow-primary/20">
                            <span class="relative z-10">{{ __('ui.apply_details') }}</span>
                            <span class="material-symbols-outlined text-lg transition-transform rtl:rotate-180 group-hover/btn:-translate-x-1 rtl:group-hover/btn:translate-x-1 relative z-10">arrow_back</span>
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">
                {{ __('ui.grants_empty') }}
            </div>
            @endforelse
        </div>
    </section>

    @if($scholarships->hasPages())
    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center gap-4 mb-20">
        @if ($scholarships->onFirstPage())
        <span class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-400 cursor-not-allowed">
            <span class="material-symbols-outlined rtl:rotate-180">chevron_right</span>
        </span>
        @else
        <a href="{{ $scholarships->previousPageUrl() }}" class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center hover:bg-white dark:hover:bg-card-dark transition-all text-slate-900 dark:text-white">
            <span class="material-symbols-outlined rtl:rotate-180">chevron_right</span>
        </a>
        @endif

        @foreach ($scholarships->getUrlRange(1, $scholarships->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="w-12 h-12 rounded-2xl flex items-center justify-center font-bold transition-all duration-300 {{ $page == $scholarships->currentPage() ? 'primary-gradient-grants text-white btn-glow-grants' : 'border border-slate-200 dark:border-white/10 hover:bg-white dark:hover:bg-card-dark text-slate-900 dark:text-white' }}">
            {{ $page }}
        </a>
        @endforeach

        @if ($scholarships->hasMorePages())
        <a href="{{ $scholarships->nextPageUrl() }}" class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center hover:bg-white dark:hover:bg-card-dark transition-all text-slate-900 dark:text-white">
            <span class="material-symbols-outlined rtl:rotate-180">chevron_left</span>
        </a>
        @else
        <span class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-400 cursor-not-allowed">
            <span class="material-symbols-outlined rtl:rotate-180">chevron_left</span>
        </span>
        @endif
    </section>
    @endif

    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grants-vision-section bg-slate-100 dark:bg-[#151515] rounded-[48px] p-12 md:p-20 relative overflow-hidden border border-slate-200/60 dark:border-white/5">
            <div class="absolute -top-32 ltr:-left-32 rtl:-right-32 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[120px]"></div>
            <div class="absolute -bottom-32 ltr:-right-32 rtl:-left-32 w-[400px] h-[400px] bg-primary/5 rounded-full blur-[100px]"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-black mb-8 text-slate-900 dark:text-white leading-tight">
                        {{ __('ui.grants_vision_title_1') }}<br />
                        <span class="text-primary">{{ __('ui.grants_vision_title_2') }}</span>
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-10">
                        {{ __('ui.grants_vision_desc') }}
                    </p>
                    <div class="flex gap-4">
                        @if(!empty($homeSetting->annual_report_pdf_path))
                        <a href="{{ asset('storage/' . $homeSetting->annual_report_pdf_path) }}" download class="bg-white/50 dark:bg-white/10 hover:bg-white/70 dark:hover:bg-white/20 text-slate-900 dark:text-white px-8 py-4 rounded-2xl font-bold transition-all backdrop-blur-md border border-slate-200/60 dark:border-white/10 inline-flex items-center gap-2">
                            <span class="material-symbols-outlined">download</span>
                            {{ __('ui.grants_vision_cta') }}
                        </a>
                        @else
                        <a href="{{ localized_route('about.index') }}" class="bg-white/50 dark:bg-white/10 hover:bg-white/70 dark:hover:bg-white/20 text-slate-900 dark:text-white px-8 py-4 rounded-2xl font-bold transition-all backdrop-blur-md border border-slate-200/60 dark:border-white/10">
                            {{ __('ui.grants_vision_cta') }}
                        </a>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white/80 dark:bg-white/5 backdrop-blur-2xl border border-slate-200/60 dark:border-white/10 p-10 rounded-[40px] relative group overflow-hidden">
                        <div class="absolute top-0 end-0 w-32 h-32 bg-primary/10 rounded-bl-full translate-x-8 -translate-y-8 group-hover:translate-x-4 group-hover:-translate-y-4 transition-transform"></div>
                        <span class="material-symbols-outlined text-primary text-4xl mb-4">monetization_on</span>
                        <div class="text-5xl font-black text-slate-900 dark:text-white mb-2">2.5M</div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-[0.2em] font-black">{{ __('ui.grants_stat_annual') }}</div>
                    </div>
                    <div class="bg-white/80 dark:bg-white/5 backdrop-blur-2xl border border-slate-200/60 dark:border-white/10 p-10 rounded-[40px] relative group overflow-hidden">
                        <div class="absolute top-0 end-0 w-32 h-32 bg-primary/10 rounded-bl-full translate-x-8 -translate-y-8 group-hover:translate-x-4 group-hover:-translate-y-4 transition-transform"></div>
                        <span class="material-symbols-outlined text-primary text-4xl mb-4">groups</span>
                        <div class="text-5xl font-black text-slate-900 dark:text-white mb-2">{{ $totalActive ?? 0 }}+</div>
                        <div class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-[0.2em] font-black">{{ __('ui.grants_stat_active') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
