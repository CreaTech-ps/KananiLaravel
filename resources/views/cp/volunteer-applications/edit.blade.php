@extends('cp.layout')

@section('title', 'تعديل طلب التطوع')

@section('content')
<div class="w-full max-w-2xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.volunteer-applications.index') }}" class="hover:text-primary">طلبات التطوع</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>تعديل الطلب</span>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>الاسم:</strong> {{ $volunteer_application->name }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>البريد الإلكتروني:</strong> {{ $volunteer_application->email }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>رقم التواصل:</strong> {{ $volunteer_application->phone }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>القسم:</strong> {{ $volunteer_application->department->name_ar ?? '—' }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>السيرة الذاتية:</strong> <a href="{{ asset('storage/' . $volunteer_application->cv_path) }}" target="_blank" class="text-primary hover:underline">تحميل</a></p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>تاريخ التقديم:</strong> {{ $volunteer_application->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <form action="{{ route('cp.volunteer-applications.update', $volunteer_application) }}" method="post" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="status" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الحالة</label>
            <select name="status" id="status" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                <option value="pending" {{ $volunteer_application->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="under_review" {{ $volunteer_application->status === 'under_review' ? 'selected' : '' }}>قيد المراجعة</option>
                <option value="approved" {{ $volunteer_application->status === 'approved' ? 'selected' : '' }}>مقبول</option>
                <option value="rejected" {{ $volunteer_application->status === 'rejected' ? 'selected' : '' }}>مرفوض</option>
            </select>
        </div>
        <div>
            <label for="admin_notes" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملاحظات إدارية</label>
            <textarea name="admin_notes" id="admin_notes" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('admin_notes', $volunteer_application->admin_notes) }}</textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.volunteer-applications.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ
            </button>
        </div>
    </form>
</div>
@endsection
