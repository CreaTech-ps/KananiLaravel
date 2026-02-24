@extends('cp.layout')

@section('title', $title)

@push('styles')
<style>
    .cp-image-preview-area { min-height: 200px; }
    .size-row { transition: opacity 0.2s; }
</style>
@endpush

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.store.products.index') }}" class="hover:text-primary">المنتجات</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form id="product-form" action="{{ $item->id ? route('cp.store.products.update', $item) : route('cp.store.products.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        {{-- المحتوى الأساسي --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                بيانات المنتج
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="name_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم المنتج (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $item->name_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="مثال: شال كنعاني فاخر" />
                    @error('name_ar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم المنتج (إنجليزي)</label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $item->name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="category_id" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الفئة</label>
                    <select name="category_id" id="category_id" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="">— بدون فئة —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="slug_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (slug) — يُولّد تلقائياً إن تُرك فارغاً</label>
                    <input type="text" name="slug_ar" id="slug_ar" value="{{ old('slug_ar', $item->slug_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="مثال: shal-kanani" />
                </div>
            </div>

            <div>
                <label for="description_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (عربي)</label>
                <textarea name="description_ar" id="description_ar" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="تطريز يدوي بخيوط الحرير...">{{ old('description_ar', $item->description_ar) }}</textarea>
            </div>
            <div>
                <label for="description_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (إنجليزي)</label>
                <textarea name="description_en" id="description_en" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('description_en', $item->description_en) }}</textarea>
            </div>
        </section>

        {{-- السعر والمخزون --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">payments</span>
                السعر والمخزون
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="old_price" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">السعر قبل الخصم (شيكل)</label>
                    <input type="number" name="old_price" id="old_price" value="{{ old('old_price', $item->old_price) }}" step="0.01" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="مثال: 200" />
                    <p class="mt-1 text-xs text-slate-500">السعر الأصلي قبل أي خصم</p>
                </div>
                <div>
                    <label for="discount_percent" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نسبة الخصم %</label>
                    <input type="number" name="discount_percent" id="discount_percent" value="{{ old('discount_percent', $item->discount_percent) }}" min="0" max="100" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="50" />
                    <p class="mt-1 text-xs text-slate-500">يُحسب السعر النهائي تلقائياً</p>
                </div>
                <div>
                    <label for="price" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">السعر النهائي (شيكل) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $item->price ?? 0) }}" step="0.01" min="0" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    <p class="mt-1 text-xs text-slate-500" id="price-hint">يُحسب من: السعر قبل الخصم × (1 − نسبة الخصم)</p>
                    @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stock" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">المخزون</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $item->stock ?? 0) }}" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
        </section>

        {{-- الصورة والمقاسات والألوان --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-6">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">image</span>
                الصورة والمقاسات والألوان
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">صور المنتج (1–4 صور)</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">يجب إضافة صورة واحدة على الأقل، بحد أقصى 4 صور.</p>
                    <div id="product-images-container" class="space-y-3">
                        {{-- الصور الحالية --}}
                        @php $existingImages = $item->image_paths ?? []; @endphp
                        @foreach($existingImages as $idx => $path)
                            <div class="product-image-row flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600">
                                <input type="hidden" name="images_keep[]" value="{{ $path }}" />
                                <img src="{{ asset('storage/' . $path) }}" alt="" class="w-16 h-16 object-cover rounded-lg shrink-0" />
                                <span class="text-sm text-slate-600 dark:text-slate-300 flex-1">صورة {{ $idx + 1 }}</span>
                                <button type="button" class="btn-remove-image p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 text-slate-500 hover:text-red-600" title="حذف">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                        @endforeach
                        {{-- مساحة رفع صور جديدة --}}
                        @if(count($existingImages) < 4)
                            <div id="new-images-wrap" class="space-y-2">
                                <input type="file" name="images_new[]" accept="image/*" multiple class="product-images-input cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary text-sm" />
                            </div>
                            <div id="new-images-preview" class="flex flex-wrap gap-3"></div>
                            <p id="images-count-hint" class="text-xs text-slate-500 dark:text-slate-400">
                                @if(count($existingImages) === 0)
                                    يلزم إضافة من 1 إلى 4 صور
                                @else
                                    المتبقي: يمكن إضافة حتى {{ 4 - count($existingImages) }} صورة إضافية
                                @endif
                            </p>
                        @endif
                    </div>
                    @error('images_new')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">المقاسات</label>
                        <div id="sizes-container" class="space-y-2">
                            @foreach(old('sizes', $item->sizes->isNotEmpty() ? $item->sizes->pluck('size_ar')->toArray() : ['']) as $idx => $s)
                                <div class="size-row flex gap-2">
                                    <input type="text" name="sizes[]" value="{{ $s }}" placeholder="مثال: ٢٠٠ × ٧٠ سم" class="cp-input flex-1 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 text-sm" />
                                    <button type="button" class="btn-remove-size p-2 rounded-lg border border-slate-300 dark:border-slate-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-500 hover:text-red-600" title="حذف">
                                        <span class="material-symbols-outlined text-lg">remove_circle</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-add-size" class="mt-2 inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm text-primary hover:bg-primary/10 transition-colors">
                            <span class="material-symbols-outlined text-lg">add</span>
                            إضافة مقاس
                        </button>
                    </div>

                    @if($colors->isNotEmpty())
                    <div>
                        <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">الألوان</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($colors as $c)
                                <label class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 hover:border-primary/50 cursor-pointer transition-colors">
                                    @if($c->hex_code)
                                        <span class="w-5 h-5 rounded-full border border-slate-300 shrink-0" style="background-color: {{ $c->hex_code }}"></span>
                                    @endif
                                    <span class="text-sm">{{ $c->name_ar }}</span>
                                    <input type="checkbox" name="color_ids[]" value="{{ $c->id }}" {{ in_array($c->id, old('color_ids', $item->colors->pluck('id')->toArray())) ? 'checked' : '' }} class="rounded border-slate-300 text-primary" />
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center gap-3 pt-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary/30" />
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">المنتج نشط (يظهر في المتجر)</span>
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.store.products.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة المنتج' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // صور المنتج (1–4)
    var container = document.getElementById('product-images-container');
    var newPreview = document.getElementById('new-images-preview');
    var newInput = document.querySelector('.product-images-input');
    var hint = document.getElementById('images-count-hint');
    var maxImages = 4;

    function countKept() {
        return (container?.querySelectorAll('input[name="images_keep[]"]')?.length ?? 0);
    }
    function countNewPreviews() {
        return (newPreview?.querySelectorAll('.new-img-preview')?.length ?? 0);
    }
    function totalImages() {
        return countKept() + (newInput?.files?.length ?? 0);
    }

    function updateHint() {
        if (!hint) return;
        var kept = countKept();
        var newCount = newInput?.files?.length ?? 0;
        var total = kept + newCount;
        var remaining = Math.max(0, maxImages - total);
        hint.textContent = 'المجموع: ' + total + ' من 4 — يمكن إضافة حتى ' + remaining + ' صورة إضافية';
    }

    container?.addEventListener('click', function(e) {
        var btn = e.target.closest('.btn-remove-image');
        if (!btn) return;
        var row = btn.closest('.product-image-row');
        if (row) {
            row.remove();
            updateHint();
        }
    });

    newInput?.addEventListener('change', function() {
        if (!newPreview) return;
        newPreview.innerHTML = '';
        var files = Array.from(this.files || []);
        files.slice(0, maxImages - countKept()).forEach(function(file) {
            if (!file.type.startsWith('image/')) return;
            var reader = new FileReader();
            reader.onload = function(ev) {
                var div = document.createElement('div');
                div.className = 'new-img-preview relative inline-block';
                div.innerHTML = '<img src="' + ev.target.result + '" class="w-20 h-20 object-cover rounded-lg border border-slate-200 dark:border-slate-600" alt="" />';
                newPreview.appendChild(div);
                updateHint();
            };
            reader.readAsDataURL(file);
        });
        updateHint();
    });

    if (hint) updateHint();

    // المقاسات الديناميكية
    var sizesContainer = document.getElementById('sizes-container');
    var btnAddSize = document.getElementById('btn-add-size');
    if (btnAddSize && sizesContainer) {
        btnAddSize.addEventListener('click', function() {
            var row = document.createElement('div');
            row.className = 'size-row flex gap-2';
            row.innerHTML = '<input type="text" name="sizes[]" placeholder="مثال: ٢٠٠ × ٧٠ سم" class="cp-input flex-1 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 text-sm" /><button type="button" class="btn-remove-size p-2 rounded-lg border border-slate-300 dark:border-slate-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-500 hover:text-red-600"><span class="material-symbols-outlined text-lg">remove_circle</span></button>';
            sizesContainer.appendChild(row);
        });
        sizesContainer.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-size')) {
                var row = e.target.closest('.size-row');
                if (sizesContainer.querySelectorAll('.size-row').length > 1) row.remove();
            }
        });
    }

    // ربط السعر قبل الخصم ونسبة الخصم والسعر النهائي
    var oldPriceEl = document.getElementById('old_price');
    var discountEl = document.getElementById('discount_percent');
    var priceEl = document.getElementById('price');
    var priceHint = document.getElementById('price-hint');

    function syncFromOldPriceAndDiscount() {
        var oldPrice = parseFloat(oldPriceEl?.value) || 0;
        var discount = parseFloat(discountEl?.value) || 0;
        if (oldPrice > 0 && discount >= 0 && discount <= 100) {
            var price = oldPrice * (1 - discount / 100);
            price = Math.round(price * 100) / 100;
            if (priceEl) priceEl.value = price;
        }
    }

    function syncFromOldPriceAndPrice() {
        var oldPrice = parseFloat(oldPriceEl?.value) || 0;
        var price = parseFloat(priceEl?.value) || 0;
        if (oldPrice > 0 && price >= 0 && price <= oldPrice) {
            var discount = Math.round(((oldPrice - price) / oldPrice) * 100);
            if (discountEl) discountEl.value = discount;
        }
    }

    function syncFromPriceAndDiscount() {
        var price = parseFloat(priceEl?.value) || 0;
        var discount = parseFloat(discountEl?.value) || 0;
        if (price > 0 && discount > 0 && discount < 100) {
            var oldPrice = price / (1 - discount / 100);
            oldPrice = Math.round(oldPrice * 100) / 100;
            if (oldPriceEl) oldPriceEl.value = oldPrice;
        }
    }

    oldPriceEl?.addEventListener('input', syncFromOldPriceAndDiscount);
    oldPriceEl?.addEventListener('blur', function() {
        syncFromOldPriceAndDiscount();
        if ((parseFloat(discountEl?.value) || 0) === 0) syncFromOldPriceAndPrice();
    });
    discountEl?.addEventListener('input', syncFromOldPriceAndDiscount);
    discountEl?.addEventListener('blur', syncFromOldPriceAndDiscount);
    priceEl?.addEventListener('input', function() {
        if (parseFloat(oldPriceEl?.value) > 0) syncFromOldPriceAndPrice();
    });
    priceEl?.addEventListener('blur', function() {
        var oldPrice = parseFloat(oldPriceEl?.value) || 0;
        var discount = parseFloat(discountEl?.value) || 0;
        if (oldPrice > 0 && discount > 0) syncFromOldPriceAndDiscount();
        else if (oldPrice > 0) syncFromOldPriceAndPrice();
    });
});
</script>
@endpush
@endsection
