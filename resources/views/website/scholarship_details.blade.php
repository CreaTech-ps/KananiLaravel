@extends('website.layout')
@section('title', localized($scholarship, 'title'))

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-8">
        <a class="hover:text-primary transition-colors" href="{{ localized_route('home') }}">{{ __('ui.nav_home') }}</a>
        <span class="material-symbols-outlined text-xs rtl:rotate-180">chevron_left</span>
        <a class="hover:text-primary transition-colors" href="{{ localized_route('grants.index') }}">{{ __('ui.nav_grants') }}</a>
        <span class="material-symbols-outlined text-xs rtl:rotate-180">chevron_left</span>
        <span class="text-slate-900 dark:text-white font-semibold">{{ localized($scholarship, 'title') }}</span>
    </nav>
    <div class="mb-14">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight text-slate-900 dark:text-white">
                    {{ localized($scholarship, 'title') }}
                </h1>
                @if(localized($scholarship, 'summary'))
                <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                    {{ localized($scholarship, 'summary') }}
                </p>
                @endif
            </div>
            @if($scholarship->application_form_pdf_path)
            <div class="flex flex-wrap gap-4">
                <a href="{{ asset('storage/' . $scholarship->application_form_pdf_path) }}" target="_blank" rel="noopener"
                    class="bg-white dark:bg-card-dark border border-slate-200 dark:border-white/10 hover:border-primary px-8 py-4 rounded-xl font-bold flex items-center gap-2 transition-all shadow-sm text-slate-900 dark:text-white">
                    {{ __('ui.download_grants_pdf') }}
                    <span class="material-symbols-outlined text-[20px] text-primary">download</span>
                </a>
            </div>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-20">
        @if($scholarship->application_start_date || $scholarship->application_end_date)
        <div class="bg-white dark:bg-card-dark p-8 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary">
                <span class="material-symbols-outlined text-3xl">event</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-1 font-medium">{{ app()->getLocale() === 'ar' ? 'فترة التقديم' : 'Application period' }}</p>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">
                @if($scholarship->application_start_date)
                    {{ $scholarship->application_start_date->locale(app()->getLocale())->translatedFormat('d/m/Y') }}
                @else
                    —
                @endif
                @if($scholarship->application_end_date)
                    <span class="text-primary">→</span> {{ $scholarship->application_end_date->locale(app()->getLocale())->translatedFormat('d/m/Y') }}
                @endif
            </h3>
        </div>
        @endif
        <div class="bg-white dark:bg-card-dark p-8 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary">
                <span class="material-symbols-outlined text-3xl">event_busy</span>
            </div>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-1 font-medium">{{ __('ui.application_deadline') }}</p>
            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">
                {{ $scholarship->application_end_date ? $scholarship->application_end_date->locale(app()->getLocale())->translatedFormat('d F Y') : '—' }}
            </h3>
            @if($scholarship->application_end_date && $scholarship->application_end_date->isFuture())
            @php $daysLeft = now()->diffInDays($scholarship->application_end_date, false); @endphp
            @if($daysLeft <= 14)
            <p class="text-xs text-red-500 mt-2 font-bold flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">timer</span>
                {{ __('ui.days_left_apply', ['days' => $daysLeft]) }}
            </p>
            @endif
            @endif
        </div>
    </div>
    <div class="space-y-20">
        @if(localized($scholarship, 'details'))
        <section>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-10 bg-primary rounded-full"></div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ app()->getLocale() === 'ar' ? 'وصف المنحة' : 'Grant description' }}</h2>
            </div>
            <div class="prose prose-slate dark:prose-invert max-w-none">
                <div class="text-slate-600 dark:text-slate-400 leading-loose text-xl whitespace-pre-line">{{ localized($scholarship, 'details') }}</div>
            </div>
        </section>
        @endif
        @if(localized($scholarship, 'conditions'))
        <section>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-10 bg-primary rounded-full"></div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ app()->getLocale() === 'ar' ? 'شروط الأهلية' : 'Eligibility' }}</h2>
            </div>
            <div class="prose prose-slate dark:prose-invert max-w-none">
                <div class="text-slate-600 dark:text-slate-400 leading-loose text-lg whitespace-pre-line">{{ localized($scholarship, 'conditions') }}</div>
            </div>
        </section>
        @endif
        @if(localized($scholarship, 'required_documents'))
        <section>
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-10 bg-primary rounded-full"></div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ app()->getLocale() === 'ar' ? 'الأوراق المطلوبة' : 'Required documents' }}</h2>
            </div>
            <div class="prose prose-slate dark:prose-invert max-w-none">
                <div class="text-slate-600 dark:text-slate-400 leading-loose text-lg whitespace-pre-line">{{ localized($scholarship, 'required_documents') }}</div>
            </div>
        </section>
        @endif
        <section class="bg-primary/5 border border-primary/20 p-10 md:p-16 rounded-[2.5rem] text-center relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6 text-slate-900 dark:text-white">{{ app()->getLocale() === 'ar' ? 'جاهز للبدء في رحلتك؟' : 'Ready to start your journey?' }}</h2>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                    {{ app()->getLocale() === 'ar' ? 'تأكد من تجهيز كافة الوثائق المطلوبة قبل البدء في تعبئة طلب التقديم.' : 'Make sure you have all required documents before filling out the application.' }}
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ localized_route('grants.apply', ['slug' => current_slug($scholarship)]) }}"
                        class="w-full sm:w-auto bg-primary hover:bg-opacity-90 text-white px-12 py-5 rounded-2xl font-bold text-xl flex items-center justify-center gap-3 transition-all shadow-2xl shadow-primary/30">
                        {{ app()->getLocale() === 'ar' ? 'قدم طلبك الآن' : 'Apply now' }}
                        <span class="material-symbols-outlined rtl:rotate-180">arrow_back</span>
                    </a>
                </div>
            </div>
        </section>
        @if($related->isNotEmpty())
        <section>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">{{ app()->getLocale() === 'ar' ? 'منح ذات صلة' : 'Related grants' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $r)
                <a href="{{ localized_route('grants.show', ['slug' => current_slug($r)]) }}"
                    class="bg-white dark:bg-card-dark p-6 rounded-2xl border border-slate-200 dark:border-white/10 hover:border-primary/50 transition-all shadow-sm hover:shadow-md block">
                    @if($r->image_path)
                    <img src="{{ asset('storage/' . $r->image_path) }}" alt="{{ localized($r, 'title') }}" class="w-full h-40 object-cover rounded-xl mb-4" loading="lazy" width="400" height="300" />
                    @endif
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white group-hover:text-primary">{{ localized($r, 'title') }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2">{{ Str::limit(localized($r, 'summary'), 80) }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

@push('scripts')
{{-- Structured Data (Schema.org) for Scholarship --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Scholarship",
    "name": @json(localized($scholarship, 'title')),
    "description": {{ json_encode(Str::limit(strip_tags(localized($scholarship, 'summary') ?? localized($scholarship, 'title')), 200)) }},
    "provider": {
        "@type": "Organization",
        "name": {{ json_encode(__('ui.site_name')) }},
        "url": "{{ url('/') }}"
    },
    @if($scholarship->image_path)
    "image": "{{ asset('storage/' . $scholarship->image_path) }}",
    @endif
    "url": "{{ url()->current() }}",
    "applicationDeadline": "{{ $scholarship->application_end_date?->toIso8601String() }}",
    @if($scholarship->application_start_date)
    "startDate": "{{ $scholarship->application_start_date->toIso8601String() }}",
    @endif
    @if($scholarship->estimated_value)
    "value": {
        "@type": "MonetaryAmount",
        "currency": "USD",
        "value": "{{ $scholarship->estimated_value }}"
    },
    @endif
    "inLanguage": "{{ app()->getLocale() === 'ar' ? 'ar' : 'en' }}"
}
</script>

{{-- Breadcrumb Structured Data --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": {{ json_encode(__('ui.home')) }},
            "item": "{{ localized_route('home') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": {{ json_encode(__('ui.nav_grants')) }},
            "item": "{{ localized_route('grants.index') }}"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": @json(localized($scholarship, 'title')),
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endpush
@endsection
