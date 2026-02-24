@extends('website.layout')

@section('title', __('legal.privacy.title'))

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-16 md:pb-20">
    <nav class="flex items-center text-xs gap-2 text-slate-500 dark:text-slate-400 mb-6">
        <a class="hover:text-primary transition-colors" href="{{ localized_route('home') }}">{{ __('ui.nav_home') }}</a>
        <span class="material-symbols-outlined text-[14px] rtl:rotate-180">chevron_right</span>
        <span class="text-slate-700 dark:text-white font-semibold">{{ __('legal.privacy.title') }}</span>
    </nav>

    <section class="bg-slate-50 dark:bg-[#151515] rounded-3xl p-8 md:p-12 lg:p-16 mb-12 border border-slate-100 dark:border-white/5">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-1.5 h-12 bg-primary rounded-full"></div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">{{ __('legal.privacy.title') }}</h1>
        </div>
        <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed max-w-3xl">
            {{ __('legal.privacy.intro') }}
        </p>
    </section>

    <div class="space-y-10">
        @foreach(__('legal.privacy.sections') as $key => $section)
        <article class="bg-white dark:bg-card-dark rounded-2xl p-6 md:p-8 border border-slate-100 dark:border-white/5 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                {{ $section['title'] }}
            </h2>
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                {{ $section['content'] }}
            </p>
        </article>
        @endforeach
    </div>
</div>
@endsection
