@extends('website.layout')

@push('scripts')
{{-- Structured Data (Schema.org) for Organization --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": {{ json_encode(__('ui.site_name')) }},
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/img/logo-l-en.svg') }}",
    "sameAs": [
        @if(!empty($seo->facebook_url ?? ''))
        "{{ $seo->facebook_url }}",
        @endif
        @if(!empty($seo->twitter_url ?? ''))
        "{{ $seo->twitter_url }}",
        @endif
        @if(!empty($seo->instagram_url ?? ''))
        "{{ $seo->instagram_url }}",
        @endif
        @if(!empty($seo->linkedin_url ?? ''))
        "{{ $seo->linkedin_url }}"
        @endif
    ],
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "availableLanguage": ["ar", "en"]
    }
}
</script>
@endpush

@section('content')
<section class="relative min-h-[600px] flex items-center overflow-hidden">
            <div class="absolute inset-0 -z-20">
                <img src="{{ asset('assets/img/hero-bg.webp') }}" class="w-full h-full opacity-100 object-cover" alt="Background" loading="eager" fetchpriority="high" width="1920" height="1080">
                <div class="absolute inset-0 bg-white/90 dark:bg-slate-950/90 backdrop-blur-[2px]"></div>
            </div>

            <div class="absolute top-0 inset-inline-end-0 -z-10 opacity-20 dark:opacity-30 pointer-events-none">
                <svg fill="none" height="600" viewBox="0 0 600 600" width="600" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="300" cy="300" fill="url(#paint0_radial)" r="300"></circle>
                    <defs>
                        <radialGradient id="paint0_radial" cx="0" cy="0"
                            gradientTransform="translate(300 300) rotate(90) scale(300)" gradientUnits="userSpaceOnUse"
                            r="1">
                            <stop stop-color="#0BA66D"></stop>
                            <stop offset="1" stop-color="#0BA66D" stop-opacity="0"></stop>
                        </radialGradient>
                    </defs>
                </svg>
            </div>

            <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="order-2 lg:order-2 relative flex justify-center items-center">
                        <div class="relative group p-4">
                            @if(($homeSetting->hero_type ?? 'image') === 'video' && !empty($homeSetting->hero_media_path))
                            <div class="w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 aspect-video bg-black">
                                <video class="w-full h-full object-cover" autoplay muted loop playsinline
                                    src="{{ asset('storage/' . $homeSetting->hero_media_path) }}">
                                </video>
                            </div>
                            @else
                            <img alt="Student Empowerment" class="w-full h-full object-cover"
                                src="{{ asset('assets/img/hero-f.webp') }}" loading="eager" fetchpriority="high" width="800" height="600" />
                            @endif
                        </div>
                    </div>

                    <div class="order-1 lg:order-1 text-center lg:text-start">
                        <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold leading-tight mb-6">
                            @php
                                $heroTitle = localized($homeSetting, 'hero_title') ?? __('ui.hero_default_title');
                                $sep = app()->getLocale() === 'ar' ? '،' : ',';
                                $titleParts = str_contains($heroTitle, $sep) ? explode($sep, $heroTitle, 2) : [$heroTitle, ''];
                            @endphp
                            <span class="block text-slate-900 dark:text-white">{{ trim($titleParts[0]) }}@if(!empty(trim($titleParts[1] ?? ''))){{ $sep }}@endif</span>
                            <span class="block text-primary">{{ trim($titleParts[1] ?? '') ?: __('ui.hero_default_line2') }}</span>
                        </h1>

                        <p
                            class="text-lg md:text-xl text-slate-700 dark:text-slate-300 mb-10 max-w-2xl lg:ms-0 lg:mx-auto leading-relaxed">
                            {{ localized($homeSetting, 'hero_subtitle') ?? __('ui.hero_default_subtitle') }}
                        </p>

                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="{{ $homeSetting->cta_url ?? '#' }}"
                                class="bg-primary hover:bg-opacity-90 text-white px-8 lg:px-12 py-4 rounded-full text-lg lg:text-xl font-bold transition-all hover:scale-105 shadow-xl shadow-primary/30 text-center">
                                {{ localized($homeSetting, 'cta_text') ?? __('ui.donate_now') }}
                            </a>
                            @if(!empty($homeSetting->annual_report_pdf_path))
                            <a href="{{ asset('storage/' . $homeSetting->annual_report_pdf_path) }}" download
                                class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-700 text-slate-800 dark:text-white px-8 lg:px-12 py-4 rounded-full text-lg lg:text-xl font-bold transition-all inline-flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">download</span>
                                {{ __('ui.annual_report') }}
                            </a>
                            @else
                            <span class="bg-white/50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-500 px-8 lg:px-12 py-4 rounded-full text-lg lg:text-xl font-bold cursor-default inline-flex items-center justify-center gap-2">
                                {{ __('ui.annual_report') }}
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="main-container">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($statistics as $stat)
                    <div
                        class="group bg-white dark:bg-card-dark p-8 rounded-3xl shadow-xl hover:shadow-2xl dark:shadow-card border border-slate-100 dark:border-white/5 text-center flex flex-col items-center transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                        <div
                            class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full group-hover:scale-150 transition-transform duration-700">
                        </div>

                        <div
                            class="w-14 h-14 bg-green-100 dark:bg-primary/20 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-[10deg] transition-transform duration-300 shadow-inner">
                            <span class="material-symbols-outlined text-3xl">{{ $stat->icon ?? 'analytics' }}</span>
                        </div>
                        <h3 class="text-4xl font-black mb-2 dark:text-white flex items-center gap-1">
                            <span>+</span>
                            <span class="counter" data-target="{{ $stat->value }}">0</span>
                        </h3>
                        <p class="text-slate-500 dark:text-text-secondary-dark font-bold tracking-wide">{{ localized($stat, 'label') }}</p>
                    </div>
                    @empty
                    @foreach([
                        ['value' => 1200, 'icon' => 'history_edu', 'label' => __('ui.stat_scholarship')],
                        ['value' => 850, 'icon' => 'model_training', 'label' => __('ui.stat_beneficiary')],
                        ['value' => 45, 'icon' => 'handshake', 'label' => __('ui.stat_partner')],
                        ['value' => 300, 'icon' => 'workspace_premium', 'label' => __('ui.stat_success_story')],
                    ] as $stat)
                    <div
                        class="group bg-white dark:bg-card-dark p-8 rounded-3xl shadow-xl hover:shadow-2xl dark:shadow-card border border-slate-100 dark:border-white/5 text-center flex flex-col items-center transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                        <div
                            class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <div
                            class="w-14 h-14 bg-green-100 dark:bg-primary/20 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-[10deg] transition-transform duration-300 shadow-inner">
                            <span class="material-symbols-outlined text-3xl">{{ $stat['icon'] }}</span>
                        </div>
                        <h3 class="text-4xl font-black mb-2 dark:text-white flex items-center gap-1">
                            <span>+</span>
                            <span class="counter" data-target="{{ $stat['value'] }}">0</span>
                        </h3>
                        <p class="text-slate-500 dark:text-text-secondary-dark font-bold tracking-wide">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                    @endforelse
                </div>
            </div>
        </section>

        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-[#151515]">
            <div class="main-container">
                <div class="flex items-center justify-between mb-12">
                    <div class="text-start">
                        <h2 class="text-3xl font-extrabold mb-2 dark:text-white">{{ __('ui.our_projects') }}</h2>
                        <div class="h-1 w-20 bg-primary rounded-full"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <div
                        class="bg-white dark:bg-card-dark rounded-2xl overflow-hidden shadow-lg dark:shadow-card border border-slate-200 dark:border-white/5 group flex flex-col h-full">
                        <div class="relative h-56 overflow-hidden shrink-0">
                            <img alt="{{ __('ui.project_tamkeen') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUPXODDN0v4kZRHFbTZmKaHw3iMD1kBS1QCI9FQqCTASiLUm9InU61rKi8Q-r3eIc0AwfzPP6ALeGWWyKQpa6W0Ah_bJlI_XqF0YWlOV5JSta7QRyYGtMFjvBfwkyE8mD94y2ZXYJ0-Jmk6zpOiYygCH2xYPO4Pl2OvCpQhXhD9ldBmEZwKDD_oT3V-2-zcMLyHtQfFLqywbB6EXQrS87kZBz5xW6_zBzYI4ttU2scrOq0k3jXqEDI11UpfnGsx4AqKqq9NpEb5-4" />
                            <span
                                class="absolute top-4 start-4 bg-black/50 backdrop-blur-md text-white text-xs px-3 py-1 rounded-full">{{ __('ui.badge_training') }}</span>
                        </div>
                        <div class="p-6 text-start flex flex-col flex-1">
                            <h3 class="text-xl font-bold mb-3 dark:text-white">{{ __('ui.project_tamkeen') }}</h3>
                            <p
                                class="text-slate-500 dark:text-text-secondary-dark text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ __('ui.project_tamkeen_desc') }}
                            </p>
                            <div class="mb-6">
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <div class="flex gap-1 dark:text-text-primary-dark items-center">
                                        <span>{{ __('ui.trained_count') }}</span>
                                        <span class="text-primary">150</span>
                                        <span>{{ __('ui.students') }}</span>
                                    </div>
                                    <span class="text-primary">85%</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-white/10 h-2 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 85%"></div>
                                </div>
                                <div class="text-xs text-slate-400 dark:text-text-secondary-dark mt-2 flex gap-1">
                                    <span>{{ __('ui.annual_goal') }}</span>
                                    <span>180</span>
                                    <span>{{ __('ui.trainees') }}</span>
                                </div>
                            </div>
                            <a href="{{ localized_route('tamkeen.index') }}"
                                class="w-full mt-auto bg-primary/10 text-primary dark:bg-primary/20 hover:bg-primary hover:text-white font-bold py-3 rounded-xl transition-all border border-primary/20 text-center">{{ __('ui.training_details') }}</a>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-card-dark rounded-2xl overflow-hidden shadow-lg dark:shadow-card border border-slate-200 dark:border-white/5 group flex flex-col h-full">
                        <div class="relative h-56 overflow-hidden shrink-0">
                            <img alt="{{ __('ui.project_kanani') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQY8R4Twui0hp8dUIuUzD7L84f-wRhijJUFEa6zaCY5trVngdMHRT48eILB4Hkux_96PIY7SLsIu1ZxTX0mneM2OgUp4c2OxAmEocmrh8iDC5YG5YF7oPPDxrQtg5GTAzgWXpcKCmhNX5QKVAT64PhLVXQXaVks3eA2NEoR475Nfc1NmxfkD1vrWWSaQAdaVER9xCQSlFBubc6wgKnMfCBGgfT2cavonrcSNBP1MK8SyePyG4U61HvpaiyhWpXuINjlEkwZeTneEw" />
                            <span
                                class="absolute top-4 end-4 px-3 bg-primary text-white text-xs font-bold py-1 rounded-full uppercase">{{ __('ui.badge_our_store') }}</span>
                            <span
                                class="absolute top-4 start-4 bg-black/50 backdrop-blur-md text-white text-xs px-3 py-1 rounded-full">{{ __('ui.badge_hand_in_hand') }}</span>
                        </div>
                        <div class="p-6 text-start flex flex-col flex-1">
                            <h3 class="text-xl font-bold mb-3 dark:text-white">{{ __('ui.project_kanani') }}</h3>
                            <p
                                class="text-slate-500 dark:text-text-secondary-dark text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ __('ui.project_kanani_desc') }}
                            </p>
                            <div class="mb-6">
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <div class="flex gap-1 dark:text-text-primary-dark items-center">
                                        <span>{{ __('ui.provided_count') }}</span>
                                        <span class="text-primary">420</span>
                                        <span>{{ __('ui.scholarships_count') }}</span>
                                    </div>
                                    <span class="text-primary">70%</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-white/10 h-2 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 70%"></div>
                                </div>
                                <div class="text-xs text-slate-400 dark:text-text-secondary-dark mt-2 flex gap-1">
                                    <span>{{ __('ui.grants_goal') }}</span>
                                    <span>600</span>
                                    <span>{{ __('ui.scholarships_count') }}</span>
                                </div>
                            </div>
                            <a href="{{ localized_route('kanani.index') }}"
                                class="w-full mt-auto bg-primary/10 text-primary dark:bg-primary/20 hover:bg-primary hover:text-white font-bold py-3 rounded-xl transition-all border border-primary/20 text-center">{{ __('ui.visit_store') }}</a>

                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-card-dark rounded-2xl overflow-hidden shadow-lg dark:shadow-card border border-slate-200 dark:border-white/5 group flex flex-col h-full">
                        <div class="relative h-56 overflow-hidden shrink-0">
                            <img alt="{{ __('ui.project_parasols') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjhSMsb_wCIv9rqETWGjnkWrFDfjmQV4YUiK4WowuP8SR5z81I-kzL6KIxOjY_iOmYwrRKdFoeOcnnqH8waRG9oYyg1w7L9MBBO5Bw6ayf98MAxtX0ZqyMKjWjlmJaBZS_a6WTY8tUWCyUkq80PH2lYK_7-PEu0bxAVbjB12J24CtxUAxQ8iOKBxI1HVbVWC67ttLNw4tfXwDJiAVLy5-ITyBKBu9eV99hU7AZFj650a4bmSRUKAJDdH9m6RSkc6C1nAtW_A6FYDE" />
                            <span
                                class="absolute top-4 end-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">{{ __('ui.badge_sustainability') }}</span>
                            <span
                                class="absolute top-4 start-4 bg-black/50 backdrop-blur-md text-white text-xs px-3 py-1 rounded-full">{{ __('ui.badge_student_fund') }}</span>
                        </div>
                        <div class="p-6 text-start flex flex-col flex-1">
                            <h3 class="text-xl font-bold mb-3 dark:text-white">{{ __('ui.project_parasols') }}</h3>
                            <p
                                class="text-slate-500 dark:text-text-secondary-dark text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ __('ui.project_parasols_desc') }}
                            </p>
                            <div class="mb-6">
                                <div class="flex justify-between text-sm font-bold mb-2">
                                    <div class="flex gap-1 dark:text-text-primary-dark items-center">
                                        <span>{{ __('ui.vacancy_rate') }}</span>
                                    </div>
                                    <span class="text-primary">62%</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-white/10 h-2 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 62%"></div>
                                </div>
                                <div class="text-xs text-slate-400 dark:text-text-secondary-dark mt-2 flex gap-1">
                                    <span>{{ __('ui.goal_reach') }}</span>
                                </div>
                            </div>
                            <a href="{{ localized_route('parasols.index') }}"
                                class="w-full mt-auto bg-primary/10 text-primary dark:bg-primary/20 hover:bg-primary hover:text-white font-bold py-3 rounded-xl transition-all border border-primary/20 text-center">{{ __('ui.view_vacancies') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-primary text-white relative overflow-hidden">
            <div
                class="absolute top-0 start-0 w-32 h-32 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl">
            </div>

            <div class="main-container">
                <div class="swiper successStoriesSwiper">
                    <div class="swiper-wrapper">

                        @forelse($successStories as $story)
                        <div class="swiper-slide">
                            <div class="flex flex-col items-center text-center max-w-4xl mx-auto px-4">
                                <div
                                    class="inline-block bg-white/20 px-4 py-1 rounded-full text-xs md:text-sm font-bold mb-8 backdrop-blur-sm">
                                    {{ __('ui.testimonials') }}
                                </div>

                                @if(localized($story, 'content'))
                                <blockquote
                                    class="text-2xl md:text-4xl font-extrabold leading-snug mb-10 italic drop-shadow-md">
                                    "{{ localized($story, 'content') }}"
                                </blockquote>
                                @endif

                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-20 h-20 rounded-full border-4 border-white/30 overflow-hidden mb-4 shadow-2xl">
                                        @if($story->image_path)
                                        <img alt="{{ localized($story, 'title') }}" class="w-full h-full object-cover"
                                            src="{{ asset('storage/' . $story->image_path) }}" />
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-white/10">
                                            <span class="material-symbols-outlined text-4xl text-white/50">person</span>
                                        </div>
                                        @endif
                                    </div>
                                    <h4 class="text-xl font-bold">{{ localized($story, 'title') }}</h4>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="flex flex-col items-center text-center max-w-4xl mx-auto px-4">
                                <div
                                    class="inline-block bg-white/20 px-4 py-1 rounded-full text-xs md:text-sm font-bold mb-8 backdrop-blur-sm">
                                    {{ __('ui.testimonials') }}
                                </div>
                                <p class="text-2xl font-bold max-w-2xl mx-auto text-white/90">{{ __('ui.testimonials_empty') }}</p>
                            </div>
                        </div>
                        @endforelse
                    </div>


                </div>

                <div class="flex justify-center gap-6 mt-6">
                    <button
                        class="swiper-button-prev-custom cursor-pointer w-12 h-12 rounded-full border border-white/30 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 group">
                        <span
                            class="material-symbols-outlined rtl:rotate-0 ltr:rotate-180 group-active:scale-90">arrow_forward</span>
                    </button>
                    <button
                        class="swiper-button-next-custom cursor-pointer w-12 h-12 rounded-full border border-white/30 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 group">
                        <span
                            class="material-symbols-outlined rtl:rotate-0 ltr:rotate-180 group-active:scale-90">arrow_back</span>
                    </button>
                </div>
            </div>
        </section>

        <section
            class="py-16 md:py-20 bg-white dark:bg-background-dark overflow-hidden border-y border-slate-50 dark:border-white/5">
            <div class="main-container text-center">

                <div class="flex flex-col items-center mb-16">
                    <span
                        class="text-primary font-bold text-sm bg-primary/10 px-4 py-1 rounded-full mb-4 tracking-wider">
                        {{ __('ui.success_network') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-white relative inline-block">
                        {{ __('ui.partners_heading') }}
                    </h2>
                    <p class="mt-6 text-slate-500 dark:text-slate-400 max-w-xl mx-auto">
                        {{ __('ui.partners_subheading') }}
                    </p>
                </div>

                <div class="relative flex overflow-hidden group mb-16" dir="ltr">
                    <div
                        class="absolute inset-y-0 start-0 w-20 bg-gradient-to-r rtl:bg-gradient-to-l from-white dark:from-background-dark to-transparent z-10">
                    </div>

                    <div
                        class="absolute inset-y-0 end-0 w-20 bg-gradient-to-l rtl:bg-gradient-to-r from-white dark:from-background-dark to-transparent z-10">
                    </div>

                    <div
                        class="flex animate-infinite-scroll rtl:direction-reverse gap-24 items-center whitespace-nowrap">
                        @php $partnerLogoClass = 'max-h-12 w-auto min-w-[120px] object-contain transition-all duration-500'; @endphp
                        <div class="flex gap-24 items-center flex-shrink-0">
                            @forelse($partners as $partner)
                            <a href="{{ $partner->link ?? '#' }}" {{ $partner->link ? 'target="_blank" rel="noopener"' : '' }}
                                class="block focus:outline-none">
                                <img alt="{{ localized($partner, 'name') }}"
                                    class="{{ $partnerLogoClass }}"
                                    src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : asset('assets/img/logo-l.svg') }}" />
                            </a>
                            @empty
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            @endforelse
                        </div>
                        <div class="flex gap-24 items-center flex-shrink-0">
                            @forelse($partners as $partner)
                            <a href="{{ $partner->link ?? '#' }}" {{ $partner->link ? 'target="_blank" rel="noopener"' : '' }}
                                class="block focus:outline-none">
                                <img alt="{{ localized($partner, 'name') }}"
                                    class="{{ $partnerLogoClass }}"
                                    src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : asset('assets/img/logo-l.svg') }}" />
                            </a>
                            @empty
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            <img alt="Partner" class="{{ $partnerLogoClass }}" src="{{ asset('assets/img/logo-l.svg') }}" />
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ localized_route('partners.index') }}"
                        class="inline-flex items-center gap-3 bg-white dark:bg-card-dark text-slate-700 dark:text-white border border-slate-200 dark:border-white/10 px-8 py-3.5 rounded-full font-bold hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm hover:shadow-lg group">
                        <span>{{ __('ui.view_all_partners') }}</span>
                        <span
                            class="material-symbols-outlined transition-transform duration-300 rtl:rotate-0 ltr:rotate-180 group-hover:translate-x-[-4px] ltr:group-hover:translate-x-[4px]">
                            arrow_back
                        </span>
                    </a>
                </div>

            </div>
        </section>

        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-[#151515]">
            <div class="main-container">
                <div class="flex items-center justify-between mb-12">
                    <div class="text-start">
                        <h2 class="text-3xl font-extrabold mb-2 dark:text-white">{{ __('ui.news_heading') }}</h2>
                        <div class="h-1 w-20 bg-primary rounded-full"></div>
                    </div>
                    <a href="{{ localized_route('news.index') }}"
                        class="bg-white dark:bg-card-dark border border-slate-200 dark:border-white/5 px-6 py-2 rounded-full font-bold shadow-sm hover:shadow-md transition-all dark:text-text-primary-dark text-sm">
                        {{ __('ui.browse_blog') }}
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @forelse($newsItems as $item)
                    <a href="{{ localized_route('news.show', ['slug' => current_slug($item)]) }}"
                        class="group bg-white dark:bg-white/[0.02] rounded-2xl overflow-hidden border border-slate-100 dark:border-white/5 hover:border-primary/20 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 flex flex-col h-full block">
                        <div class="relative h-56 overflow-hidden">
                            <img alt="{{ localized($item, 'title') }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 duration-700 ease-out"
                                src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/400x300?text=News' }}" 
                                loading="lazy" width="400" height="300" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>
                            <span
                                class="absolute top-6 start-6 bg-primary/90 backdrop-blur-md text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-tighter">{{ __('ui.view_all') }}</span>
                        </div>

                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 text-slate-400 text-[11px] font-bold mb-4">
                                <span class="material-symbols-outlined text-sm text-primary">calendar_today</span>
                                {{ $item->published_at?->locale(app()->getLocale())->translatedFormat('d F Y') ?? '—' }}
                            </div>

                            <h3
                                class="text-xl font-black mb-4 leading-tight text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-2">
                                {{ localized($item, 'title') }}
                            </h3>
                            <div
                                class="mt-auto pt-6 border-t border-slate-50 dark:border-white/5 flex items-center justify-between">
                                <span class="flex items-center gap-2 text-primary font-black text-xs group/link">
                                    {{ __('ui.read_more') }}
                                    <span
                                        class="material-symbols-outlined text-sm transition-transform duration-300 rtl:rotate-0 ltr:rotate-180 rtl:group-hover/link:-translate-x-2 ltr:group-hover/link:translate-x-2">arrow_back</span>
                                </span>
                                <button type="button" onclick="event.preventDefault(); event.stopPropagation(); shareNews(this)"
                                    class="w-9 h-9 rounded-xl bg-slate-50 dark:bg-white/5 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all cursor-pointer"
                                    data-url="{{ url(localized_route('news.show', ['slug' => current_slug($item)])) }}"
                                    data-title="{{ e(localized($item, 'title')) }}">
                                    <span class="material-symbols-outlined text-lg">share</span>
                                </button>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-12 text-slate-500 dark:text-slate-400">
                        {{ __('ui.no_news') }}
                    </div>
                    @endforelse

                </div>
            </div>
        </section>

@push('scripts')
<script>
function shareNews(btn) {
    const url = btn.getAttribute('data-url');
    const title = btn.getAttribute('data-title') || document.title;
    const text = title;
    if (navigator.share) {
        navigator.share({ title, text, url }).catch(() => copyAndNotify(url));
    } else {
        copyAndNotify(url);
    }
}
function copyAndNotify(url) {
    navigator.clipboard.writeText(url).then(() => {
        if (typeof window.showShareToast === 'function') {
            window.showShareToast();
        } else {
            alert('{{ __("ui.link_copied") }}');
        }
    }).catch(() => {
        prompt('{{ __("ui.copy_link") }}', url);
    });
}
</script>
@endpush
@endsection
