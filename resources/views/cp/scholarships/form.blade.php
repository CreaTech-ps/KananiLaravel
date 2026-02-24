@extends('cp.layout')

@section('title', $title)

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
        <a href="{{ route('cp.scholarships.index') }}" class="hover:text-primary">المنح الجامعية</a>
        <span class="material-symbols-outlined text-lg">chevron_left</span>
        <span>{{ $title }}</span>
    </div>

    <form action="{{ $item->id ? route('cp.scholarships.update', $item) : route('cp.scholarships.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($item->id)
            @method('PUT')
        @endif

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">البيانات الأساسية</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي) <span class="text-red-500">*</span></label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $item->title_ar) }}" required class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    @error('title_ar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $item->title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="slug_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (slug) عربي</label>
                    <input type="text" name="slug_ar" id="slug_ar" value="{{ old('slug_ar', $item->slug_ar) }}" placeholder="يُولّد تلقائياً إن تُرك فارغاً" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="slug_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط (slug) إنجليزي</label>
                    <input type="text" name="slug_en" id="slug_en" value="{{ old('slug_en', $item->slug_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
            </div>
            <div>
                <label for="summary_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملخص (عربي)</label>
                <textarea name="summary_ar" id="summary_ar" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('summary_ar', $item->summary_ar) }}</textarea>
            </div>
            <div>
                <label for="summary_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ملخص (إنجليزي)</label>
                <textarea name="summary_en" id="summary_en" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('summary_en', $item->summary_en) }}</textarea>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">الصورة واستمارة التقديم</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">صورة تعبيرية</label>
                    @if($item->image_path)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">الحالي: <img src="{{ asset('storage/' . $item->image_path) }}" alt="" class="inline-block w-20 h-20 object-cover rounded-lg" /></p>
                    @endif
                    <input type="file" name="image" accept="image/*" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
                </div>
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">استمارة التقديم (PDF)</label>
                    @if($item->application_form_pdf_path)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">ملف حالياً مرفوع. رفع ملف جديد يستبدله.</p>
                    @endif
                    <input type="file" name="application_form_pdf" accept=".pdf" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
                </div>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">فترة التقديم والحالة</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div>
                    <label for="application_start_date" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">بداية التقديم</label>
                    <input type="date" name="application_start_date" id="application_start_date" value="{{ old('application_start_date', $item->application_start_date?->format('Y-m-d')) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="application_end_date" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نهاية التقديم</label>
                    <input type="date" name="application_end_date" id="application_end_date" value="{{ old('application_end_date', $item->application_end_date?->format('Y-m-d')) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div class="flex items-end gap-3 pb-2.5">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">منحة نشطة (تظهر في الموقع)</span>
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="sort_order" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ترتيب العرض</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="coverage_percentage" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نسبة تغطية المنحة من الرسوم الفصلية (%)</label>
                    <input type="number" name="coverage_percentage" id="coverage_percentage" value="{{ old('coverage_percentage', $item->coverage_percentage) }}" min="0" max="100" placeholder="مثال: 60" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">مثال: 60 يعني أن المنحة تغطي 60% من الرسوم الفصلية</p>
                </div>
            </div>
        </section>

        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm space-y-4">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">التفاصيل والشروط والأوراق المطلوبة</h2>
            <div>
                <label for="details_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">التفاصيل (عربي)</label>
                <textarea name="details_ar" id="details_ar" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('details_ar', $item->details_ar) }}</textarea>
            </div>
            <div>
                <label for="details_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">التفاصيل (إنجليزي)</label>
                <textarea name="details_en" id="details_en" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('details_en', $item->details_en) }}</textarea>
            </div>
            <div>
                <label for="conditions_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الشروط (عربي)</label>
                <textarea name="conditions_ar" id="conditions_ar" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('conditions_ar', $item->conditions_ar) }}</textarea>
            </div>
            <div>
                <label for="conditions_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الشروط (إنجليزي)</label>
                <textarea name="conditions_en" id="conditions_en" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('conditions_en', $item->conditions_en) }}</textarea>
            </div>
            <div>
                <label for="required_documents_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الأوراق المطلوبة (عربي)</label>
                <textarea name="required_documents_ar" id="required_documents_ar" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('required_documents_ar', $item->required_documents_ar) }}</textarea>
            </div>
            <div>
                <label for="required_documents_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الأوراق المطلوبة (إنجليزي)</label>
                <textarea name="required_documents_en" id="required_documents_en" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('required_documents_en', $item->required_documents_en) }}</textarea>
            </div>
        </section>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cp.scholarships.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">إلغاء</a>
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                {{ $item->id ? 'حفظ التغييرات' : 'إضافة المنحة' }}
            </button>
        </div>
    </form>
</div>
@endsection
