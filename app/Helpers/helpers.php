<?php

if (!function_exists('localized')) {
    /**
     * Get localized attribute from model (e.g. title_ar / title_en by current locale).
     *
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     * @param  string  $attribute  Base name without _ar/_en (e.g. 'title', 'name', 'label')
     * @return string|null
     */
    function localized($model, string $attribute): ?string
    {
        if ($model === null) {
            return null;
        }

        $locale = app()->getLocale();
        $suffix = $locale === 'ar' ? '_ar' : '_en';
        $key = $attribute . $suffix;
        $value = $model->getAttribute($key);
        if ($value !== null && (string) $value !== '') {
            return $value;
        }
        $fallbackKey = $locale === 'ar' ? $attribute . '_en' : $attribute . '_ar';
        $fallback = $model->getAttribute($fallbackKey);
        return $fallback !== null ? $fallback : $model->getAttribute($attribute . '_ar');
    }
}

if (!function_exists('current_slug')) {
    /**
     * Get slug for current locale (slug_ar or slug_en).
     *
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     * @return string|null
     */
    function current_slug($model): ?string
    {
        if ($model === null) {
            return null;
        }
        $slug = localized($model, 'slug');
        return $slug ?: (string) $model->getKey();
    }
}

if (!function_exists('localized_route')) {
    /**
     * رابط مسار محلي حسب اللغة الحالية (للمسارات الأمامية فقط).
     *
     * @param  string  $name  اسم المسار
     * @param  array  $parameters
     * @return string
     */
    function localized_route(string $name, array $parameters = []): string
    {
        return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl(route($name, $parameters));
    }
}
