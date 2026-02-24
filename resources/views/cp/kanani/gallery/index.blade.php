@extends('cp.layout')

@section('title', 'معرض كنعاني')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('cp.kanani.edit') }}" class="hover:text-primary">كنعاني</a>
            <span class="material-symbols-outlined text-lg">chevron_left</span>
            <span class="text-slate-700 dark:text-slate-300 font-medium">معرض الصور</span>
        </div>
        <a href="{{ route('cp.kanani.gallery.create') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة عنصر
        </a>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($items->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">photo_library</span>
                لا توجد عناصر في المعرض. <a href="{{ route('cp.kanani.gallery.create') }}" class="text-primary font-medium hover:underline">إضافة عنصر</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الصورة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">العنوان</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الترتيب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-32">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($items as $item)
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
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.kanani.gallery.edit', $item) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.kanani.gallery.destroy', $item) }}" method="post" class="inline" onsubmit="return confirm('حذف هذا العنصر؟');">
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
            @if($items->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">{{ $items->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
