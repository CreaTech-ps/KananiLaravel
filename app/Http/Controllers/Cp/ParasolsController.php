<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\ParasolsSetting;
use Illuminate\Http\Request;

class ParasolsController extends Controller
{
    public function edit()
    {
        $settings = ParasolsSetting::get();
        return view('cp.parasols.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title_ar' => ['nullable', 'string', 'max:255'],
            'hero_title_en' => ['nullable', 'string', 'max:255'],
            'hero_subtitle_ar' => ['nullable', 'string'],
            'hero_subtitle_en' => ['nullable', 'string'],
            'cta_primary_text_ar' => ['nullable', 'string', 'max:255'],
            'cta_primary_url' => ['nullable', 'string', 'max:500'],
            'cta_secondary_text_ar' => ['nullable', 'string', 'max:255'],
            'cta_secondary_url' => ['nullable', 'string', 'max:500'],
            'section_title_ar' => ['nullable', 'string', 'max:255'],
            'section_title_en' => ['nullable', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'stat1_value' => ['nullable', 'string', 'max:50'],
            'stat1_label_ar' => ['nullable', 'string', 'max:255'],
            'stat2_value' => ['nullable', 'string', 'max:50'],
            'stat2_label_ar' => ['nullable', 'string', 'max:255'],
            'stat3_value' => ['nullable', 'string', 'max:50'],
            'stat3_label_ar' => ['nullable', 'string', 'max:255'],
            'stat4_value' => ['nullable', 'string', 'max:50'],
            'stat4_label_ar' => ['nullable', 'string', 'max:255'],
            'whatsapp_url' => ['nullable', 'string', 'max:500'],
        ]);

        ParasolsSetting::get()->update($request->only([
            'hero_title_ar', 'hero_title_en', 'hero_subtitle_ar', 'hero_subtitle_en',
            'cta_primary_text_ar', 'cta_primary_url', 'cta_secondary_text_ar', 'cta_secondary_url',
            'section_title_ar', 'section_title_en', 'description_ar', 'description_en',
            'stat1_value', 'stat1_label_ar', 'stat2_value', 'stat2_label_ar',
            'stat3_value', 'stat3_label_ar', 'stat4_value', 'stat4_label_ar',
            'whatsapp_url',
        ]));

        return redirect()->route('cp.parasols.edit')->with('success', 'تم حفظ إعدادات المظلات بنجاح.');
    }
}
