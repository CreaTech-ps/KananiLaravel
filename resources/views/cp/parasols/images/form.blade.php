@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.parasols.edit') }}" class="hover:text-primary">المظلات</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <a href="{{ route('cp.parasols.regions.index') }}" class="hover:text-primary">المناطق</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <a href="{{ route('cp.parasols.regions.images.index', $region) }}" class="hover:text-primary">{{ $region->name_ar }}</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <div class="rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/20 p-3 text-sm text-slate-600 dark:text-slate-300 mb-4">
        بطاقة المساحة الإعلانية تظهر في معرض صفحة المظلات: الصورة، العنوان (مثل: مدخل الحرم الجامعي - B2)، الموقع، السعر، الحالة (متاح حالياً / ينتهي قريباً).
    </div>

    <form action="{{ $item->id ? route('cp.parasols.regions.images.update', [$region, $item]) : route('cp.parasols.regions.images.store', $region) }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">image</span>
                صورة المساحة
            </h2>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صورة المساحة @if(!$item->id)<span class="text-red-500">*</span>@endif</label>
                <div id="parasols-image-drop-zone" class="min-h-[200px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                    @if($item->image_path ?? null)
                    <div id="parasols-current-wrap">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الصورة الحالية</p>
                        <img id="parasols-current-img" src="{{ asset('storage/' . $item->image_path) }}" alt="" class="max-h-40 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    @else
                    <div id="parasols-current-wrap" class="hidden"></div>
                    @endif
                    <div id="parasols-new-preview" class="hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الصورة الجديدة</p>
                        <img id="parasols-new-preview-img" src="" alt="" class="max-h-40 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    <div id="parasols-no-image" class="{{ ($item->image_path ?? null) ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined text-4xl mb-1 block">image</span>
                        <span class="text-sm">اختر صورة أو اسحبها هنا</span>
                    </div>
                    <input type="file" name="image" id="parasols-image-input" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                </div>
                @error('image')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">dashboard</span>
                بيانات البطاقة (كما تظهر في المعرض)
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي)</label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $item->title_ar) }}" placeholder="مدخل الحرم الجامعي - B2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $item->title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="location_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الموقع (عربي)</label>
                    <input type="text" name="location_ar" id="location_ar" value="{{ old('location_ar', $item->location_ar) }}" placeholder="البوابة الغربية - منطقة الصراف الآلي" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="location_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الموقع (إنجليزي)</label>
                    <input type="text" name="location_en" id="location_en" value="{{ old('location_en', $item->location_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="detailed_location_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الموقع بالتفصيل (عربي)</label>
                    <textarea name="detailed_location_ar" id="detailed_location_ar" rows="2" placeholder="وصف تفصيلي للموقع..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('detailed_location_ar', $item->detailed_location_ar) }}</textarea>
                </div>
                <div>
                    <label for="detailed_location_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الموقع بالتفصيل (إنجليزي)</label>
                    <textarea name="detailed_location_en" id="detailed_location_en" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('detailed_location_en', $item->detailed_location_en) }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">السعر (يظهر كـ $320/شهر)</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $item->price) }}" placeholder="320" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="status" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الحالة (في البطاقة)</label>
                    <select name="status" id="status" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                        <option value="available" {{ old('status', $item->status) === 'available' || old('status', $item->status) === null ? 'selected' : '' }}>متاحة للحجز</option>
                        <option value="newly_booked" {{ old('status', $item->status) === 'newly_booked' ? 'selected' : '' }}>جديدة (محجوزة حديثاً)</option>
                        <option value="ending_soon" {{ old('status', $item->status) === 'ending_soon' ? 'selected' : '' }}>تنتهي قريباً (ستكون متاحة للحجز قريباً)</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">business</span>
                الجهة المعلنة (تظهر فقط عند الحالة "منتهية")
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">عندما تكون حالة المساحة "منتهية"، يمكنك إضافة معلومات الجهة المعلنة التي حجزت المساحة.</p>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="advertiser_name_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم الجهة المعلنة (عربي)</label>
                    <input type="text" name="advertiser_name_ar" id="advertiser_name_ar" value="{{ old('advertiser_name_ar', $item->advertiser_name_ar) }}" placeholder="اسم الشركة أو المؤسسة" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="advertiser_name_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم الجهة المعلنة (إنجليزي)</label>
                    <input type="text" name="advertiser_name_en" id="advertiser_name_en" value="{{ old('advertiser_name_en', $item->advertiser_name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">شعار الجهة المعلنة</label>
                <div class="min-h-[150px] rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 p-4 flex flex-col items-center justify-center gap-3 transition-colors hover:border-primary/50 dark:hover:border-primary/50">
                    @if($item->advertiser_logo_path ?? null)
                    <div id="advertiser-current-wrap">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الشعار الحالي</p>
                        <img id="advertiser-current-img" src="{{ asset('storage/' . $item->advertiser_logo_path) }}" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    @else
                    <div id="advertiser-current-wrap" class="hidden"></div>
                    @endif
                    <div id="advertiser-new-preview" class="hidden">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">معاينة الشعار الجديد</p>
                        <img id="advertiser-new-preview-img" src="" alt="" class="max-h-32 w-auto max-w-full object-contain rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                    </div>
                    <div id="advertiser-no-image" class="{{ ($item->advertiser_logo_path ?? null) ? 'hidden' : '' }} text-center text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined text-3xl mb-1 block">image</span>
                        <span class="text-sm">اختر شعار أو اسحبه هنا</span>
                    </div>
                    <input type="file" name="advertiser_logo" id="advertiser-logo-input" accept="image/*" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                </div>
                @error('advertiser_logo')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.parasols.regions.images.index', $region) }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة المساحة' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var imageInput = document.getElementById('parasols-image-input');
    var currentWrap = document.getElementById('parasols-current-wrap');
    var newPreview = document.getElementById('parasols-new-preview');
    var newPreviewImg = document.getElementById('parasols-new-preview-img');
    var noImage = document.getElementById('parasols-no-image');

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

    // Advertiser logo preview
    var advertiserInput = document.getElementById('advertiser-logo-input');
    var advertiserCurrentWrap = document.getElementById('advertiser-current-wrap');
    var advertiserNewPreview = document.getElementById('advertiser-new-preview');
    var advertiserNewPreviewImg = document.getElementById('advertiser-new-preview-img');
    var advertiserNoImage = document.getElementById('advertiser-no-image');

    function showAdvertiserPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            advertiserNewPreviewImg.src = e.target.result;
            advertiserNewPreview.classList.remove('hidden');
            if (advertiserCurrentWrap) advertiserCurrentWrap.classList.add('hidden');
            advertiserNoImage.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    if (advertiserInput) {
        advertiserInput.addEventListener('change', function() {
            showAdvertiserPreview(this.files[0]);
        });
    }

    var dropZone = document.getElementById('parasols-image-drop-zone');
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
