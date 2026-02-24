@php
    $isRtl = app()->getLocale() === 'ar';
    $mainUrl = rtrim(config('app.main_site_url', 'https://bzufa.com'), '/');
@endphp
<nav class="sticky top-0 z-50 bg-white/95 dark:bg-background-darks/95 backdrop-blur-md border-b border-slate-200 dark:border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 h-16 flex items-center justify-between">
        <div class="flex items-center gap-8 xl:gap-12">
            <a href="/" class="shrink-0 transition-transform hover:scale-105">
                <img src="{{ asset('assets/img/KANANI-Logo-l.svg') }}" alt="Logo" class="h-10 dark:hidden" onerror="this.style.display='none'">
                <img src="{{ asset('assets/img/KANANI-Logo-d.svg') }}" alt="Logo" class="h-10 hidden dark:block" onerror="this.style.display='none'">
            </a>
            <div class="hidden ms-12 lg:flex items-center gap-5 xl:gap-8">
                <a class="text-sm font-medium text-primarys transition-colors" href="{{ route('store.index') }}" style="color: #96194A;">{{ __('ui.nav_products') }}</a>
                <a class="text-sm font-medium hover:text-primarys transition-colors text-slate-600 dark:text-slate-300" href="{{ $mainUrl }}/">{{ __('ui.nav_association') }}</a>
                <div class="relative group">
                    <button type="button" class="flex items-center gap-1 text-sm font-medium hover:text-primarys transition-colors text-slate-600 dark:text-slate-300">
                        <span>{{ __('ui.nav_about') }}</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:rotate-180 transition-transform">expand_more</span>
                    </button>
                    <ul class="absolute {{ $isRtl ? 'start-0' : 'end-0' }} mt-2 w-48 bg-white dark:bg-slate-800 border border-slate-100 dark:border-white/10 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-2">
                        <li><a href="{{ $mainUrl }}/about-us" class="block px-4 py-2 text-sm hover:bg-primarys/10 hover:text-primarys transition-colors">{{ __('ui.nav_about') }}</a></li>
                        <li><a href="{{ $mainUrl }}/our-team" class="block px-4 py-2 text-sm hover:bg-primarys/10 hover:text-primarys transition-colors">{{ __('ui.nav_our_team') }}</a></li>
                    </ul>
                </div>
              
            </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-6">
            <div class="hidden md:block relative" id="store-search-wrapper">
                <form action="{{ route('store.index') }}" method="get" class="relative" id="store-nav-search-form">
                    <input name="q" value="{{ request('q') }}" autocomplete="off"
                        class="bg-slate-100 dark:bg-surface-darks border border-slate-200 dark:border-primarys/20 rounded-lg py-2 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primarys w-64 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500"
                        placeholder="{{ __('ui.store_search') ?? 'بحث عن منتجات...' }}" type="text" id="store-nav-search" />
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-slate-500 dark:text-[#9cbaaf] hover:text-primarys transition-colors">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
                <div id="store-search-dropdown" class="absolute {{ $isRtl ? 'right-0' : 'left-0' }} top-full mt-2 w-80 max-h-[70vh] overflow-hidden bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-xl shadow-2xl opacity-0 invisible transition-all duration-300 z-[100] flex flex-col">
                    <div id="store-search-loading" class="hidden py-6 text-center text-slate-400 text-sm">{{ __('ui.loading') ?? 'جاري التحميل...' }}</div>
                    <div id="store-search-empty" class="hidden py-6 text-center text-slate-500 dark:text-slate-400 text-sm px-4">{{ __('ui.store_search_no_results') ?? 'لا توجد نتائج' }}</div>
                    <div id="store-search-results" class="overflow-y-auto flex-1 p-2 space-y-1"></div>
                </div>
            </div>
            <div class="flex items-center gap-4 relative store-cart-group" id="store-cart-wrapper">
                <a href="{{ route('store.cart') }}" id="store-cart-link" class="p-2 hover:bg-primarys/10 rounded-lg relative" title="{{ __('ui.store_nav') }}">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    <span id="store-cart-count" class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1 bg-primarys text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-background-lights dark:border-background-darks" data-initial="0">0</span>
                </a>
                <div id="store-cart-dropdown" class="absolute {{ $isRtl ? 'left-0' : 'right-0' }} top-full mt-2 w-80 max-h-[70vh] overflow-hidden bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-xl shadow-2xl opacity-0 invisible transition-all duration-300 z-[100] flex flex-col">
                    <div id="store-cart-dropdown-body" class="overflow-y-auto flex-1 p-4 min-h-[80px]">
                        <div id="store-cart-loading" class="hidden py-8 text-center text-slate-400 text-sm">{{ __('ui.loading') ?? 'جاري التحميل...' }}</div>
                        <div id="store-cart-empty" class="hidden py-8 text-center text-slate-500 dark:text-slate-400 text-sm">{{ __('ui.store_cart_empty') ?? 'السلة فارغة' }}</div>
                        <div id="store-cart-items-list" class="space-y-3"></div>
                    </div>
                    <div id="store-cart-dropdown-footer" class="hidden p-4 border-t border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-800/50">
                        <div class="flex justify-between items-center text-sm font-bold mb-3">
                            <span>{{ __('ui.store_cart_total') ?? 'المجموع' }}</span>
                            <span id="store-cart-total" class="text-primarys">0 {{ __('ui.currency_nis') }}</span>
                        </div>
                        <a href="{{ route('store.cart') }}" id="store-cart-view-link" class="block w-full text-center bg-primarys text-white py-2.5 rounded-lg font-bold hover:opacity-90 transition-opacity" style="background-color:#96194A;">{{ __('ui.store_view_cart') ?? 'عرض السلة' }}</a>
                    </div>
                </div>
            </div>
            <a href="{{ route('locale.switch', ['locale' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}" class="flex items-center gap-1 hover:text-primarys transition-colors text-sm font-medium text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined text-[20px]">language</span>
                <span class="hidden sm:inline">{{ __('ui.nav_lang_switch') }}</span>
            </a>
            <button id="store-mobile-menu-btn" type="button" class="lg:hidden p-2 text-slate-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-3xl" id="store-menu-icon">menu</span>
            </button>
        </div>
    </div>

    <div id="store-mobile-menu" class="lg:hidden hidden bg-white dark:bg-background-darks border-b border-slate-200 dark:border-white/10 max-h-[calc(100vh-64px)] overflow-y-auto">
        <div class="flex flex-col p-4 space-y-4">
            <form action="{{ route('store.index') }}" method="get" class="px-2">
                <div class="relative">
                    <input name="q" value="{{ request('q') }}" placeholder="{{ __('ui.store_search') ?? 'بحث عن منتجات...' }}" type="text"
                        class="w-full bg-slate-100 dark:bg-surface-darks border border-slate-200 dark:border-primarys/20 rounded-lg py-2 pl-4 pr-10 text-sm text-slate-900 dark:text-white placeholder:text-slate-400" />
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-primarys">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </button>
                </div>
            </form>
            <a href="{{ route('store.index') }}" class="text-base font-semibold text-primarys px-4">{{ __('ui.nav_products') }}</a>
            <a href="{{ $mainUrl }}/" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_association') }}</a>
            <div class="px-4 border-s-2 border-primarys/20 ms-2">
                <span class="text-xs font-bold text-primarys uppercase">{{ __('ui.nav_about') }}</span>
                <div class="flex flex-col mt-2 gap-3 ps-4">
                    <a href="{{ $mainUrl }}/about-us" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_about') }}</a>
                    <a href="{{ $mainUrl }}/our-team" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_our_team') }}</a>
                </div>
            </div>
            <a href="{{ $mainUrl }}/projects/kanani" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_kanani') }}</a>
            <a href="{{ $mainUrl }}/projects/tamkeen" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_tamkeen') }}</a>
            <a href="{{ $mainUrl }}/projects/parasols" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_parasols') }}</a>
            <a href="{{ $mainUrl }}/grants" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_grants') }}</a>
            <a href="{{ $mainUrl }}/success-partners" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_partners') }}</a>
            <a href="{{ route('locale.switch', ['locale' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">language</span>
                {{ __('ui.nav_lang_switch') }}
            </a>
        </div>
    </div>
</nav>

{{-- Social sidebar (fixed) --}}
@php
    $fb = $siteSetting?->facebook_url ?? null;
    $tw = $siteSetting?->twitter_url ?? null;
    $ig = $siteSetting?->instagram_url ?? null;
    $li = $siteSetting?->linkedin_url ?? null;
    $wa = $siteSetting?->whatsapp_url ?? null;
    $email = $siteSetting?->contact_email ?? null;
    $siteUrl = url()->current();
    $hasSocial = $fb || $tw || $ig || $li || $wa || $email || true;
@endphp
@if($hasSocial)
<aside class="fixed {{ $isRtl ? 'left-4' : 'right-4' }} top-1/2 -translate-y-1/2 z-[60] hidden xl:flex flex-col gap-3 p-2 rounded-2xl bg-white/80 dark:bg-slate-800/60 backdrop-blur-md shadow-xl border border-slate-200 dark:border-slate-700">
    @if($fb)
    <a class="social-icon social-fb w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(24,119,242,0.5)] text-slate-400 dark:text-slate-500 hover:!text-[#1877F2]" href="{{ $fb }}" target="_blank" rel="noopener noreferrer" title="Facebook">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
    </a>
    @endif
    @if($tw)
    <a class="social-icon social-tw w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(0,0,0,0.3)] text-slate-400 dark:text-slate-500 hover:!text-[#000]" href="{{ $tw }}" target="_blank" rel="noopener noreferrer" title="X">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
    </a>
    @endif
    @if($ig)
    <style>.social-ig:hover svg, .social-ig:hover svg path { fill: url(#ig-gradient-nav) !important; }</style>
    <a class="social-icon social-ig w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(253,29,29,0.5)] text-slate-400 dark:text-slate-500" href="{{ $ig }}" target="_blank" rel="noopener noreferrer" title="Instagram">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><defs><linearGradient id="ig-gradient-nav" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:#833AB4"/><stop offset="50%" style="stop-color:#FD1D1D"/><stop offset="100%" style="stop-color:#F77737"/></linearGradient></defs><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
    </a>
    @endif
    @if($li)
    <a class="social-icon social-li w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(10,102,194,0.5)] text-slate-400 dark:text-slate-500 hover:!text-[#0A66C2]" href="{{ $li }}" target="_blank" rel="noopener noreferrer" title="LinkedIn">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></path></svg>
    </a>
    @endif
    @if($wa)
    <a class="social-icon social-wa w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(37,211,102,0.5)] text-slate-400 dark:text-slate-500 hover:!text-[#25D366]" href="{{ $wa }}" target="_blank" rel="noopener noreferrer" title="WhatsApp">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></path></svg>
    </a>
    @endif
    @if($email)
    <a class="social-icon w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(234,67,53,0.5)] text-slate-400 dark:text-slate-500 hover:!text-[#EA4335]" href="mailto:{{ $email }}" title="{{ __('ui.email') ?? 'البريد الإلكتروني' }}">
        <span class="material-symbols-outlined text-[22px]">mail</span>
    </a>
    @endif
    <button type="button" class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(150,25,74,0.4)] text-slate-400 dark:text-slate-500 hover:!text-primarys store-copy-link-btn" data-url="{{ $siteUrl }}" title="{{ __('ui.copy_link') ?? 'نسخ رابط الصفحة' }}" style="--hover-primary: #96194A;">
        <span class="material-symbols-outlined text-[22px]">link</span>
    </button>
</aside>
@endif
