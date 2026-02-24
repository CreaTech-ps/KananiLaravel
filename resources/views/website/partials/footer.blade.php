@php
    $settings = \App\Models\SiteSetting::get();
    $phone = $settings->contact_phone ?? '+970 2 298 2000';
    $email = $settings->contact_email ?? 'info@fobzu.org';
@endphp
<footer class="bg-white dark:bg-[#0C0C0C] border-t border-slate-100 dark:border-white/5 pt-16 pb-8">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8 mb-16">

            <div class="flex flex-col items-center sm:items-start max-w-xs mx-auto sm:mx-0">
                <a href="{{ localized_route('home') }}" class="shrink-0 mb-4 transition-transform hover:scale-105 flex justify-center sm:justify-start">
                    <img src="{{ asset('assets/img/KANANI-Logo-l.svg') }}" alt="{{ __('ui.site_name') }}" class="h-14 w-auto dark:hidden">
                    <img src="{{ asset('assets/img/KANANI-Logo-d.svg') }}" alt="{{ __('ui.site_name') }}" class="h-14 w-auto hidden dark:block">
                </a>
                <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400 text-center sm:text-start sm:text-justify [text-justify:inter-word]">
                    {{ __('ui.footer_desc') }}
                </p>
            </div>

            <div class="text-center sm:text-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6 flex items-center justify-center sm:justify-start gap-2 border-s-4 border-primary ps-3 leading-none">
                    {{ __('ui.footer_about_heading') }}
                </h3>
                <ul class="space-y-3 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="{{ localized_route('home') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_home') }}</a></li>
                    <li><a href="{{ localized_route('about.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_about') }}</a></li>
                    <li><a href="{{ localized_route('team.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_our_team') }}</a></li>
                    <li><a href="{{ localized_route('news.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_news') }}</a></li>
                </ul>
            </div>

            <div class="text-center sm:text-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6 flex items-center justify-center sm:justify-start gap-2 border-s-4 border-primary ps-3 leading-none">
                    {{ __('ui.footer_programs_heading') }}
                </h3>
                <ul class="space-y-3 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="{{ localized_route('kanani.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_kanani') }}</a></li>
                    <li><a href="{{ localized_route('tamkeen.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_tamkeen') }}</a></li>
                    <li><a href="{{ localized_route('parasols.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_parasols') }}</a></li>
                    <li><a href="{{ localized_route('grants.index') }}" class="hover:text-primary transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></span>{{ __('ui.nav_grants') }}</a></li>
                </ul>
            </div>

            <div class="text-center sm:text-start flex flex-col items-center sm:items-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6">{{ __('ui.footer_subscribe') }}</h3>
                <div class="relative w-full max-w-xs mb-8">
                    <input type="email" placeholder="{{ __('ui.email_placeholder') }}"
                        class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl py-3.5 px-4 text-sm focus:outline-none focus:border-primary/50 transition-all placeholder:text-slate-400">
                    <button class="absolute end-1.5 top-1.5 bg-primary text-white p-2 rounded-xl hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/20 flex items-center justify-center" type="button">
                        <span class="material-symbols-outlined text-sm rtl:rotate-180">send</span>
                    </button>
                </div>

                <h3 class="font-bold mb-4 text-sm text-slate-900 dark:text-white md:hidden">{{ __('ui.follow_us') }}</h3>
                <div class="flex gap-4 md:hidden">
                    <a href="{{ $settings->facebook_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $settings->twitter_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-400 hover:bg-black hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-100 dark:border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-start">
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-10">
                <p class="text-[11px] sm:text-xs text-slate-400 font-medium tracking-wide uppercase">
                    {{ __('ui.rights_reserved', ['year' => date('Y')]) }}
                </p>
                <div class="flex flex-wrap justify-center items-center gap-6">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex items-center gap-2 text-xs text-slate-500 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">call</span>
                        <span dir="ltr">{{ $phone }}</span>
                    </a>
                    <a href="mailto:{{ $email }}" class="flex items-center gap-2 text-xs text-slate-500 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        <span>{{ $email }}</span>
                    </a>
                </div>
            </div>

            <div class="flex gap-8 text-[11px] sm:text-xs font-semibold text-slate-400">
                <a href="{{ localized_route('privacy') }}" class="hover:text-primary transition-all border-b border-transparent hover:border-primary">{{ __('ui.privacy_policy') }}</a>
                <a href="{{ localized_route('terms') }}" class="hover:text-primary transition-all border-b border-transparent hover:border-primary">{{ __('ui.terms_of_use') }}</a>
            </div>
        </div>
    </div>
</footer>
