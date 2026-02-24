@extends('cp.layout')

@section('title', 'مناطق المظلات')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('cp.parasols.edit') }}" class="hover:text-primary">المظلات</a>
            <span class="material-symbols-outlined text-lg">chevron_left</span>
            <span class="text-slate-700 dark:text-slate-300 font-medium">المناطق والمساحات الإعلانية</span>
        </div>
        <a href="{{ route('cp.parasols.regions.create') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة منطقة
        </a>
    </div>

    <div class="rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/20 p-4 text-sm text-slate-600 dark:text-slate-300">
        <p class="font-medium text-slate-800 dark:text-white mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-lg">filter_list</span>
            تطابق صفحة العرض
        </p>
        <p class="mb-0">المناطق تظهر كفلتر في معرض المساحات (الكل، بيرزيت، رام الله، بيت لحم...). كل منطقة تجمع المساحات الإعلانية (البطاقات) الخاصة بها.</p>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($regions->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">map</span>
                لا توجد مناطق. <a href="{{ route('cp.parasols.regions.create') }}" class="text-primary font-medium hover:underline">إضافة منطقة</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">المنطقة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">عدد المساحات</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الترتيب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-48">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($regions as $region)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $region->name_ar }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $region->images_count ?? $region->images()->count() }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $region->sort_order }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('cp.parasols.regions.images.index', $region) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-500 transition-colors">
                                            <span class="material-symbols-outlined text-lg">photo_library</span>
                                            المساحات
                                        </a>
                                        <a href="{{ route('cp.parasols.regions.edit', $region) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.parasols.regions.destroy', $region) }}" method="post" class="inline" onsubmit="return confirm('حذف هذه المنطقة وجميع مساحاتها؟');">
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
        @endif
    </div>
</div>
@endsection
