@extends('website.layout')

@section('title', __('team.page_title'))

@section('content')
<main class="container-custom py-16 md:py-20 pb-20">
    <section class="mb-16 md:mb-20">
        @php $chairperson = $boardMembers->first(); @endphp
        <div class="relative mt-12">
            <div class="absolute -top-12 -start-12 w-64 h-64 bg-primary/5 rounded-full blur-3xl invisible lg:visible"></div>

            @php
                $isRtl = app()->getLocale() === 'ar';
                // في العربية: الصورة في اليسار (order-2 في RTL)
                // في الإنجليزية: الصورة في اليمين (order-2 في LTR)
                $imageOrder = 'order-2';
                $textOrder = 'order-1';
            @endphp
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-stretch bg-slate-50 dark:bg-white/5 rounded-[40px] overflow-hidden border border-slate-100 dark:border-white/10 shadow-sm">

                <div class="lg:col-span-5 relative group overflow-hidden {{ $imageOrder }}">
                    <img src="{{ $chairperson && $chairperson->photo_path ? asset('storage/' . $chairperson->photo_path) : asset('assets/img/nisreen.webp') }}"
                        alt="{{ $chairperson ? localized($chairperson, 'name') : __('team.chairperson_title_highlight') }}"
                        class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-110"
                        loading="eager" width="600" height="800"
                        onerror="this.src='https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800';">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent lg:hidden"></div>

                    @if($chairperson)
                    <div class="absolute bottom-6 start-6 lg:hidden">
                        <h4 class="text-white font-bold text-lg">{{ localized($chairperson, 'name') }}</h4>
                        <p class="text-primary text-sm">{{ localized($chairperson, 'title') }}</p>
                    </div>
                    @endif
                </div>

                <div class="lg:col-span-7 py-12 px-4 sm:px-6 lg:px-8 relative flex flex-col justify-center {{ $textOrder }}">
                    <span class="absolute top-8 start-10 text-8xl text-primary/10 font-serif leading-none select-none">"</span>

                    <div class="relative z-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-8 leading-tight">
                            {{ __('team.chairperson_title') }} <span class="text-primary">{{ __('team.chairperson_title_highlight') }}</span>
                        </h2>

                        <div class="space-y-4 text-slate-600 dark:text-slate-300 text-base md:text-lg leading-relaxed italic font-light">
                            <p>{{ __('team.chairperson_message_1') }}</p>
                            <p>{{ __('team.chairperson_message_2') }}</p>
                            <p>{{ __('team.chairperson_message_3') }}</p>
                        </div>

                        @if($chairperson)
                        <div class="mt-8 pt-6 border-t border-slate-200 dark:border-white/10 hidden lg:block text-start">
                            <h4 class="text-xl font-bold text-slate-900 dark:text-white tracking-wide">{{ localized($chairperson, 'name') }}</h4>
                            <p class="text-primary font-semibold uppercase text-sm tracking-wider mt-1">{{ localized($chairperson, 'title') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-32">
        <div class="flex items-center gap-4 mb-16">
            <div class="w-2 h-10 bg-primary rounded-full"></div>
            <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ __('team.board_heading') }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($boardMembers as $member)
            <div class="bg-white dark:bg-card-dark p-8 rounded-[32px] border border-slate-100 dark:border-slate-800 text-center hover:shadow-2xl hover:shadow-primary/5 transition-all duration-300 group">
                <div class="relative inline-block mb-8">
                    <div class="w-40 h-40 rounded-full overflow-hidden bg-slate-100 dark:bg-slate-800 mx-auto p-1 ring-4 ring-primary/10 group-hover:ring-primary/30 transition-all">
                        <img alt="{{ localized($member, 'name') }}"
                            class="w-full h-full object-cover rounded-full grayscale group-hover:grayscale-0 transition-all duration-700"
                            src="{{ $member->photo_path ? asset('storage/' . $member->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(localized($member, 'name')) . '&size=160&background=e2e8f0&color=64748b' }}" 
                            loading="lazy" width="160" height="160" />
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-slate-900 dark:text-white">{{ localized($member, 'name') }}</h3>
                <p class="text-primary text-sm font-bold mb-6">{{ localized($member, 'title') }}</p>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-500 dark:text-slate-400">{{ __('team.no_board') }}</div>
            @endforelse
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-16">
            <div class="flex items-center gap-4">
                <div class="w-2 h-10 bg-primary rounded-full"></div>
                <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ __('team.staff_heading') }}</h2>
            </div>
            <div class="bg-slate-100 dark:bg-card-dark px-6 py-3 rounded-2xl text-sm font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800">
                <span class="text-primary">{{ $executiveStaff->count() }}</span> {{ __('team.staff_count', ['count' => $executiveStaff->count()]) }}
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($executiveStaff as $member)
            <div class="bg-white dark:bg-card-dark p-6 rounded-[24px] border border-slate-100 dark:border-slate-800 flex items-center justify-between hover:border-primary/30 transition-all group">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 ring-2 ring-transparent group-hover:ring-primary/20 transition-all">
                        <img alt="{{ localized($member, 'name') }}" class="w-full h-full object-cover"
                            src="{{ $member->photo_path ? asset('storage/' . $member->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(localized($member, 'name')) . '&size=80&background=e2e8f0&color=64748b' }}" 
                            loading="lazy" width="80" height="80" />
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-1 text-slate-900 dark:text-white">{{ localized($member, 'name') }}</h4>
                        <p class="text-slate-500 dark:text-slate-400">{{ localized($member, 'title') }}</p>
                    </div>
                </div>
                <div class="bg-primary/10 text-primary px-4 py-2 rounded-xl text-xs font-bold">{{ __('team.since_year', ['year' => $member->joined_since ?? '2022']) }}</div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-500 dark:text-slate-400">{{ __('team.no_staff') }}</div>
            @endforelse
        </div>
    </section>
</main>
@endsection
