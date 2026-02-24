@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.kanani.edit') }}" class="hover:text-primary">كنعاني</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <a href="{{ route('cp.kanani.gallery.index') }}" class="hover:text-primary">معرض الصور</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ $item->id ? route('cp.kanani.gallery.update', $item) : route('cp.kanani.gallery.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">المحتوى</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $item->title_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    @error('title_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $item->title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="description_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (عربي)</label>
                <textarea name="description_ar" id="description_ar" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('description_ar', $item->description_ar) }}</textarea>
            </div>
            <div>
                <label for="description_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (إنجليزي)</label>
                <textarea name="description_en" id="description_en" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('description_en', $item->description_en) }}</textarea>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">الصورة والترتيب</h2>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صورة العنصر @if(!$item->id)<span class="text-red-500">*</span>@endif</label>
                <div id="gallery-image-drop-zone" class="min-h-[200px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                    @if($item->image_path ?? null)
                    <div id="gallery-current-wrap">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الصورة الحالية</p>
                        <img id="gallery-current-img" src="{{ asset('storage/' . $item->image_path) }}" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    @else
                    <div id="gallery-current-wrap" class="hidden"></div>
                    @endif
                    <div id="gallery-new-preview" class="hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الصورة الجديدة</p>
                        <img id="gallery-new-preview-img" src="" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    <div id="gallery-no-image" class="{{ ($item->image_path ?? null) ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-1 block">image</span>
                        <span class="text-sm">اختر صورة أو اسحبها هنا</span>
                    </div>
                    <input type="file" name="image" id="gallery-image-input" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" {{ !$item->id ? '' : '' }} />
                </div>
                @error('image')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.kanani.gallery.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة العنصر' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var imageInput = document.getElementById('gallery-image-input');
    var currentWrap = document.getElementById('gallery-current-wrap');
    var newPreview = document.getElementById('gallery-new-preview');
    var newPreviewImg = document.getElementById('gallery-new-preview-img');
    var noImage = document.getElementById('gallery-no-image');

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

    var dropZone = document.getElementById('gallery-image-drop-zone');
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
