@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.home.edit') }}" class="hover:text-primary">الصفحة الرئيسية</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ route('cp.home-statistics.update', $item) }}" method="post" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="value" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الرقم <span class="text-red-500">*</span></label>
            <input type="number" name="value" id="value" value="{{ old('value', $item->value) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            @error('value')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="label_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (عربي) <span class="text-red-500">*</span></label>
            <input type="text" name="label_ar" id="label_ar" value="{{ old('label_ar', $item->label_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            @error('label_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="label_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (إنجليزي)</label>
            <input type="text" name="label_en" id="label_en" value="{{ old('label_en', $item->label_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
        </div>
        <div>
            <label for="icon" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الأيقونة (اسم أو مسار)</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $item->icon) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="اختياري" />
        </div>
        <div>
            <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.home.edit') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ
            </button>
        </div>
    </form>
</div>
@endsection
