@extends('cp.layout')

@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="w-full max-w-none space-y-6">
    {{-- Hero --}}
    <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">movie</span>
            قسم البطل (Hero)
        </h2>
        <form action="{{ route('cp.home.update') }}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نوع الوسائط</label>
                <select name="hero_type" class="cp-input w-full max-w-xs rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">
                    <option value="image" {{ old('hero_type', $home->hero_type) === 'image' ? 'selected' : '' }}>صورة</option>
                    <option value="video" {{ old('hero_type', $home->hero_type) === 'video' ? 'selected' : '' }}>فيديو</option>
                </select>
            </div>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الصورة / الفيديو</label>
                @if($home->hero_media_path)
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">الحالي: <a href="{{ asset('storage/' . $home->hero_media_path) }}" target="_blank" class="text-primary hover:underline">عرض</a></p>
                @endif
                <input type="file" name="hero_media" accept="image/*,video/*" class="cp-input w-full max-w-md rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="hero_title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان Hero (عربي)</label>
                    <input type="text" name="hero_title_ar" id="hero_title_ar" value="{{ old('hero_title_ar', $home->hero_title_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="hero_title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان Hero (إنجليزي)</label>
                    <input type="text" name="hero_title_en" id="hero_title_en" value="{{ old('hero_title_en', $home->hero_title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="hero_subtitle_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص التعريفي القصير (عربي)</label>
                <textarea name="hero_subtitle_ar" id="hero_subtitle_ar" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('hero_subtitle_ar', $home->hero_subtitle_ar) }}</textarea>
            </div>
            <div>
                <label for="hero_subtitle_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص التعريفي القصير (إنجليزي)</label>
                <textarea name="hero_subtitle_en" id="hero_subtitle_en" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('hero_subtitle_en', $home->hero_subtitle_en) }}</textarea>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div>
                    <label for="cta_text_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص زر الإجراء (عربي)</label>
                    <input type="text" name="cta_text_ar" id="cta_text_ar" value="{{ old('cta_text_ar', $home->cta_text_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="cta_text_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص زر الإجراء (إنجليزي)</label>
                    <input type="text" name="cta_text_en" id="cta_text_en" value="{{ old('cta_text_en', $home->cta_text_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="cta_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط زر الإجراء</label>
                    <input type="url" name="cta_url" id="cta_url" value="{{ old('cta_url', $home->cta_url) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">التقرير السنوي (PDF) — تنزيل مباشر من الصفحة الرئيسية</label>
                @if($home->annual_report_pdf_path ?? null)
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">الملف الحالي: <a href="{{ asset('storage/' . $home->annual_report_pdf_path) }}" target="_blank" rel="noopener" class="text-primary hover:underline">تحميل</a></p>
                @endif
                <input type="file" name="annual_report_pdf" accept=".pdf" class="cp-input w-full max-w-md rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
            </div>
            <div>
                <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">save</span>
                    حفظ إعدادات Hero
                </button>
            </div>
        </form>
    </section>

    {{-- إحصائيات الإنفوجرافيك --}}
    <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">bar_chart</span>
            إحصائيات الإنفوجرافيك
        </h2>

        <form action="{{ route('cp.home-statistics.store') }}" method="post" class="mb-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600">
            @csrf
            <p class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">إضافة إحصائية جديدة</p>
            <div class="flex flex-wrap items-end gap-3">
                <div class="min-w-[100px]">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">الرقم</label>
                    <input type="number" name="value" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" placeholder="مثال: 150" />
                </div>
                <div class="min-w-[160px]">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">الوصف (عربي)</label>
                    <input type="text" name="label_ar" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" placeholder="مثال: مستفيد" />
                </div>
                <div class="min-w-[120px]">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">الأيقونة</label>
                    <input type="text" name="icon" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" placeholder="اختياري" />
                </div>
                <div class="min-w-[80px]">
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">الترتيب</label>
                    <input type="number" name="sort_order" value="0" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-medium">إضافة</button>
            </div>
        </form>

        <div class="rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            @if($statistics->isEmpty())
                <div class="p-8 text-center text-slate-500 dark:text-slate-400 text-sm">لا توجد إحصائيات. أضف إحصائية من النموذج أعلاه.</div>
            @else
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الرقم</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الوصف (عربي)</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الأيقونة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الترتيب</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-28">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($statistics as $stat)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $stat->value }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $stat->label_ar }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $stat->icon ?: '—' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $stat->sort_order }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('cp.home-statistics.edit', $stat) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('cp.home-statistics.destroy', $stat) }}" method="post" class="inline" onsubmit="return confirm('حذف هذه الإحصائية؟');">
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
            @endif
        </div>
    </section>
</div>
@endsection
