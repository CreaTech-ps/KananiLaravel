@extends('website.layout')

@section('title', __('about.page_title'))

@section('content')
<main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 space-y-16 md:space-y-20">
    <section class="pb-20 space-y-24 overflow-hidden">

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="order-2 lg:order-1 text-start">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary mb-6">
                        <span class="material-symbols-outlined text-sm">auto_awesome</span>
                        <span class="text-xs font-bold uppercase tracking-wider">{{ __('about.founder_badge') }}</span>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-6 leading-tight">
                        {{ __('about.founder_title') }} <br />
                        <span class="text-primary italic">{{ __('about.founder_title_highlight') }}</span>
                    </h2>

                    <div class="relative">
                        <span class="absolute -start-6 -top-4 text-6xl text-primary/10 font-serif">"</span>
                        <p class="text-slate-600 dark:text-slate-400 text-lg leading-[1.8] mb-4 relative z-10">
                            {{ __('about.founder_quote') }}
                        </p>
                        @if($aboutPage->founder_full_message_ar || $aboutPage->founder_full_message_en)
                        <button type="button" onclick="openFounderMessageLightbox()" class="text-primary hover:text-primary-dark font-medium inline-flex items-center gap-2 transition-colors mb-8">
                            <span>اقرأ المزيد</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 border-t border-slate-100 dark:border-white/5 pt-6">
                        <div class="relative w-12 h-12 rounded-full bg-primary/20 overflow-hidden ring-4 ring-primary/5">
                            <img src="{{ asset('assets/img/founder.jpg') }}" alt="{{ __('about.founder_name') }}" class="relative z-10 w-full h-full object-cover" loading="lazy" width="48" height="48" onerror="this.style.display='none'">
                            <span class="absolute inset-0 flex items-center justify-center material-symbols-outlined text-2xl text-primary">person</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white leading-tight">{{ __('about.founder_name') }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('about.founder_role') }}</p>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-primary/5 rounded-[40px] rotate-2 rtl:-rotate-2 group-hover:rotate-0 transition-transform duration-500"></div>
                        <div class="relative rounded-[32px] overflow-hidden aspect-[4/3] bg-slate-900 shadow-2xl border border-white dark:border-white/10" id="founder-video-container">
                            @if($aboutPage->founder_message_video_url)
                                <div id="founder-video-player" class="w-full h-full"></div>
                            @else
                                <img src="{{ asset('assets/img/founder-video-thumb.jpg') }}" alt="{{ __('about.watch_message') }}"
                                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-700"
                                    loading="lazy" width="800" height="600"
                                    onerror="this.src='https://images.unsplash.com/photo-1523240715634-d1c651177e4d?w=800';">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md border border-white/30 text-white rounded-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl">play_circle</span>
                                    </div>
                                </div>
                            @endif
                            <div class="absolute bottom-6 start-6">
                                <span class="px-3 py-1 bg-black/50 backdrop-blur-sm text-white text-[10px] rounded-lg tracking-widest uppercase">
                                    {{ __('about.watch_message') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8 text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ __('about.story_title') }}</h2>
                <p class="text-slate-500 dark:text-slate-400">
                    {{ __('about.story_desc') }}
                </p>
            </div>

            <div class="relative rounded-[40px] overflow-hidden aspect-video bg-black shadow-2xl border border-slate-200 dark:border-white/5" id="story-video-container">
                @if($aboutPage->story_video_url)
                    <div id="story-video-player" class="w-full h-full"></div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-900">
                        <div class="text-center text-slate-400">
                            <span class="material-symbols-outlined text-6xl mb-4 block">videocam_off</span>
                            <p class="text-sm">لم يتم إضافة فيديو قصة الجمعية بعد</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="space-y-14 max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-1.5 h-10 bg-primary rounded-full"></div>
                <h2 class="text-4xl font-bold text-slate-900 dark:text-white">{{ __('about.identity_title') }}</h2>
            </div>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                {{ __('about.identity_intro') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php $sectionIcons = ['vision' => 'visibility', 'mission' => 'auto_awesome', 'goals' => 'flag', 'values' => 'favorite']; @endphp
            @foreach($sections as $section)
            <div onclick="openLightbox(this.dataset.title, this.dataset.content, this.dataset.icon)"
                data-title="{{ localized($section, 'title') }}"
                data-content="{{ e(localized($section, 'content') ?: localized($section, 'title')) }}"
                data-icon="{{ $sectionIcons[$section->type] ?? 'article' }}"
                class="p-10 rounded-[28px] bg-white dark:bg-card-dark border border-slate-100 dark:border-white/10 hover:border-primary/40 transition-all duration-300 group shadow-sm cursor-pointer hover:-translate-y-2">
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">{{ $sectionIcons[$section->type] ?? 'article' }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ localized($section, 'title') }}</h3>
                </div>
                <p class="text-slate-600 dark:text-slate-400 leading-loose text-lg line-clamp-3">{{ Str::limit(localized($section, 'content') ?: localized($section, 'title'), 150) }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <div id="lightbox" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-md transition-all duration-300 opacity-0 px-4">
        <div class="bg-white dark:bg-card-dark w-full max-w-xl rounded-[32px] p-8 sm:p-12 relative shadow-2xl scale-95 transition-transform duration-300 flex flex-col max-h-[85vh]" id="lightbox-content">
            <button onclick="closeLightbox()" class="absolute top-6 end-6 text-slate-400 hover:text-primary transition-colors z-20">
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
            <div class="overflow-y-auto custom-scrollbar text-center">
                <div id="lightbox-icon-container" class="w-20 h-20 bg-primary/10 text-primary rounded-3xl flex items-center justify-center mx-auto mb-8 shrink-0">
                    <span id="lightbox-icon" class="material-symbols-outlined text-5xl"></span>
                </div>
                <h3 id="lightbox-title" class="text-3xl font-bold text-slate-900 dark:text-white mb-6"></h3>
                <div id="lightbox-text" class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed text-center px-2 pb-4"></div>
            </div>
        </div>
    </div>

    <section class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-[1280px] mx-auto w-full">
            @php $homeSetting = \App\Models\HomeSetting::get(); @endphp
            <div class="bg-primary/5 dark:bg-primary/10 rounded-[2.5rem] p-12 md:p-24 text-center border border-primary/10 dark:border-primary/20 relative overflow-hidden shadow-sm">
                <div class="absolute -top-10 -end-10 p-12 opacity-[0.08]">
                    <span class="material-symbols-outlined text-[20rem] text-primary">campaign</span>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight dark:text-white">
                        {{ __('about.cta_title') }}
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-16 leading-relaxed font-medium">
                        {{ __('about.cta_desc') }}
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <button type="button" onclick="openVolunteerForm()"
                            class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center gap-3">
                            {{ __('about.volunteer_btn') }}
                            <span class="material-symbols-outlined">send</span>
                        </button>
                        @php $homeSetting = \App\Models\HomeSetting::get(); @endphp
                        <a href="{{ $homeSetting->cta_url ?? '#' }}"
                            class="w-full sm:w-auto px-12 py-5 border-2 border-primary/50 text-primary hover:bg-primary hover:text-white font-bold rounded-2xl transition-all text-lg backdrop-blur-sm">
                            {{ __('about.donate_btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

{{-- مودال مشغل الفيديو --}}
<div id="video-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4" aria-hidden="true">
    <div class="relative w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl">
        <button type="button" onclick="closeVideoModal()" class="absolute top-4 start-4 z-20 w-12 h-12 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-black/70 transition-colors" aria-label="إغلاق">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <div id="video-modal-content" class="w-full h-full"></div>
    </div>
</div>

{{-- مودال نموذج التطوع --}}
<div id="volunteer-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-md transition-all duration-300 opacity-0 px-4">
    <div class="bg-white dark:bg-card-dark w-full max-w-2xl rounded-[32px] p-8 sm:p-12 relative shadow-2xl scale-95 transition-transform duration-300 flex flex-col max-h-[85vh]" id="volunteer-modal-content">
        <button onclick="closeVolunteerForm()" class="absolute top-6 end-6 text-slate-400 hover:text-primary transition-colors z-20">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <div class="overflow-y-auto custom-scrollbar">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 text-center">انضم إلينا كمتطوع</h2>
            <form id="volunteer-form" class="space-y-6">
                @csrf
                <div>
                    <label for="volunteer-name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">الاسم الكامل *</label>
                    <input type="text" id="volunteer-name" name="name" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="volunteer-email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">البريد الإلكتروني *</label>
                    <input type="email" id="volunteer-email" name="email" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="volunteer-phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">رقم التواصل *</label>
                    <input type="tel" id="volunteer-phone" name="phone" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="volunteer-department" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">القسم *</label>
                    <select id="volunteer-department" name="department_id" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="">جاري التحميل...</option>
                    </select>
                </div>
                <div>
                    <label for="volunteer-cv" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">السيرة الذاتية (PDF, DOC, DOCX) *</label>
                    <input type="file" id="volunteer-cv" name="cv" accept=".pdf,.doc,.docx" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">الحد الأقصى لحجم الملف: 10 ميجابايت</p>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" onclick="closeVolunteerForm()" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        إلغاء
                    </button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-primary text-white hover:bg-primary-dark transition-colors font-medium inline-flex items-center gap-2">
                        <span class="material-symbols-outlined">send</span>
                        تقديم
                    </button>
                </div>
            </form>
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
        if (m) return 'https://www.youtube.com/embed/' + m[1] + '?autoplay=1';
        var v = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
        if (v) return 'https://player.vimeo.com/video/' + v[1] + '?autoplay=1';
        return url;
    }
    function isEmbedable(url) {
        return /youtube\.com|youtu\.be|vimeo\.com/i.test(url);
    }
    function openVideoModal(url) {
        var modal = document.getElementById('video-modal');
        var content = document.getElementById('video-modal-content');
        if (!modal || !content) return;
        content.innerHTML = '';
        var embed = embedUrl(url);
        if (isEmbedable(url)) {
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', embed);
            iframe.setAttribute('class', 'w-full h-full');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            content.appendChild(iframe);
        } else {
            var video = document.createElement('video');
            video.setAttribute('src', url);
            video.setAttribute('controls', '');
            video.setAttribute('autoplay', '');
            video.setAttribute('class', 'w-full h-full');
            content.appendChild(video);
        }
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeVideoModal() {
        var modal = document.getElementById('video-modal');
        var content = document.getElementById('video-modal-content');
        if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
        if (content) content.innerHTML = '';
        document.body.style.overflow = '';
    }
    document.getElementById('video-modal')?.addEventListener('click', function(e) { if (e.target === this) closeVideoModal(); });

    function openLightbox(title, text, icon) {
        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        const scrollContainer = lightbox.querySelector('.overflow-y-auto');
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-text').innerText = text;
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
    function openFounderMessageLightbox() {
        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        const scrollContainer = lightbox.querySelector('.overflow-y-auto');
        @php
            $fullMessage = localized($aboutPage, 'founder_full_message') ?: ($aboutPage->founder_full_message_ar ?? '');
        @endphp
        const fullMessage = @json($fullMessage);
        const title = @json(__('about.founder_badge'));
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-text').innerHTML = '<div class="text-start leading-relaxed">' + fullMessage.replace(/\n/g, '<br>') + '</div>';
        document.getElementById('lightbox-icon').innerText = 'auto_awesome';
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
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    // Auto-play founder's message video
    @if($aboutPage->founder_message_video_url)
    (function() {
        var container = document.getElementById('founder-video-player');
        if (!container) return;
        var url = @json($aboutPage->founder_message_video_url);
        var embed = embedUrl(url);
        if (isEmbedable(url)) {
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', embed + '&mute=1');
            iframe.setAttribute('class', 'w-full h-full');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            container.appendChild(iframe);
        } else {
            var video = document.createElement('video');
            video.setAttribute('src', url);
            video.setAttribute('controls', '');
            video.setAttribute('autoplay', '');
            video.setAttribute('muted', '');
            video.setAttribute('loop', '');
            video.setAttribute('class', 'w-full h-full');
            container.appendChild(video);
        }
    })();
    @endif

    // Load association story video
    @if($aboutPage->story_video_url)
    (function() {
        var container = document.getElementById('story-video-player');
        if (!container) return;
        var url = @json($aboutPage->story_video_url);
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

    // Volunteer form functions
    var volunteerDepartments = [];
    function loadVolunteerDepartments() {
        fetch('{{ route("volunteer.departments") }}')
            .then(response => response.json())
            .then(data => {
                volunteerDepartments = data;
                var select = document.getElementById('volunteer-department');
                if (select) {
                    select.innerHTML = '<option value="">اختر القسم</option>';
                    data.forEach(function(dept) {
                        var option = document.createElement('option');
                        option.value = dept.id;
                        option.textContent = dept.name;
                        select.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error loading departments:', error));
    }
    function openVolunteerForm() {
        loadVolunteerDepartments();
        var modal = document.getElementById('volunteer-modal');
        var content = document.getElementById('volunteer-modal-content');
        if (modal && content) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(function() {
                modal.classList.add('opacity-100');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }
    }
    function closeVolunteerForm() {
        var modal = document.getElementById('volunteer-modal');
        var content = document.getElementById('volunteer-modal-content');
        if (modal && content) {
            modal.classList.remove('opacity-100');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
                var form = document.getElementById('volunteer-form');
                if (form) form.reset();
            }, 300);
        }
    }
    document.getElementById('volunteer-modal')?.addEventListener('click', function(e) {
        if (e.target === this) closeVolunteerForm();
    });
    document.getElementById('volunteer-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var submitBtn = this.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> جاري الإرسال...';
        
        fetch('{{ route("volunteer.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeVolunteerForm();
            } else {
                alert('حدث خطأ. يرجى المحاولة مرة أخرى.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ. يرجى المحاولة مرة أخرى.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
</script>
@endsection
