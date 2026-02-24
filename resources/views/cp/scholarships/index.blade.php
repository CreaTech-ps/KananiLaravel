@extends('cp.layout')

@section('title', 'المنح الجامعية')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">إدارة المنح الجامعية</h2>
        <a href="{{ route('cp.scholarships.create') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة منحة
        </a>
    </div>

    <form action="{{ route('cp.scholarships.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[180px]">
                <label for="q" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">بحث</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="عنوان المنحة..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
            </div>
            <div class="min-w-[140px]">
                <label for="active" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">الحالة</label>
                <select name="active" id="active" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">الكل</option>
                    <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>نشطة</option>
                    <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>غير نشطة</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
        </div>
    </form>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($scholarships->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">school</span>
                لا توجد منح. <a href="{{ route('cp.scholarships.create') }}" class="text-primary font-medium hover:underline">إضافة منحة</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الصورة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">العنوان</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">فترة التقديم</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الطلبات</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-40">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($scholarships as $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="" class="w-14 h-14 object-cover rounded-lg" />
                                    @else
                                        <span class="w-14 h-14 flex items-center justify-center rounded-lg bg-slate-200 dark:bg-slate-600 text-slate-400">
                                            <span class="material-symbols-outlined text-2xl">image</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="font-medium text-slate-800 dark:text-white">{{ $item->title_ar }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    @if($item->application_start_date || $item->application_end_date)
                                        {{ $item->application_start_date?->format('Y-m-d') ?? '—' }} → {{ $item->application_end_date?->format('Y-m-d') ?? '—' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('cp.scholarship-applications.index', ['scholarship_id' => $item->id]) }}" class="text-primary hover:underline font-medium">{{ $item->applications_count ?? $item->applications()->count() }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->is_active)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-primary">نشطة</span>
                                    @else
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300">غير نشطة</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.scholarship-applications.index', ['scholarship_id' => $item->id]) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="طلبات التقديم">
                                            <span class="material-symbols-outlined text-lg">inbox</span>
                                        </a>
                                        <a href="{{ route('cp.scholarships.edit', $item) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.scholarships.destroy', $item) }}" method="post" class="inline" onsubmit="return confirm('حذف هذه المنحة؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400" title="حذف">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($scholarships->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">
                    {{ $scholarships->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
