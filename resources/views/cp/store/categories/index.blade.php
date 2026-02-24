@extends('cp.layout')

@section('title', 'فئات المتجر')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('cp.store.products.index') }}" class="p-2 rounded-xl border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-colors" title="المنتجات">
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">فئات المتجر</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- إضافة فئة --}}
        <form action="{{ route('cp.store.categories.store') }}" method="post" class="rounded-2xl bg-white dark:bg-slate-800 border border-dashed border-slate-300 dark:border-slate-600 p-6 flex flex-col gap-3">
            @csrf
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">add_circle</span>
                إضافة فئة جديدة
            </h3>
            <input type="text" name="name_ar" required placeholder="اسم الفئة (عربي)" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5" />
            <input type="text" name="name_en" placeholder="اسم الفئة (إنجليزي)" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5" />
            <button type="submit" class="cp-btn px-4 py-2 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-medium">إضافة</button>
        </form>

        @foreach($categories as $cat)
            <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 flex flex-col gap-3">
                <form action="{{ route('cp.store.categories.update', $cat) }}" method="post" class="space-y-3" id="form-cat-{{ $cat->id }}">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-2 px-2 py-0.5 rounded-full text-xs bg-slate-100 dark:bg-slate-600 text-slate-600 dark:text-slate-300">{{ $cat->products_count }} منتج</span>
                        @if($cat->is_active)
                            <span class="text-xs text-primary font-medium">نشط</span>
                        @else
                            <span class="text-xs text-slate-400">مخفي</span>
                        @endif
                    </div>
                    <input type="text" name="name_ar" value="{{ old('name_ar', $cat->name_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 text-sm" />
                    <input type="text" name="name_en" value="{{ old('name_en', $cat->name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2.5 text-sm" />
                    <input type="number" name="sort_order" value="{{ $cat->sort_order }}" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-2 text-sm" placeholder="الترتيب" />
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="is_active" value="1" {{ $cat->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-primary" />
                        <span>فعالة</span>
                    </label>
                </form>
                <div class="flex gap-2">
                    <button type="submit" form="form-cat-{{ $cat->id }}" class="flex-1 px-3 py-2 rounded-xl bg-primary/10 text-primary text-sm font-medium hover:bg-primary/20">حفظ</button>
                    <button type="button" class="cp-delete-btn px-3 py-2 rounded-xl bg-red-500/10 text-red-600 text-sm hover:bg-red-500/20" data-url="{{ route('cp.store.categories.destroy', $cat) }}" data-message="حذف الفئة؟" data-remove=".rounded-2xl">حذف</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
(function() {
    var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    document.querySelectorAll('.cp-delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm(this.getAttribute('data-message') || 'حذف؟')) return;
            var url = this.getAttribute('data-url');
            var removeSel = this.getAttribute('data-remove');
            var el = removeSel ? this.closest(removeSel) || this.closest('div') : null;
            this.disabled = true;
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: '_method=DELETE'
            }).then(function(r) {
                if (r.ok) return r.json();
                throw new Error('خطأ في الحذف');
            }).then(function() {
                if (el) el.remove();
            }).catch(function() {
                alert('حدث خطأ، جرب مرة أخرى');
                btn.disabled = false;
            });
        });
    });
})();
</script>
@endpush
@endsection
