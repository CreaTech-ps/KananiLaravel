@extends('cp.layout')

@section('title', 'مشروع كنعاني')

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">إعدادات مشروع كنعاني</h2>
        <a href="{{ route('cp.kanani.gallery.index') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">photo_library</span>
            معرض الصور
        </a>
    </div>

    <form action="{{ route('cp.kanani.update') }}" method="post" class="space-y-6">
        @csrf
        @method('PUT')

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">videocam</span>
                الفيديو والنبذة
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="intro_video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الفيديو التعريفي</label>
                    <input type="url" name="intro_video_url" id="intro_video_url" value="{{ old('intro_video_url', $settings->intro_video_url) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="intro_text_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نبذة عن المشروع (عربي)</label>
                    <textarea name="intro_text_ar" id="intro_text_ar" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('intro_text_ar', $settings->intro_text_ar) }}</textarea>
                </div>
                <div>
                    <label for="intro_text_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نبذة عن المشروع (إنجليزي)</label>
                    <textarea name="intro_text_en" id="intro_text_en" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('intro_text_en', $settings->intro_text_en) }}</textarea>
                </div>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">videocam</span>
                فيديو القسم الأول
            </h2>
            <div>
                <label for="hero_video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الفيديو للقسم الأول (بدلاً من الصورة)</label>
                <input type="url" name="hero_video_url" id="hero_video_url" value="{{ old('hero_video_url', $settings->hero_video_url ?? '') }}" placeholder="https://youtube.com/... أو رابط فيديو مباشر" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">سيتم عرض هذا الفيديو في القسم الأول بدلاً من الصورة</p>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">article</span>
                نص "اكتشف المزيد"
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="discover_more_text_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص الكامل (عربي)</label>
                    <textarea name="discover_more_text_ar" id="discover_more_text_ar" rows="8" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('discover_more_text_ar', $settings->discover_more_text_ar ?? '') }}</textarea>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">النص الذي سيظهر في Lightbox عند الضغط على زر "اكتشف المزيد"</p>
                </div>
                <div>
                    <label for="discover_more_text_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص الكامل (إنجليزي)</label>
                    <textarea name="discover_more_text_en" id="discover_more_text_en" rows="8" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('discover_more_text_en', $settings->discover_more_text_en ?? '') }}</textarea>
                </div>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">store</span>
                رابط المتجر
            </h2>
            <div>
                <label for="store_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط زيارة المتجر (CTA)</label>
                <input type="url" name="store_url" id="store_url" value="{{ old('store_url', $settings->store_url) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
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
