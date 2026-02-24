<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\KananiSetting;
use Illuminate\Http\Request;

class KananiController extends Controller
{
    public function edit()
    {
        $settings = KananiSetting::get();
        return view('cp.kanani.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'intro_video_url' => ['nullable', 'string', 'max:500'],
            'intro_text_ar' => ['nullable', 'string'],
            'intro_text_en' => ['nullable', 'string'],
            'discover_more_text_ar' => ['nullable', 'string'],
            'discover_more_text_en' => ['nullable', 'string'],
            'hero_video_url' => ['nullable', 'string', 'max:500'],
            'store_url' => ['nullable', 'string', 'max:500'],
        ]);

        KananiSetting::get()->update([
            'intro_video_url' => $request->intro_video_url,
            'intro_text_ar' => $request->intro_text_ar,
            'intro_text_en' => $request->intro_text_en,
            'discover_more_text_ar' => $request->discover_more_text_ar,
            'discover_more_text_en' => $request->discover_more_text_en,
            'hero_video_url' => $request->hero_video_url,
            'store_url' => $request->store_url,
        ]);

        return redirect()->route('cp.kanani.edit')->with('success', 'تم حفظ إعدادات كنعاني بنجاح.');
    }
}
