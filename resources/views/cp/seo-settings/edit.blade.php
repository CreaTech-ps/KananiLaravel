@extends('cp.layout')

@section('title', 'إعدادات SEO')

@section('content')
<div class="w-full max-w-none space-y-6">
    @if(session('success'))
        <div class="rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
            <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('cp.seo-settings.update') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Meta Tags العامة --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">tag</span>
                Meta Tags العامة
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">هذه المعلومات تظهر في نتائج محركات البحث</p>
            <div class="space-y-4">
                <div>
                    <label for="site_title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان الموقع (عربي)</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">يظهر في تبويب المتصفح ونتائج البحث</p>
                    <input type="text" name="site_title_ar" id="site_title_ar" value="{{ old('site_title_ar', $settings->site_title_ar) }}" placeholder="جمعية أصدقاء جامعة بيرزيت" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="site_title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان الموقع (إنجليزي)</label>
                    <input type="text" name="site_title_en" id="site_title_en" value="{{ old('site_title_en', $settings->site_title_en) }}" placeholder="Friends of Birzeit University Association" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="meta_description_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (عربي)</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">يظهر تحت العنوان في نتائج البحث (150-160 حرف)</p>
                    <textarea name="meta_description_ar" id="meta_description_ar" rows="3" maxlength="500" placeholder="وصف مختصر عن الجمعية وأهدافها..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('meta_description_ar', $settings->meta_description_ar) }}</textarea>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1"><span id="desc_ar_count">0</span> / 500</p>
                </div>
                <div>
                    <label for="meta_description_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف (إنجليزي)</label>
                    <textarea name="meta_description_en" id="meta_description_en" rows="3" maxlength="500" placeholder="Brief description about the association and its goals..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('meta_description_en', $settings->meta_description_en) }}</textarea>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1"><span id="desc_en_count">0</span> / 500</p>
                </div>
                <div>
                    <label for="meta_keywords_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الكلمات المفتاحية (عربي)</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">افصل بين الكلمات بفواصل (مثال: جمعية، جامعة بيرزيت، تعليم، منح)</p>
                    <textarea name="meta_keywords_ar" id="meta_keywords_ar" rows="2" placeholder="جمعية، جامعة بيرزيت، تعليم، منح، فلسطين" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('meta_keywords_ar', $settings->meta_keywords_ar) }}</textarea>
                </div>
                <div>
                    <label for="meta_keywords_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الكلمات المفتاحية (إنجليزي)</label>
                    <textarea name="meta_keywords_en" id="meta_keywords_en" rows="2" placeholder="association, Birzeit University, education, scholarships, Palestine" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('meta_keywords_en', $settings->meta_keywords_en) }}</textarea>
                </div>
            </div>
        </section>

        {{-- Open Graph (Facebook, LinkedIn, etc.) --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">share</span>
                Open Graph (الشبكات الاجتماعية)
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">تظهر عند مشاركة الموقع على فيسبوك، لينكدإن، وغيرها</p>
            <div class="space-y-4">
                <div>
                    <label for="og_title_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان المشاركة (عربي)</label>
                    <input type="text" name="og_title_ar" id="og_title_ar" value="{{ old('og_title_ar', $settings->og_title_ar) }}" placeholder="عنوان يظهر عند المشاركة" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="og_title_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عنوان المشاركة (إنجليزي)</label>
                    <input type="text" name="og_title_en" id="og_title_en" value="{{ old('og_title_en', $settings->og_title_en) }}" placeholder="Title shown when sharing" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="og_description_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">وصف المشاركة (عربي)</label>
                    <textarea name="og_description_ar" id="og_description_ar" rows="3" maxlength="500" placeholder="وصف يظهر عند مشاركة الموقع..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('og_description_ar', $settings->og_description_ar) }}</textarea>
                </div>
                <div>
                    <label for="og_description_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">وصف المشاركة (إنجليزي)</label>
                    <textarea name="og_description_en" id="og_description_en" rows="3" maxlength="500" placeholder="Description shown when sharing..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('og_description_en', $settings->og_description_en) }}</textarea>
                </div>
                <div>
                    <label for="og_image" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">صورة المشاركة</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">الحجم الموصى به: 1200x630 بكسل</p>
                    @if($settings->og_image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $settings->og_image_path) }}" alt="OG Image" class="max-w-xs rounded-lg border border-slate-300 dark:border-slate-600" />
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">الصورة الحالية</p>
                        </div>
                    @endif
                    <input type="file" name="og_image" id="og_image" accept="image/*" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
                </div>
                <div>
                    <label for="og_type" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نوع المحتوى</label>
                    <select name="og_type" id="og_type" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="website" {{ ($settings->og_type ?? 'website') === 'website' ? 'selected' : '' }}>موقع ويب</option>
                        <option value="article" {{ ($settings->og_type ?? '') === 'article' ? 'selected' : '' }}>مقال</option>
                        <option value="organization" {{ ($settings->og_type ?? '') === 'organization' ? 'selected' : '' }}>منظمة</option>
                    </select>
                </div>
            </div>
        </section>

        {{-- Twitter Card --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">chat_bubble</span>
                Twitter Card
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="twitter_card_type" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نوع البطاقة</label>
                    <select name="twitter_card_type" id="twitter_card_type" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="summary_large_image" {{ ($settings->twitter_card_type ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' }}>صورة كبيرة</option>
                        <option value="summary" {{ ($settings->twitter_card_type ?? '') === 'summary' ? 'selected' : '' }}>ملخص</option>
                    </select>
                </div>
                <div>
                    <label for="twitter_site" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">حساب تويتر (@username)</label>
                    <input type="text" name="twitter_site" id="twitter_site" value="{{ old('twitter_site', $settings->twitter_site) }}" placeholder="@username" maxlength="100" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="twitter_creator" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">منشئ المحتوى (@username)</label>
                    <input type="text" name="twitter_creator" id="twitter_creator" value="{{ old('twitter_creator', $settings->twitter_creator) }}" placeholder="@username" maxlength="100" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>
        </section>

        {{-- Robots & Indexing --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">smart_toy</span>
                Robots & Indexing
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="cp-label flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="allow_indexing" value="1" {{ old('allow_indexing', $settings->allow_indexing) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary/30" />
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">السماح لمحركات البحث بفهرسة الموقع</span>
                    </label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 mr-6">عند إلغاء التحديد، سيتم إضافة noindex إلى meta tags</p>
                </div>
                <div>
                    <label for="robots_txt" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">محتوى ملف robots.txt</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">أدخل محتوى ملف robots.txt (اختياري)</p>
                    <textarea name="robots_txt" id="robots_txt" rows="6" placeholder="User-agent: *&#10;Allow: /&#10;Disallow: /cp/" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono text-sm">{{ old('robots_txt', $settings->robots_txt) }}</textarea>
                </div>
                <div>
                    <label for="custom_meta_tags" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meta Tags مخصصة</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">أدخل meta tags إضافية (HTML)</p>
                    <textarea name="custom_meta_tags" id="custom_meta_tags" rows="4" placeholder='&lt;meta name="author" content="..."&gt;&#10;&lt;meta name="theme-color" content="#08A46D"&gt;' class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono text-sm">{{ old('custom_meta_tags', $settings->custom_meta_tags) }}</textarea>
                </div>
            </div>
        </section>

        {{-- Google Analytics & Verification --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">analytics</span>
                Google Analytics & Verification
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="google_analytics_id" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">معرف Google Analytics</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">مثال: G-XXXXXXXXXX أو UA-XXXXXXXXX-X</p>
                    <input type="text" name="google_analytics_id" id="google_analytics_id" value="{{ old('google_analytics_id', $settings->google_analytics_id) }}" placeholder="G-XXXXXXXXXX" maxlength="100" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="google_site_verification" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رمز التحقق من Google Search Console</label>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">يظهر في meta tag: content="..."</p>
                    <input type="text" name="google_site_verification" id="google_site_verification" value="{{ old('google_site_verification', $settings->google_site_verification) }}" placeholder="رمز التحقق" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="bing_verification" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رمز التحقق من Bing</label>
                    <input type="text" name="bing_verification" id="bing_verification" value="{{ old('bing_verification', $settings->bing_verification) }}" placeholder="رمز التحقق" maxlength="255" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>
        </section>

        {{-- Schema.org / Structured Data --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">code</span>
                Schema.org / البيانات المنظمة
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">أدخل JSON-LD للبيانات المنظمة (Organization Schema)</p>
            <div>
                <label for="organization_schema" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">JSON-LD Schema</label>
                <textarea name="organization_schema" id="organization_schema" rows="10" placeholder='{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "جمعية أصدقاء جامعة بيرزيت",
  "url": "https://example.com",
  ...
}' class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary font-mono text-sm">{{ old('organization_schema', $settings->organization_schema) }}</textarea>
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

@push('scripts')
<script>
    // عداد الأحرف للوصف
    const descAr = document.getElementById('meta_description_ar');
    const descEn = document.getElementById('meta_description_en');
    const descArCount = document.getElementById('desc_ar_count');
    const descEnCount = document.getElementById('desc_en_count');

    function updateCount(textarea, counter) {
        counter.textContent = textarea.value.length;
    }

    if (descAr && descArCount) {
        updateCount(descAr, descArCount);
        descAr.addEventListener('input', () => updateCount(descAr, descArCount));
    }

    if (descEn && descEnCount) {
        updateCount(descEn, descEnCount);
        descEn.addEventListener('input', () => updateCount(descEn, descEnCount));
    }
</script>
@endpush
@endsection
