@extends('cp.layout')

@section('title', 'مساحات منطقة ' . $region->name_ar)

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('cp.parasols.edit') }}" class="hover:text-primary">المظلات</a>
            <span class="material-symbols-outlined text-lg">chevron_left</span>
            <a href="{{ route('cp.parasols.regions.index') }}" class="hover:text-primary">المناطق</a>
            <span class="material-symbols-outlined text-lg">chevron_left</span>
            <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $region->name_ar }}</span>
        </div>
        <a href="{{ route('cp.parasols.regions.images.create', $region) }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">add</span>
            إضافة مساحة إعلانية
        </a>
    </div>

    <div class="rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/20 p-4 text-sm text-slate-600 dark:text-slate-300">
        <p class="font-medium text-slate-800 dark:text-white mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-lg">dashboard</span>
            تطابق صفحة العرض
        </p>
        <p class="mb-0">كل صف = بطاقة مساحة إعلانية في المعرض: الصورة، العنوان (مثل: مدخل الحرم الجامعي - B2)، الموقع، السعر، الحالة (متاح حالياً / ينتهي قريباً).</p>
    </div>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($images->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">photo_library</span>
                لا توجد مساحات في هذه المنطقة. <a href="{{ route('cp.parasols.regions.images.create', $region) }}" class="text-primary font-medium hover:underline">إضافة مساحة</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الصورة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">العنوان</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الموقع</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">السعر</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الترتيب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-32">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($images as $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="" class="w-16 h-16 object-cover rounded-lg shadow border border-slate-200 dark:border-slate-600" />
                                    @else
                                        <span class="w-16 h-16 flex items-center justify-center rounded-lg bg-slate-200 dark:bg-slate-600 text-slate-400">
                                            <span class="material-symbols-outlined text-2xl">image</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $item->title_ar ?: '—' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400 max-w-[180px] truncate" title="{{ $item->location_ar }}">{{ $item->location_ar ?: '—' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $item->price ? $item->price . ' $/شهر' : '—' }}</td>
                                <td class="px-4 py-3">
                                    @if($item->status === \App\Models\ParasolsImage::STATUS_ENDING_SOON)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300">ينتهي قريباً</span>
                                    @else
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">متاح حالياً</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $item->sort_order }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.parasols.regions.images.edit', [$region, $item]) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.parasols.regions.images.destroy', [$region, $item]) }}" method="post" class="inline" onsubmit="return confirm('حذف هذه المساحة؟');">
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
            @if($images->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">{{ $images->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
