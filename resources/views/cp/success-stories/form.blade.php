@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.success-stories.index') }}" class="hover:text-primary">قصص النجاح</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ $item->id ? route('cp.success-stories.update', $item) : route('cp.success-stories.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">المحتوى (يُعرض في سلايدر «إشادة من طلبتنا» بالصفحة الرئيسية)</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم صاحب القصة (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $item->title_ar) }}" required maxlength="80" placeholder="مثال: أحمد محمود" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">حد أقصى 80 حرفاً</p>
                    @error('title_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف التحتي (اختياري)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $item->title_en) }}" maxlength="120" placeholder="مثال: خريج هندسة حاسوب - دفعة 2023" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">حد أقصى 120 حرفاً (يظهر تحت الاسم في السلايدر)</p>
                    @error('title_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label for="content_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص الإشادة (عربي) <span class="text-red-500">*</span></label>
                <textarea name="content_ar" id="content_ar" rows="4" maxlength="350" placeholder="اقتباس أو شهادة من صاحب القصة..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('content_ar', $item->content_ar) }}</textarea>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">حد أقصى 350 حرفاً و 50 كلمة (مناسب لعرض السلايدر)</p>
                @error('content_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="content_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص الإشادة (إنجليزي، اختياري)</label>
                <textarea name="content_en" id="content_en" rows="4" maxlength="350" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('content_en', $item->content_en) }}</textarea>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">حد أقصى 350 حرفاً</p>
                @error('content_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">الصورة والعرض</h2>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صورة القصة</label>
                <div id="story-image-drop-zone" class="min-h-[200px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                    @if($item->image_path)
                    <div id="story-current-wrap">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الصورة الحالية</p>
                        <img id="story-current-img" src="{{ asset('storage/' . $item->image_path) }}" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    @else
                    <div id="story-current-wrap" class="hidden"></div>
                    @endif
                    <div id="story-new-preview" class="hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الصورة الجديدة</p>
                        <img id="story-new-preview-img" src="" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    <div id="story-no-image" class="{{ $item->image_path ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-1 block">image</span>
                        <span class="text-sm">اختر صورة أو اسحبها هنا</span>
                    </div>
                    <input type="file" name="image" id="story-image-input" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                </div>
                @error('image')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="flex flex-wrap items-center gap-4">
                <div>
                    <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <label class="inline-flex items-center gap-2 cursor-pointer pt-6">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">إبراز في الرئيسية</span>
                </label>
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.success-stories.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة القصة' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var imageInput = document.getElementById('story-image-input');
    var currentWrap = document.getElementById('story-current-wrap');
    var newPreview = document.getElementById('story-new-preview');
    var newPreviewImg = document.getElementById('story-new-preview-img');
    var noImage = document.getElementById('story-no-image');

    function showNewPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            newPreviewImg.src = e.target.result;
            newPreview.classList.remove('hidden');
            if (currentWrap) currentWrap.classList.add('hidden');
            noImage.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    imageInput.addEventListener('change', function() {
        showNewPreview(this.files[0]);
    });

    var dropZone = document.getElementById('story-image-drop-zone');
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
