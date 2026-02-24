@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-2xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.tamkeen.partnerships.index') }}" class="hover:text-primary">تمكين</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ $item->id ? route('cp.tamkeen.partnerships.update', $item) : route('cp.tamkeen.partnerships.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">البيانات</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="supporter_name_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم الجهة الداعمة (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="supporter_name_ar" id="supporter_name_ar" value="{{ old('supporter_name_ar', $item->supporter_name_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    @error('supporter_name_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="supporter_name_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم الجهة الداعمة (إنجليزي)</label>
                    <input type="text" name="supporter_name_en" id="supporter_name_en" value="{{ old('supporter_name_en', $item->supporter_name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="sector" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">القطاع</label>
                <select name="sector" id="sector" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                    <option value="">اختر القطاع</option>
                    <option value="tech" {{ old('sector', $item->sector) === 'tech' ? 'selected' : '' }}>التكنولوجيا</option>
                    <option value="banking" {{ old('sector', $item->sector) === 'banking' ? 'selected' : '' }}>المصرفية</option>
                    <option value="industry" {{ old('sector', $item->sector) === 'industry' ? 'selected' : '' }}>الصناعة</option>
                    <option value="logistics" {{ old('sector', $item->sector) === 'logistics' ? 'selected' : '' }}>اللوجستيات</option>
                </select>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تاريخ البدء</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $item->start_date?->format('Y-m-d')) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="beneficiaries_count" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عدد الطلبة المستفيدين</label>
                    <input type="number" name="beneficiaries_count" id="beneficiaries_count" value="{{ old('beneficiaries_count', $item->beneficiaries_count) }}" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="link" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (اختياري)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $item->link) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
            <div>
                <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">الشعار</h2>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صورة الشعار (اختياري)</label>
                <div id="tamkeen-logo-drop-zone" class="min-h-[200px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                    @if($item->logo_path)
                    <div id="tamkeen-current-wrap">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الشعار الحالي</p>
                        <img id="tamkeen-current-img" src="{{ asset('storage/' . $item->logo_path) }}" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    @else
                    <div id="tamkeen-current-wrap" class="hidden"></div>
                    @endif
                    <div id="tamkeen-new-preview" class="hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الشعار الجديد</p>
                        <img id="tamkeen-new-preview-img" src="" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    <div id="tamkeen-no-logo" class="{{ $item->logo_path ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-1 block">image</span>
                        <span class="text-sm">اختر شعاراً أو اسحبه هنا</span>
                    </div>
                    <input type="file" name="logo" id="tamkeen-logo-input" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                </div>
                @error('logo')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.tamkeen.partnerships.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة الشراكة' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var logoInput = document.getElementById('tamkeen-logo-input');
    var currentWrap = document.getElementById('tamkeen-current-wrap');
    var newPreview = document.getElementById('tamkeen-new-preview');
    var newPreviewImg = document.getElementById('tamkeen-new-preview-img');
    var noLogo = document.getElementById('tamkeen-no-logo');

    function showNewLogoPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            newPreviewImg.src = e.target.result;
            newPreview.classList.remove('hidden');
            if (currentWrap) currentWrap.classList.add('hidden');
            noLogo.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    logoInput.addEventListener('change', function() {
        showNewLogoPreview(this.files[0]);
    });

    var dropZone = document.getElementById('tamkeen-logo-drop-zone');
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function(ev) {
            dropZone.addEventListener(ev, function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (ev === 'drop') {
                    var file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        logoInput.files = e.dataTransfer.files;
                        showNewLogoPreview(file);
                    }
                }
            });
        });
    }
});
</script>
@endpush
@endsection
