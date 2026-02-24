@extends('cp.layout')

@section('title', $title)

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: 200px; font-family: 'Tajawal', sans-serif; }
    .ql-container { font-size: 1rem; }
    .ql-toolbar.ql-snow { border-radius: 0.75rem 0.75rem 0 0; border-color: rgb(203 213 225); }
    .dark .ql-toolbar.ql-snow { border-color: rgb(71 85 105); }
    .ql-container.ql-snow { border-radius: 0 0 0.75rem 0.75rem; border-color: rgb(203 213 225); }
    .dark .ql-container.ql-snow { border-color: rgb(71 85 105); }
    .dark .ql-toolbar.ql-snow { background: rgb(51 65 85); }
    .dark .ql-container.ql-snow { background: rgb(51 65 85); color: rgb(226 232 240); }
    .cp-image-preview-area { min-height: 180px; }
</style>
@endpush

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.news.index') }}" class="hover:text-primary">الأخبار</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form id="news-form" action="{{ $item->id ? route('cp.news.update', $item) : route('cp.news.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">المحتوى</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $item->title_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                    @error('title_ar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $item->title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="slug_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (slug) عربي</label>
                    <input type="text" name="slug_ar" id="slug_ar" value="{{ old('slug_ar', $item->slug_ar) }}" placeholder="يُولّد تلقائياً إن تُرك فارغاً" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="slug_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (slug) إنجليزي</label>
                    <input type="text" name="slug_en" id="slug_en" value="{{ old('slug_en', $item->slug_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>

            <div>
                <label for="summary_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملخص (عربي)</label>
                <textarea name="summary_ar" id="summary_ar" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('summary_ar', $item->summary_ar) }}</textarea>
            </div>
            <div>
                <label for="summary_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملخص (إنجليزي)</label>
                <textarea name="summary_en" id="summary_en" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('summary_en', $item->summary_en) }}</textarea>
            </div>

            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">المحتوى الكامل (عربي)</label>
                <div id="editor-ar" class="rounded-xl overflow-hidden border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700">{!! old('content_ar', $item->content_ar) !!}</div>
                <textarea name="content_ar" id="content_ar" class="hidden">{{ old('content_ar', $item->content_ar) }}</textarea>
            </div>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">المحتوى الكامل (إنجليزي)</label>
                <div id="editor-en" class="rounded-xl overflow-hidden border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700">{!! old('content_en', $item->content_en) !!}</div>
                <textarea name="content_en" id="content_en" class="hidden">{{ old('content_en', $item->content_en) }}</textarea>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">وسائط ونشر</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صورة الخبر</label>
                    <div id="image-drop-zone" class="cp-image-preview-area rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                        {{-- الصورة الحالية (عند التعديل) --}}
                        @if($item->image_path)
                        <div id="current-image-wrap">
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الصورة الحالية</p>
                            <img id="current-image" src="{{ asset('storage/' . $item->image_path) }}" alt="" class="max-h-40 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                        </div>
                        @else
                        <div id="current-image-wrap" class="hidden"></div>
                        @endif
                        {{-- معاينة الملف الجديد --}}
                        <div id="new-image-preview" class="hidden">
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الصورة الجديدة</p>
                            <img id="new-image-preview-img" src="" alt="" class="max-h-40 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                        </div>
                        {{-- placeholder عند عدم وجود صورة --}}
                        <div id="no-image-placeholder" class="{{ $item->image_path ?? false ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                            <span class="material-symbols-outlined text-4xl mb-1 block">image</span>
                            <span class="text-sm">اختر صورة أو اسحبها هنا</span>
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="video_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط فيديو (اختياري)</label>
                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $item->video_url) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                    </div>
                    <div>
                        <label for="published_at" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تاريخ النشر</label>
                        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $item->published_at?->format('Y-m-d\TH:i')) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">منشور (يظهر في الموقع)</span>
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.news.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة الخبر' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // محرر Quill — عربي
    var editorAr = document.getElementById('editor-ar');
    var textareaAr = document.getElementById('content_ar');
    if (editorAr && textareaAr) {
        var quillAr = new Quill('#editor-ar', {
            theme: 'snow',
            placeholder: 'اكتب محتوى الخبر هنا...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
        quillAr.root.innerHTML = textareaAr.value || '';
        quillAr.root.setAttribute('dir', 'rtl');
    }

    // محرر Quill — إنجليزي
    var editorEn = document.getElementById('editor-en');
    var textareaEn = document.getElementById('content_en');
    if (editorEn && textareaEn) {
        var quillEn = new Quill('#editor-en', {
            theme: 'snow',
            placeholder: 'Write news content here...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
        quillEn.root.innerHTML = textareaEn.value || '';
    }

    // قبل الإرسال: نسخ محتوى المحرر إلى textarea
    document.getElementById('news-form').addEventListener('submit', function() {
        if (typeof quillAr !== 'undefined') textareaAr.value = quillAr.root.innerHTML;
        if (typeof quillEn !== 'undefined') textareaEn.value = quillEn.root.innerHTML;
    });

    // معاينة الصورة عند اختيار ملف
    var imageInput = document.getElementById('image');
    var currentWrap = document.getElementById('current-image-wrap');
    var newPreview = document.getElementById('new-image-preview');
    var newPreviewImg = document.getElementById('new-image-preview-img');
    var noPlaceholder = document.getElementById('no-image-placeholder');

    function showNewPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            newPreviewImg.src = e.target.result;
            newPreview.classList.remove('hidden');
            if (currentWrap) currentWrap.classList.add('hidden');
            noPlaceholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    imageInput.addEventListener('change', function() {
        showNewPreview(this.files[0]);
    });

    // سحب وإفلات للصورة
    var dropZone = document.getElementById('image-drop-zone');
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function(ev) {
            dropZone.addEventListener(ev, function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (ev === 'drop') {
                    var file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        imageInput.files = e.dataTransfer.files;
                        showNewPreview(file);
                    }
                }
            });
        });
    }
});
</script>
@endpush
@endsection
