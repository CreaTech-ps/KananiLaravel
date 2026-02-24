@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-2xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.parasols.edit') }}" class="hover:text-primary">المظلات</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <a href="{{ route('cp.parasols.regions.index') }}" class="hover:text-primary">المناطق</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ $item->id ? route('cp.parasols.regions.update', $item) : route('cp.parasols.regions.store') }}" method="post" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <div class="rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/20 p-3 text-sm text-slate-600 dark:text-slate-300 mb-4">
            اسم المنطقة يظهر في تبويبات فلتر المعرض على صفحة المظلات (مثل: بيرزيت، رام الله، بيت لحم).
        </div>
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">المنطقة</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="name_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم المنطقة (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $item->name_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    @error('name_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="name_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم المنطقة (إنجليزي)</label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $item->name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.parasols.regions.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة المنطقة' }}
            </button>
        </div>
    </form>
</div>
@endsection
