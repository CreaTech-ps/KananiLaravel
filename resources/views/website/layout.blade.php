@php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html class="dark" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" lang="{{ $locale }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seo = $seo ?? \App\Models\SeoSetting::get();
        $siteTitle = localized($seo, 'site_title') ?? __('ui.site_name');
    @endphp
    <title>@hasSection('title')@yield('title') — {{ $siteTitle }}@else{{ $siteTitle }}@endif</title>
    @if(!empty(localized($seo, 'meta_description')))
        <meta name="description" content="{{ Str::limit(strip_tags(localized($seo, 'meta_description')), 160) }}">
    @endif
    @if(!empty(localized($seo, 'meta_keywords')))
        <meta name="keywords" content="{{ strip_tags(localized($seo, 'meta_keywords')) }}">
    @endif
    @if(isset($seo->allow_indexing) && !$seo->allow_indexing)
        <meta name="robots" content="noindex, nofollow">
    @endif
    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $seo->og_type ?? 'website' }}">
    <meta property="og:title" content="{{ localized($seo, 'og_title') ?? $siteTitle }}">
    @if(!empty(localized($seo, 'og_description')))
        <meta property="og:description" content="{{ Str::limit(strip_tags(localized($seo, 'og_description')), 200) }}">
    @endif
    @if(!empty($seo->og_image_path))
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image_path) }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_AR' : 'en_GB' }}">
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $seo->twitter_card_type ?? 'summary_large_image' }}">
    @if(!empty($seo->twitter_site))
        <meta name="twitter:site" content="{{ $seo->twitter_site }}">
    @endif
    {{-- Google / Bing verification --}}
    @if(!empty($seo->google_site_verification))
        <meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
    @endif
    @if(!empty($seo->bing_verification))
        <meta name="msvalidate.01" content="{{ $seo->bing_verification }}">
    @endif
    @if(!empty($seo->custom_meta_tags))
        {!! $seo->custom_meta_tags !!}
    @endif
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}" />
    
    {{-- Alternate language links (hreflang) --}}
    @php
        try {
            $currentRoute = request()->route()->getName();
            $currentParams = request()->route()->parameters();
            $arUrl = LaravelLocalization::getLocalizedURL('ar', null, [], true);
            $enUrl = LaravelLocalization::getLocalizedURL('en', null, [], true);
        } catch (\Exception $e) {
            $arUrl = url('/');
            $enUrl = url('/en');
        }
    @endphp
    <link rel="alternate" hreflang="ar" href="{{ $arUrl }}" />
    <link rel="alternate" hreflang="en" href="{{ $enUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $arUrl }}" />
    {{-- Preconnect to external domains for performance --}}
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    
    {{-- DNS Prefetch for CDNs --}}
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com" />
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net" />
    <link rel="dns-prefetch" href="https://www.googletagmanager.com" />
    
    {{-- Preload critical fonts --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&amp;display=swap" as="style" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&amp;display=swap"
        rel="stylesheet" media="print" onload="this.media='all'" />
    <noscript><link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&amp;display=swap" rel="stylesheet" /></noscript>
    
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" media="print" onload="this.media='all'" />
    <noscript><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" /></noscript>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Swiper CSS - defer loading --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'" />
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /></noscript>

    {{-- Main CSS --}}
    <link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    {{-- Swiper JS - defer loading --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    
    {{-- Main JS --}}
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
    @if(!empty($seo->google_analytics_id))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seo->google_analytics_id }}', {
                'send_page_view': false
            });
        </script>
    @endif
    @if(!empty($seo->organization_schema))
        <script type="application/ld+json">{!! $seo->organization_schema !!}</script>
    @endif
    @yield('styles')

</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-text-primary-dark transition-colors duration-300">
    @include('website.partials.navbar')
    @include('website.partials.social-bar')
    <main>
        @yield('content')
    </main>
    @include('website.partials.footer')
    <button
        class="fixed bottom-6 ltr:right-6 ltr:left-auto rtl:left-6 rtl:right-auto w-12 h-12 bg-white dark:bg-card-dark border border-slate-200 dark:border-white/10 rounded-full shadow-2xl flex items-center justify-center z-50 hover:scale-110 transition-all"
        id="theme-toggle" onclick="toggleDarkMode()">
        <span class="material-symbols-outlined dark:hidden" id="theme-toggle-dark-icon">dark_mode</span>
        <span class="material-symbols-outlined hidden dark:block text-yellow-400"
            id="theme-toggle-light-icon">light_mode</span>
    </button>


   


    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        themeToggleBtn.addEventListener('click', function() {
            htmlElement.classList.toggle('dark');
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
        // Check for saved theme preference
        if (localStorage.getItem('theme') === 'light') {
            htmlElement.classList.remove('dark');
        } else {
            htmlElement.classList.add('dark');
        }
    </script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>