@extends('cp.layout')

@section('title', 'تعديل قسم تطوع')

@section('content')
<div class="w-full max-w-2xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.volunteer-departments.index') }}" class="hover:text-primary">أقسام التطوع</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>تعديل القسم</span>
    </div>

    <form action="{{ route('cp.volunteer-departments.update', $volunteerDepartment) }}" method="post" class="space-y-6">
        @csrf
        @method('PUT')

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">البيانات</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="name_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الاسم (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $volunteerDepartment->name_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    @error('name_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="name_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الاسم (إنجليزي)</label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $volunteerDepartment->name_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                <input type="number" name="order" id="order" value="{{ old('order', $volunteerDepartment->order) }}" min="0" class="cp-input w-32 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $volunteerDepartment->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                <label for="is_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">نشط (يظهر في نموذج التطوع)</label>
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.volunteer-departments.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ التغييرات
            </button>
        </div>
    </form>
</div>
@endsection
