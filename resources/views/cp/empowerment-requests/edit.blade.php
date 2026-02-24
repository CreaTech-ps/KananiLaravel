@extends('cp.layout')

@section('title', 'تعديل طلب المساهمة')

@section('content')
<div class="w-full max-w-2xl space-y-6">
    @if(session('success'))
        <div class="rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
            <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.empowerment-requests.index') }}" class="hover:text-primary">طلبات المساهمة</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>تعديل الطلب</span>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">معلومات الطلب</h3>
        <div class="space-y-3">
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">الاسم</p>
                <p class="text-sm font-medium text-slate-800 dark:text-white">{{ $empowerment_request->name }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">البريد الإلكتروني</p>
                <p class="text-sm text-slate-700 dark:text-slate-300">
                    <a href="mailto:{{ $empowerment_request->email }}" class="text-primary hover:underline">{{ $empowerment_request->email }}</a>
                </p>
            </div>
            @if($empowerment_request->phone)
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">رقم الهاتف</p>
                    <p class="text-sm text-slate-700 dark:text-slate-300">
                        <a href="tel:{{ $empowerment_request->phone }}" class="text-primary hover:underline">{{ $empowerment_request->phone }}</a>
                    </p>
                </div>
            @endif
            @if($empowerment_request->message)
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">الرسالة</p>
                    <p class="text-sm text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $empowerment_request->message }}</p>
                </div>
            @endif
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">تاريخ الإرسال</p>
                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $empowerment_request->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('cp.empowerment-requests.update', $empowerment_request) }}" method="post" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="status" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الحالة</label>
            <select name="status" id="status" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                <option value="pending" {{ $empowerment_request->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="contacted" {{ $empowerment_request->status === 'contacted' ? 'selected' : '' }}>تم التواصل</option>
                <option value="closed" {{ $empowerment_request->status === 'closed' ? 'selected' : '' }}>مغلق</option>
            </select>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.empowerment-requests.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ
            </button>
        </div>
    </form>
</div>
@endsection
