<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoSettingsController extends Controller
{
    public function edit()
    {
        $settings = SeoSetting::get();
        return view('cp.seo-settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Meta Tags العامة
            'site_title_ar' => ['nullable', 'string', 'max:255'],
            'site_title_en' => ['nullable', 'string', 'max:255'],
            'meta_description_ar' => ['nullable', 'string', 'max:500'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_keywords_ar' => ['nullable', 'string'],
            'meta_keywords_en' => ['nullable', 'string'],
            
            // Open Graph
            'og_title_ar' => ['nullable', 'string', 'max:255'],
            'og_title_en' => ['nullable', 'string', 'max:255'],
            'og_description_ar' => ['nullable', 'string', 'max:500'],
            'og_description_en' => ['nullable', 'string', 'max:500'],
            'og_type' => ['nullable', 'string', 'max:50'],
            
            // Twitter Card
            'twitter_card_type' => ['nullable', 'string', 'max:50'],
            'twitter_site' => ['nullable', 'string', 'max:100'],
            'twitter_creator' => ['nullable', 'string', 'max:100'],
            
            // Robots & Indexing
            'robots_txt' => ['nullable', 'string'],
            'allow_indexing' => ['nullable', 'boolean'],
            'custom_meta_tags' => ['nullable', 'string'],
            
            // Google Analytics & Verification
            'google_analytics_id' => ['nullable', 'string', 'max:100'],
            'google_site_verification' => ['nullable', 'string', 'max:255'],
            'bing_verification' => ['nullable', 'string', 'max:255'],
            
            // Schema.org
            'organization_schema' => ['nullable', 'string'],
        ]);

        $settings = SeoSetting::get();

        // رفع صورة Open Graph
        if ($request->hasFile('og_image')) {
            if ($settings->og_image_path) {
                Storage::disk('public')->delete($settings->og_image_path);
            }
            $validated['og_image_path'] = $request->file('og_image')->store('cp/seo', 'public');
        }

        // معالجة checkbox allow_indexing
        $validated['allow_indexing'] = $request->has('allow_indexing') && $request->input('allow_indexing') == '1';

        $settings->update($validated);

        return redirect()->route('cp.seo-settings.edit')->with('success', 'تم حفظ إعدادات SEO بنجاح.');
    }
}
