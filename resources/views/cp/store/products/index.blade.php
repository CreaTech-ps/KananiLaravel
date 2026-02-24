@extends('cp.layout')

@section('title', 'منتجات المتجر')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('cp.store.categories.index') }}" class="p-2 rounded-xl border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-colors" title="إدارة الفئات">
                <span class="material-symbols-outlined">category</span>
            </a>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">إدارة المنتجات</h2>
        </div>
        <a href="{{ route('cp.store.products.create') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة منتج
        </a>
    </div>

    {{-- تصفية --}}
    <form action="{{ route('cp.store.products.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[200px]">
                <label for="q" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">بحث</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="اسم المنتج..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
            </div>
            <div class="min-w-[180px]">
                <label for="category" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">الفئة</label>
                <select name="category" id="category" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">— الكل —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
        </div>
    </form>

    {{-- القائمة --}}
    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($products->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-5xl mb-3 block opacity-50">inventory_2</span>
                <p class="text-lg mb-2">لا توجد منتجات</p>
                <a href="{{ route('cp.store.products.create') }}" class="text-primary font-medium hover:underline inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg">add</span>
                    إضافة منتج
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الصورة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">المنتج</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الفئة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">السعر</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">المخزون</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-32">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($products as $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="" class="w-14 h-14 object-cover rounded-xl" />
                                    @else
                                        <span class="w-14 h-14 flex items-center justify-center rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-400">
                                            <span class="material-symbols-outlined text-2xl">image</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="font-medium text-slate-800 dark:text-white">{{ $item->name_ar }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    {{ $item->category?->name_ar ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm font-medium text-primary">
                                    {{ number_format($item->price) }} شيكل
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    {{ $item->stock }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->is_active)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-primary">نشط</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300">مخفي</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.store.products.edit', $item) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <button type="button" class="cp-delete-btn p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400" title="حذف" data-url="{{ route('cp.store.products.destroy', $item) }}" data-message="حذف هذا المنتج؟" data-remove="tr">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">
                    {{ $products->links() }}
                </div>
            @endif
        @endif
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
            var el = removeSel ? this.closest(removeSel) : null;
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
