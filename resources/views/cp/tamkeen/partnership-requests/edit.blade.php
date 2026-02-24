@extends('cp.layout')

@section('title', 'تعديل طلب الشراكة')

@section('content')
<div class="w-full max-w-2xl space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.tamkeen.partnership-requests.index') }}" class="hover:text-primary">طلبات الشراكة تمكين</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>تعديل الطلب</span>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>اسم الشركة:</strong> {{ $tamkeen_partnership_request->company_name }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>اسم المسؤول:</strong> {{ $tamkeen_partnership_request->contact_name }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>البريد الإلكتروني:</strong> {{ $tamkeen_partnership_request->email }}</p>
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>رقم التواصل:</strong> {{ $tamkeen_partnership_request->phone }}</p>
        @if($tamkeen_partnership_request->message)
            <p class="text-sm text-slate-600 dark:text-slate-400"><strong>الرسالة:</strong> {{ $tamkeen_partnership_request->message }}</p>
        @endif
        <p class="text-sm text-slate-600 dark:text-slate-400"><strong>تاريخ التقديم:</strong> {{ $tamkeen_partnership_request->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <form action="{{ route('cp.tamkeen.partnership-requests.update', $tamkeen_partnership_request) }}" method="post" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="status" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الحالة</label>
            <select name="status" id="status" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                <option value="pending" {{ $tamkeen_partnership_request->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="under_review" {{ $tamkeen_partnership_request->status === 'under_review' ? 'selected' : '' }}>قيد المراجعة</option>
                <option value="approved" {{ $tamkeen_partnership_request->status === 'approved' ? 'selected' : '' }}>مقبول</option>
                <option value="rejected" {{ $tamkeen_partnership_request->status === 'rejected' ? 'selected' : '' }}>مرفوض</option>
            </select>
        </div>
        <div>
            <label for="admin_notes" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملاحظات إدارية</label>
            <textarea name="admin_notes" id="admin_notes" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('admin_notes', $tamkeen_partnership_request->admin_notes) }}</textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.tamkeen.partnership-requests.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ
            </button>
        </div>
    </form>
</div>
@endsection
