@extends('cp.layout')

@section('title', 'من نحن')

@section('content')
<div class="w-full max-w-none space-y-6">
    <form action="{{ route('cp.about.update') }}" method="post" class="space-y-6">
        @csrf
        @method('PUT')

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">videocam</span>
                فيديو رسالة المؤسس
            </h2>
            <div>
                <label for="founder_message_video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الفيديو (رسالة المؤسس)</label>
                <input type="url" name="founder_message_video_url" id="founder_message_video_url" value="{{ old('founder_message_video_url', $aboutPage->founder_message_video_url ?? '') }}" placeholder="https://youtube.com/... أو رابط فيديو مباشر" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">سيتم تشغيل هذا الفيديو تلقائياً عند فتح صفحة من نحن</p>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">article</span>
                الرسالة الكاملة للمؤسس
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="founder_full_message_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الرسالة الكاملة (عربي)</label>
                    <textarea name="founder_full_message_ar" id="founder_full_message_ar" rows="8" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('founder_full_message_ar', $aboutPage->founder_full_message_ar ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">الرسالة الكاملة التي ستظهر في Lightbox عند الضغط على زر "اقرأ المزيد"</p>
                </div>
                <div>
                    <label for="founder_full_message_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الرسالة الكاملة (إنجليزي)</label>
                    <textarea name="founder_full_message_en" id="founder_full_message_en" rows="8" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('founder_full_message_en', $aboutPage->founder_full_message_en ?? '') }}</textarea>
                </div>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">videocam</span>
                فيديو قصة الجمعية
            </h2>
            <div>
                <label for="story_video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الفيديو (قصة الجمعية)</label>
                <input type="url" name="story_video_url" id="story_video_url" value="{{ old('story_video_url', $aboutPage->story_video_url) }}" placeholder="https://youtube.com/... أو رابط فيديو مباشر" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">groups</span>
                فيديو صفحة فريقنا
            </h2>
            <div>
                <label for="team_video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الفيديو</label>
                <input type="url" name="team_video_url" id="team_video_url" value="{{ old('team_video_url', $aboutPage->team_video_url ?? '') }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-6">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">article</span>
                الرؤية، الرسالة، الأهداف، القيم
            </h2>

            @foreach($sections as $section)
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 space-y-3">
                    <input type="hidden" name="sections[{{ $section->id }}][id]" value="{{ $section->id }}" />
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        @switch($section->type)
                            @case('vision') الرؤية @break
                            @case('mission') الرسالة @break
                            @case('goals') الأهداف @break
                            @case('values') القيم @break
                            @default {{ $section->type }}
                        @endswitch
                    </p>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                        <div>
                            <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي)</label>
                            <input type="text" name="sections[{{ $section->id }}][title_ar]" value="{{ old("sections.{$section->id}.title_ar", $section->title_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                        </div>
                        <div>
                            <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                            <input type="text" name="sections[{{ $section->id }}][title_en]" value="{{ old("sections.{$section->id}.title_en", $section->title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                        </div>
                    </div>
                    <div>
                        <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">المحتوى (عربي)</label>
                        <textarea name="sections[{{ $section->id }}][content_ar]" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old("sections.{$section->id}.content_ar", $section->content_ar) }}</textarea>
                    </div>
                    <div>
                        <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">المحتوى (إنجليزي)</label>
                        <textarea name="sections[{{ $section->id }}][content_en]" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old("sections.{$section->id}.content_en", $section->content_en) }}</textarea>
                    </div>
                </div>
            @endforeach
        </section>

        <div class="flex justify-end">
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ التغييرات
            </button>
        </div>
    </form>
</div>
@endsection
