@extends('cp.layout')

@section('title', 'إعدادات الموقع')

@section('content')
<div class="w-full max-w-none space-y-6">
    <form action="{{ route('cp.site-settings.update') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- عام --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">tune</span>
                إعدادات عامة
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="default_locale" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اللغة الافتراضية</label>
                    <select name="default_locale" id="default_locale" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="ar" {{ ($settings->default_locale ?? 'ar') === 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="en" {{ ($settings->default_locale ?? '') === 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </div>
                <div>
                    <label for="action_color" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">لون الإجراءات (مثل #08A46D)</label>
                    <input type="text" name="action_color" id="action_color" value="{{ old('action_color', $settings->action_color) }}" placeholder="#08A46D" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="donation_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رابط التبرع</label>
                    <input type="url" name="donation_url" id="donation_url" value="{{ old('donation_url', $settings->donation_url) }}" placeholder="https://..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
            </div>
        </section>

        {{-- الشعارات --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">image</span>
                الشعارات
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">شعار الوضع الفاتح</label>
                    @if($settings->logo_path)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">الحالي: <code class="bg-slate-100 dark:bg-slate-700 px-1 rounded">{{ $settings->logo_path }}</code></p>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
                </div>
                <div>
                    <label class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">شعار الوضع الداكن</label>
                    @if($settings->logo_dark_path)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">الحالي: <code class="bg-slate-100 dark:bg-slate-700 px-1 rounded">{{ $settings->logo_dark_path }}</code></p>
                    @endif
                    <input type="file" name="logo_dark" accept="image/*" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary" />
                </div>
            </div>
        </section>

        {{-- التواصل --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">contact_mail</span>
                معلومات التواصل
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="contact_email" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" placeholder="info@bzufa.ps" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">البريد الإلكتروني الرسمي للجمعية. في حالة عدم إدخال بريد، سيتم استخدام eltrukk@gmail.com كبريد افتراضي لاستقبال طلبات التطوع وطلبات الشراكة.</p>
                </div>
                <div>
                    <label for="contact_phone" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رقم الهاتف</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="address_ar" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (عربي)</label>
                    <textarea name="address_ar" id="address_ar" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('address_ar', $settings->address_ar) }}</textarea>
                </div>
                <div>
                    <label for="address_en" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">العنوان (إنجليزي)</label>
                    <textarea name="address_en" id="address_en" rows="2" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary">{{ old('address_en', $settings->address_en) }}</textarea>
                </div>
            </div>
        </section>

        {{-- شبكات اجتماعية --}}
        <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">share</span>
                روابط الشبكات الاجتماعية
            </h2>
            <div class="space-y-4">
                <div>
                    <label for="facebook_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">فيسبوك</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="twitter_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تويتر</label>
                    <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}" placeholder="https://twitter.com/..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="instagram_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">انستغرام</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                </div>
                <div>
                    <label for="linkedin_url" class="cp-label block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">لينكدإن</label>
                    <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}" placeholder="https://linkedin.com/..." class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-2.5 focus:ring-2 focus:ring-primary/30 focus:border-primary" />
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
