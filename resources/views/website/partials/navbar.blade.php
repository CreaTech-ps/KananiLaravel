<nav class="sticky top-0 z-50 bg-white/95 dark:bg-background-dark/95 backdrop-blur-md border-b border-slate-200 dark:border-white/10">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        <div class="flex items-center gap-8 xl:gap-12">
            <a href="{{ localized_route('home') }}" class="shrink-0 transition-transform hover:scale-105">
                <img src="{{ asset('assets/img/KANANI-Logo-l.svg') }}" alt="{{ __('ui.site_name') }}" class="h-10 dark:hidden">
                <img src="{{ asset('assets/img/KANANI-Logo-d.svg') }}" alt="{{ __('ui.site_name') }}" class="h-10 hidden dark:block">
            </a>

            <div class="hidden lg:flex items-center gap-5 xl:gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300"
                    href="{{ localized_route('home') }}">{{ __('ui.nav_home') }}</a>

                <div class="relative group">
                    <button class="flex items-center gap-1 text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300">
                        <span>{{ __('ui.nav_about') }}</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:rotate-180 transition-transform">expand_more</span>
                    </button>
                    <ul class="absolute start-0 mt-2 w-48 bg-white dark:bg-card-dark border border-slate-100 dark:border-white/10 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-2">
                        <li><a href="{{ localized_route('about.index') }}" class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors">{{ __('ui.nav_about') }}</a></li>
                        <li><a href="{{ localized_route('team.index') }}" class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors">{{ __('ui.nav_our_team') }}</a></li>
                    </ul>
                </div>

                <div class="relative group">
                    <button class="flex items-center gap-1 text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300">
                        <span>{{ __('ui.nav_projects') }}</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:rotate-180 transition-transform">expand_more</span>
                    </button>
                    <ul class="absolute start-0 mt-2 w-56 bg-white dark:bg-card-dark border border-slate-100 dark:border-white/10 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-2">
                        <li><a href="{{ localized_route('kanani.index') }}" class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors">{{ __('ui.nav_kanani') }}</a></li>
                        <li><a href="{{ localized_route('tamkeen.index') }}" class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors">{{ __('ui.nav_tamkeen') }}</a></li>
                        <li><a href="{{ localized_route('parasols.index') }}" class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors">{{ __('ui.nav_parasols') }}</a></li>
                    </ul>
                </div>

                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300"
                    href="{{ localized_route('grants.index') }}">{{ __('ui.nav_grants') }}</a>
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300"
                    href="{{ localized_route('partners.index') }}">{{ __('ui.nav_partners') }}</a>
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-600 dark:text-slate-300"
                    href="{{ localized_route('news.index') }}">{{ __('ui.nav_news') }}</a>
            </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-6">
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale() === 'ar' ? 'en' : 'ar', null, [], true) }}"
                class="flex items-center gap-1 hover:text-primary transition-colors text-sm font-medium text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined text-[20px]">language</span>
                <span class="hidden sm:inline">{{ __('ui.nav_lang_switch') }}</span>
            </a>
            @php $homeSetting = \App\Models\HomeSetting::get(); @endphp
            <a href="{{ $homeSetting->cta_url ?? '#' }}"
                class="bg-primary text-white px-4 sm:px-6 py-2.5 rounded-full font-bold hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/20 text-xs sm:text-sm shrink-0">
                {{ localized($homeSetting, 'cta_text') ?? __('ui.donate_now') }}
            </a>

            <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg transition-colors" type="button" aria-label="{{ __('ui.menu') }}">
                <span class="material-symbols-outlined text-3xl" id="menu-icon">menu</span>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden bg-white dark:bg-background-dark border-b border-slate-200 dark:border-white/10 max-h-[calc(100vh-64px)] overflow-y-auto">
        <div class="flex flex-col p-4 space-y-4">
            <a href="{{ localized_route('home') }}" class="text-base font-semibold text-slate-900 dark:text-white px-4">{{ __('ui.nav_home') }}</a>

            <div class="px-4 border-s-2 border-primary/20 ms-2">
                <span class="text-xs font-bold text-primary uppercase">{{ __('ui.nav_about') }}</span>
                <div class="flex flex-col mt-2 gap-3 ps-4">
                    <a href="{{ localized_route('about.index') }}" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_about') }}</a>
                    <a href="{{ localized_route('team.index') }}" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_our_team') }}</a>
                </div>
            </div>

            <div class="px-4 border-s-2 border-primary/20 ms-2">
                <span class="text-xs font-bold text-primary uppercase">{{ __('ui.nav_projects') }}</span>
                <div class="flex flex-col mt-2 gap-3 ps-4">
                    <a href="{{ localized_route('kanani.index') }}" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_kanani') }}</a>
                    <a href="{{ localized_route('tamkeen.index') }}" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_tamkeen') }}</a>
                    <a href="{{ localized_route('parasols.index') }}" class="text-sm text-slate-600 dark:text-slate-300">{{ __('ui.nav_parasols') }}</a>
                </div>
            </div>

            <a href="{{ localized_route('grants.index') }}" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_grants') }}</a>
            <a href="{{ localized_route('partners.index') }}" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_partners') }}</a>
            <a href="{{ localized_route('news.index') }}" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">{{ __('ui.nav_news') }}</a>
        </div>
    </div>
</nav>
