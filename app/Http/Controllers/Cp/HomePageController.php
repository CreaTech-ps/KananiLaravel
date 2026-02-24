<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\HomeStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function edit()
    {
        $home = HomeSetting::get();
        $statistics = HomeStatistic::orderBy('sort_order')->orderBy('id')->get();

        return view('cp.home.edit', compact('home', 'statistics'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_type' => ['required', 'in:image,video'],
            'hero_media_path' => ['nullable', 'string', 'max:500'],
            'hero_title_ar' => ['nullable', 'string', 'max:255'],
            'hero_title_en' => ['nullable', 'string', 'max:255'],
            'hero_subtitle_ar' => ['nullable', 'string'],
            'hero_subtitle_en' => ['nullable', 'string'],
            'cta_text_ar' => ['nullable', 'string', 'max:255'],
            'cta_text_en' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:500'],
            'annual_report_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
        ]);

        $home = HomeSetting::get();

        if ($request->hasFile('hero_media')) {
            if ($home->hero_media_path) {
                Storage::disk('public')->delete($home->hero_media_path);
            }
            $validated['hero_media_path'] = $request->file('hero_media')->store('cp/home', 'public');
        }

        if ($request->hasFile('annual_report_pdf')) {
            if ($home->annual_report_pdf_path) {
                Storage::disk('public')->delete($home->annual_report_pdf_path);
            }
            $validated['annual_report_pdf_path'] = $request->file('annual_report_pdf')->store('cp/home', 'public');
        }
        unset($validated['annual_report_pdf']);

        $home->update($validated);

        return redirect()->route('cp.home.edit')->with('success', 'تم حفظ إعدادات الصفحة الرئيسية بنجاح.');
    }
}
