@extends('cp.layout')

@section('title', 'طلبات التطوع')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">طلبات التطوع</h2>
    </div>

    <form action="{{ route('cp.volunteer-applications.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[200px] flex-1">
                <label for="q" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">بحث</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="اسم، بريد إلكتروني، رقم..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
            </div>
            <div class="min-w-[200px]">
                <label for="department_id" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">القسم</label>
                <select name="department_id" id="department_id" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">الكل</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[140px]">
                <label for="status" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">الحالة</label>
                <select name="status" id="status" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">الكل</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>قيد المراجعة</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>مقبول</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
        </div>
    </form>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($applications->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">inbox</span>
                لا توجد طلبات تطوع.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الاسم</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">البريد الإلكتروني</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">رقم التواصل</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">القسم</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">السيرة الذاتية</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">التاريخ</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-24">إجراء</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($applications as $app)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $app->name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-300">{{ $app->email }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $app->phone }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $app->department->name_ar ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="text-primary hover:underline text-sm">تحميل</a>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusLabels = ['pending' => 'قيد الانتظار', 'under_review' => 'قيد المراجعة', 'approved' => 'مقبول', 'rejected' => 'مرفوض'];
                                        $statusClass = match($app->status) { 'approved' => 'bg-primary/20 text-primary', 'rejected' => 'bg-red-500/20 text-red-600 dark:text-red-400', 'under_review' => 'bg-amber-500/20 text-amber-600 dark:text-amber-400', default => 'bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300' };
                                    @endphp
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">{{ $statusLabels[$app->status] ?? $app->status }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $app->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('cp.volunteer-applications.edit', $app) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل الحالة">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">{{ $applications->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
