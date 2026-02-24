@extends('cp.layout')

@section('title', 'مشروع المظلات')

@section('content')
<div class="w-full max-w-none space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">إعدادات مشروع المظلات</h2>
        <a href="{{ route('cp.parasols.regions.index') }}" class="cp-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors">
            <span class="material-symbols-outlined text-xl">map</span>
            المناطق والمساحات الإعلانية
        </a>
    </div>

    {{-- خريطة المحتوى: توافق مع صفحة العرض --}}
    <div class="rounded-2xl bg-primary/5 dark:bg-primary/10 border border-primary/20 p-4 text-sm text-slate-600 dark:text-slate-300">
        <p class="font-medium text-slate-800 dark:text-white mb-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-lg">info</span>
            خريطة المحتوى (تطابق صفحة المظلات على الموقع)
        </p>
        <p class="mb-0">القسم البطل ← إحصائيات المشروع ← عنوان معرض المساحات + فلتر المناطق ← بطاقات المساحات (صورة، عنوان، موقع، سعر، حالة).</p>
    </div>

    <form action="{{ route('cp.parasols.update') }}" method="post" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- قسم البطل (Hero) --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">filter_drama</span>
                قسم البطل (Hero)
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">يظهر في أعلى صفحة المظلات: العنوان، النص التعريفي، وزرّا الإجراء.</p>
            <div class="space-y-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <label for="hero_title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان البطل (عربي)</label>
                        <input type="text" name="hero_title_ar" id="hero_title_ar" value="{{ old('hero_title_ar', $settings->hero_title_ar) }}" placeholder="مشروع المظلات: ظل وعطاء" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label for="hero_title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان البطل (إنجليزي)</label>
                        <input type="text" name="hero_title_en" id="hero_title_en" value="{{ old('hero_title_en', $settings->hero_title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                </div>
                <div>
                    <label for="hero_subtitle_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص التعريفي (عربي)</label>
                    <textarea name="hero_subtitle_ar" id="hero_subtitle_ar" rows="3" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" placeholder="نجمع بين جمال الإعلان وأثر العمل الخيري...">{{ old('hero_subtitle_ar', $settings->hero_subtitle_ar) }}</textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="cta_primary_text_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص الزر الأول (مثل: اكتشف المساحات)</label>
                        <input type="text" name="cta_primary_text_ar" id="cta_primary_text_ar" value="{{ old('cta_primary_text_ar', $settings->cta_primary_text_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label for="cta_primary_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الزر الأول</label>
                        <input type="url" name="cta_primary_url" id="cta_primary_url" value="{{ old('cta_primary_url', $settings->cta_primary_url) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label for="cta_secondary_text_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نص الزر الثاني (مثل: كيف يعمل المشروع؟)</label>
                        <input type="text" name="cta_secondary_text_ar" id="cta_secondary_text_ar" value="{{ old('cta_secondary_text_ar', $settings->cta_secondary_text_ar) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label for="cta_secondary_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط الزر الثاني</label>
                        <input type="url" name="cta_secondary_url" id="cta_secondary_url" value="{{ old('cta_secondary_url', $settings->cta_secondary_url) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                </div>
            </div>
        </section>

        {{-- زر التواصل --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">chat</span>
                زر التواصل
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">رابط واتساب لزر "تواصل معنا الآن" في القسم الأخير من صفحة المظلات.</p>
            <div>
                <label for="whatsapp_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط واتساب</label>
                <input type="url" name="whatsapp_url" id="whatsapp_url" value="{{ old('whatsapp_url', $settings->whatsapp_url) }}" placeholder="https://wa.me/970599999999" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">مثال: https://wa.me/970599999999 أو https://wa.me/970599999999?text=مرحباً</p>
            </div>
        </section>

        {{-- إحصائيات المشروع (4 بطاقات) --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">analytics</span>
                إحصائيات المشروع
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">أربع بطاقات تظهر تحت البطل (مثل: 120+ مظلة مفعلة، 1500 طالب مستفيد، 3 مدن، 98% إشغال).</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([1,2,3,4] as $i)
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 space-y-2">
                    <label class="cp-label block text-xs font-medium text-slate-500 dark:text-slate-400">البطاقة {{ $i }}</label>
                    <input type="text" name="stat{{ $i }}_value" value="{{ old('stat'.$i.'_value', $settings->{'stat'.$i.'_value'}) }}" placeholder="120+" class="cp-input w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
                    <input type="text" name="stat{{ $i }}_label_ar" value="{{ old('stat'.$i.'_label_ar', $settings->{'stat'.$i.'_label_ar'}) }}" placeholder="مظلة مفعلة" class="cp-input w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
                </div>
                @endforeach
            </div>
        </section>

        {{-- عنوان قسم المعرض + النص الوصفي --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">photo_library</span>
                معرض المساحات والنص الوصفي
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">عنوان القسم يظهر فوق المعرض (مثل: المساحات المتاحة في الحرم الجامعي). النص الوصفي للتوضيح الإضافي.</p>
            <div class="space-y-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <label for="section_title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان قسم المعرض (عربي)</label>
                        <input type="text" name="section_title_ar" id="section_title_ar" value="{{ old('section_title_ar', $settings->section_title_ar) }}" placeholder="المساحات المتاحة في الحرم الجامعي" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label for="section_title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان قسم المعرض (إنجليزي)</label>
                        <input type="text" name="section_title_en" id="section_title_en" value="{{ old('section_title_en', $settings->section_title_en) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30" />
                    </div>
                </div>
                <div>
                    <label for="description_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص الوصفي (عربي)</label>
                    <textarea name="description_ar" id="description_ar" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('description_ar', $settings->description_ar) }}</textarea>
                </div>
                <div>
                    <label for="description_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">النص الوصفي (إنجليزي)</label>
                    <textarea name="description_en" id="description_en" rows="4" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30">{{ old('description_en', $settings->description_en) }}</textarea>
                </div>
            </div>
        </section>

        <div class="flex justify-end">
            <button type="submit" class="cp-btn px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-medium shadow-sm transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">save</span>
                حفظ التغييرات
            </button>
        </div>
    </form>
</div>
@endsection
