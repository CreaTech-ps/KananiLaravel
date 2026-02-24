@extends('website.layout')

@section('title', __('kanani.page_title'))

@section('content')
<main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
    <section class="relative pt-24 pb-36 overflow-hidden">
        <div class="absolute top-0 end-0 -translate-y-1/2 translate-x-1/3 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="layout-container grid lg:grid-cols-2 gap-12 md:gap-16 items-center max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8 order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-sm font-bold border border-primary/20">
                    <span class="material-symbols-outlined text-sm">history_edu</span>
                    {{ localized($settings, 'hero_badge') ?? __('kanani.badge_heritage') }}
                </div>

                <h1 class="text-4xl lg:text-6xl font-extrabold leading-tight text-slate-900 dark:text-white">
                    {{ $settings->hero_title_ar ?? __('kanani.hero_title_line1') }} <br />
                    <span class="text-primary">{{ $settings->hero_title_en ?? __('kanani.hero_title_line2') }}</span>
                </h1>

                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                    {{ localized($settings, 'hero_subtitle') ?? localized($settings, 'intro_text') ?? __('kanani.hero_subtitle') }}
                </p>

                <ul class="space-y-5">
                    <li class="flex items-center gap-3 group">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1 rounded-md group-hover:bg-primary group-hover:text-white transition-colors duration-300">check_circle</span>
                        <span class="font-medium text-lg text-slate-700 dark:text-slate-200">{{ localized($settings, 'hero_point1') ?? __('kanani.hero_point1') }}</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1 rounded-md group-hover:bg-primary group-hover:text-white transition-colors duration-300">check_circle</span>
                        <span class="font-medium text-lg text-slate-700 dark:text-slate-200">{{ localized($settings, 'hero_point2') ?? __('kanani.hero_point2') }}</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1 rounded-md group-hover:bg-primary group-hover:text-white transition-colors duration-300">check_circle</span>
                        <span class="font-medium text-lg text-slate-700 dark:text-slate-200">{{ localized($settings, 'hero_point3') ?? __('kanani.hero_point3') }}</span>
                    </li>
                </ul>

                <div class="pt-4">
                    @if($settings->discover_more_text_ar || $settings->discover_more_text_en)
                    <button type="button" onclick="openDiscoverMoreLightbox()" class="inline-flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all duration-300">
                        {{ __('kanani.discover_more') }}
                        <span class="material-symbols-outlined rtl:rotate-180">arrow_forward</span>
                    </button>
                    @else
                    <a href="#products" class="inline-flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all duration-300">
                        {{ __('kanani.discover_more') }}
                        <span class="material-symbols-outlined rtl:rotate-180">arrow_forward</span>
                    </a>
                    @endif
                </div>
            </div>

            <div class="relative group order-1 lg:order-2">
                <div class="absolute -bottom-10 -start-10 w-48 h-48 bg-primary/20 rounded-full blur-[80px] -z-10 animate-pulse"></div>

                <div class="relative aspect-[4/3] bg-slate-200 dark:bg-card-dark rounded-[32px] overflow-hidden shadow-2xl border-4 border-white dark:border-white/5" id="hero-video-container">
                    @if($settings->hero_video_url)
                        <div id="hero-video-player" class="w-full h-full"></div>
                    @else
                        @php
                            $heroImage = $settings->hero_media_path ? asset('storage/' . $settings->hero_media_path) : asset('assets/img/heritage-crafts.webp');
                        @endphp
                        <img alt="{{ __('kanani.video_label') }}"
                            class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-1000"
                            src="{{ $heroImage }}"
                            onerror="this.src='https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800';" />
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="w-20 h-20 bg-primary text-white rounded-full flex items-center justify-center shadow-xl shadow-primary/40 transform transition group-hover:scale-110">
                                <span class="material-symbols-outlined text-5xl">play_arrow</span>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group relative overflow-hidden bg-white dark:bg-[#121212] p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20">
                <div class="flex items-center justify-between relative z-10">
                    <div class="text-start">
                        <p class="text-slate-500 dark:text-slate-400 text-xs mb-2 font-bold tracking-widest uppercase opacity-80">
                            {{ localized($settings, 'stat1_label') ?? __('kanani.stat1_label') }}
                        </p>
                        <h3 class="stat-number text-4xl font-black text-primary transition-all duration-300 group-hover:scale-105" data-target="{{ str_replace(['+', ','], '', $settings->stat1_value ?? '150') }}">{{ $settings->stat1_value ?? '+150' }}</h3>
                    </div>
                    <div class="w-16 h-16 bg-slate-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-slate-400 transition-all duration-500 group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl transition-all duration-500">groups</span>
                    </div>
                </div>
                <div class="absolute -bottom-20 -start-20 w-40 h-40 bg-primary/10 rounded-full blur-[60px] transition-all duration-700 opacity-0 group-hover:opacity-100"></div>
            </div>

            <div class="group relative overflow-hidden bg-white dark:bg-[#121212] p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20">
                <div class="flex items-center justify-between relative z-10">
                    <div class="text-start">
                        <p class="text-slate-500 dark:text-slate-400 text-xs mb-2 font-bold tracking-widest uppercase opacity-80">
                            {{ localized($settings, 'stat2_label') ?? __('kanani.stat2_label') }}
                        </p>
                        <h3 class="stat-number text-4xl font-black text-primary transition-all duration-300 group-hover:scale-105" data-target="{{ str_replace(',', '', $settings->stat2_value ?? '12000') }}">{{ $settings->stat2_value ?? '12,000' }}</h3>
                    </div>
                    <div class="w-16 h-16 bg-slate-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-slate-400 transition-all duration-500 group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl transition-all duration-500">precision_manufacturing</span>
                    </div>
                </div>
                <div class="absolute -bottom-20 -start-20 w-40 h-40 bg-primary/10 rounded-full blur-[60px] transition-all duration-700 opacity-0 group-hover:opacity-100"></div>
            </div>

            <div class="group relative overflow-hidden bg-white dark:bg-[#121212] p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20">
                <div class="flex items-center justify-between relative z-10">
                    <div class="text-start">
                        <p class="text-slate-500 dark:text-slate-400 text-xs mb-2 font-bold tracking-widest uppercase opacity-80">
                            {{ localized($settings, 'stat3_label') ?? __('kanani.stat3_label') }}
                        </p>
                        <h3 class="stat-number text-4xl font-black text-primary transition-all duration-300 group-hover:scale-105" data-target="{{ str_replace(['+', ','], '', $settings->stat3_value ?? '500') }}">{{ $settings->stat3_value ?? '+500' }}</h3>
                    </div>
                    <div class="w-16 h-16 bg-slate-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-slate-400 transition-all duration-500 group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl transition-all duration-500">brush</span>
                    </div>
                </div>
                <div class="absolute -bottom-20 -start-20 w-40 h-40 bg-primary/10 rounded-full blur-[60px] transition-all duration-700 opacity-0 group-hover:opacity-100"></div>
            </div>
        </div>
    </section>

    <section id="products" class="layout-container py-16 md:py-20 max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-4xl font-bold mb-3 text-slate-900 dark:text-white">{{ localized($settings, 'gallery_section_title') ?? __('kanani.gallery_title') }}</h2>
                <p class="text-lg text-slate-500 dark:text-slate-400 max-w-md">
                    {{ localized($settings, 'gallery_section_subtitle') ?? __('kanani.gallery_subtitle') }}
                </p>
            </div>
            @if(!empty($settings->gallery_link_url) || !empty($settings->store_url))
            <a class="flex items-center gap-3 text-primary font-bold text-lg hover:gap-5 transition-all duration-300 group" href="{{ $settings->gallery_link_url ?? $settings->store_url ?? '#' }}" target="_blank" rel="noopener">
                {{ localized($settings, 'gallery_link_text') ?? __('kanani.browse_all') }}
                <span class="material-symbols-outlined rtl:rotate-180 transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1">east</span>
            </a>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($items as $item)
            <a href="{{ $settings->store_url ?? '#' }}" target="_blank" rel="noopener" class="related-card bg-white dark:bg-card-dark rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col cursor-pointer group transition-all duration-300 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                <div class="aspect-square bg-cover bg-center relative overflow-hidden">
                    <img alt="{{ localized($item, 'title') }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuANZF-6S6nF0Pq4IhQtgym1L1s7hIXafpt-5FvPa_jhB9iPwxjNljF6zNY4R94UfRpu4xiIXUMLKiS2FS-nt_N0Q4GnBY0UX3rHGSNuTWk3fY_v8qIAWbbstAqLiYyRo8mI445n8u_tXAm-BnCsnwy3Iaz4sTLo1IQFnWxZeImdaLnI7wKQ6CCndw6ZerNztl--SWaTPrw9f6zMmvtztHb7TxRstCysPN7UvM_pGto8W6d7K85hWMkQkyguDBEscE6ubr0llRb4q8c' }}" />

                    <div class="absolute top-3 end-3 z-10 bg-primary text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-md">
                        @if($item->badge === 'bestseller')
                            {{ __('kanani.bestseller') }}
                        @elseif($item->badge === 'handcrafted')
                            {{ __('kanani.handcrafted') }}
                        @else
                            {{ __('kanani.discount_badge_5') }}
                        @endif
                    </div>

                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="bg-white text-slate-900 px-6 py-2.5 rounded-full font-bold text-sm shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ __('kanani.product_details') }}</span>
                    </div>
                </div>

                <div class="p-4 flex flex-col gap-2">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors duration-300">{{ localized($item, 'title') }}</h3>
                        <span class="text-primary font-bold">{{ $item->price ? $item->price . ' ₪' : '—' }}</span>
                    </div>
                    <span class="text-xs px-1 text-slate-400">{{ localized($item, 'location') ?? __('kanani.category_textiles') }}</span>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">{{ __('kanani.no_products') }}</div>
            @endforelse
        </div>
    </section>

    <section class="layout-container pb-32">
        <div class="max-w-[1280px] mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-primary/5 dark:bg-primary/10 rounded-[2.5rem] p-12 md:p-24 text-center border border-primary/10 dark:border-primary/20 relative overflow-hidden shadow-sm">
                <div class="absolute -top-10 -end-10 p-12 opacity-[0.08]">
                    <span class="material-symbols-outlined text-[20rem] text-primary">campaign</span>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight text-slate-900 dark:text-white">
                        {{ localized($settings, 'cta_title') ?? __('kanani.cta_title') }}
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-16 leading-relaxed font-medium">
                        {{ localized($settings, 'cta_subtitle') ?? __('kanani.cta_subtitle') }}
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ $settings->cta_button_url ?? $settings->store_url ?? '#' }}" target="_blank" rel="noopener"
                            class="bg-primary hover:bg-opacity-90 text-white px-10 py-4 rounded-2xl font-bold text-xl transition-all transform hover:scale-105 inline-flex items-center gap-4 shadow-xl shadow-primary/20">
                            <span class="material-symbols-outlined text-2xl">shopping_bag</span>
                            {{ localized($settings, 'cta_button_text') ?? __('kanani.visit_full_store') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

{{-- Lightbox للنص الكامل --}}
<div id="lightbox" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-md transition-all duration-300 opacity-0 px-4">
    <div class="bg-white dark:bg-card-dark w-full max-w-2xl rounded-[32px] p-8 sm:p-12 relative shadow-2xl scale-95 transition-transform duration-300 flex flex-col max-h-[85vh]" id="lightbox-content">
        <button onclick="closeLightbox()" class="absolute top-6 end-6 text-slate-400 hover:text-primary transition-colors z-20">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <div class="overflow-y-auto custom-scrollbar">
            <div id="lightbox-icon-container" class="w-20 h-20 bg-primary/10 text-primary rounded-3xl flex items-center justify-center mx-auto mb-8 shrink-0">
                <span id="lightbox-icon" class="material-symbols-outlined text-5xl">history_edu</span>
            </div>
            <h3 id="lightbox-title" class="text-3xl font-bold text-slate-900 dark:text-white mb-6 text-center"></h3>
            <div id="lightbox-text" class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed text-start px-2 pb-4"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function embedUrl(url) {
        if (!url) return '';
        url = url.trim();
        var m = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
        if (m) return 'https://www.youtube.com/embed/' + m[1];
        var v = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
        if (v) return 'https://player.vimeo.com/video/' + v[1];
        return url;
    }
    function isEmbedable(url) {
        return /youtube\.com|youtu\.be|vimeo\.com/i.test(url);
    }

    // Load hero video
    @if($settings->hero_video_url)
    (function() {
        var container = document.getElementById('hero-video-player');
        if (!container) return;
        var url = @json($settings->hero_video_url);
        var embed = embedUrl(url);
        if (isEmbedable(url)) {
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', embed);
            iframe.setAttribute('class', 'w-full h-full');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            container.appendChild(iframe);
        } else {
            var video = document.createElement('video');
            video.setAttribute('src', url);
            video.setAttribute('controls', '');
            video.setAttribute('class', 'w-full h-full');
            container.appendChild(video);
        }
    })();
    @endif

    // Lightbox functions
    function openLightbox(title, text, icon) {
        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        const scrollContainer = lightbox.querySelector('.overflow-y-auto');
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-text').innerHTML = '<div class="text-start leading-relaxed">' + text.replace(/\n/g, '<br>') + '</div>';
        document.getElementById('lightbox-icon').innerText = icon;
        if (scrollContainer) scrollContainer.scrollTop = 0;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        setTimeout(() => {
            lightbox.classList.add('opacity-100');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        lightbox.classList.remove('opacity-100');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }
    document.getElementById('lightbox')?.addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    function openDiscoverMoreLightbox() {
        @php
            $fullText = localized($settings, 'discover_more_text') ?: ($settings->discover_more_text_ar ?? '');
        @endphp
        const fullText = @json($fullText);
        const title = @json(__('kanani.discover_more'));
        if (fullText) {
            openLightbox(title, fullText, 'history_edu');
        }
    }
</script>
@endsection
