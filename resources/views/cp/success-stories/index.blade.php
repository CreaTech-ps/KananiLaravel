@extends('cp.layout')

@section('title', 'قصص النجاح')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">إدارة قصص النجاح</h2>
        <a href="{{ route('cp.success-stories.create') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة قصة
        </a>
    </div>

    <form action="{{ route('cp.success-stories.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[180px]">
                <label for="q" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">بحث</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="العنوان أو المحتوى..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
            </div>
            <div class="min-w-[140px]">
                <label for="featured" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">مميزة</label>
                <select name="featured" id="featured" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">الكل</option>
                    <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>مميزة</option>
                    <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>عادية</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
        </div>
    </form>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($stories->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">auto_stories</span>
                لا توجد قصص. <a href="{{ route('cp.success-stories.create') }}" class="text-primary font-medium hover:underline">إضافة قصة</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الصورة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">العنوان</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الترتيب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">مميزة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-32">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($stories as $item)
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
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $item->title_ar }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $item->sort_order }}</td>
                                <td class="px-4 py-3">
                                    @if($item->is_featured)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-primary">مميزة</span>
                                    @else
                                        <span class="text-slate-400 text-sm">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.success-stories.edit', $item) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.success-stories.destroy', $item) }}" method="post" class="inline" onsubmit="return confirm('حذف هذه القصة؟');">
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
            @if($stories->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">{{ $stories->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
