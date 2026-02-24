<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::get();
        return view('cp.site-settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'action_color' => ['nullable', 'string', 'max:20'],
            'donation_url' => ['nullable', 'url', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address_ar' => ['nullable', 'string'],
            'address_en' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:500'],
            'twitter_url' => ['nullable', 'url', 'max:500'],
            'instagram_url' => ['nullable', 'url', 'max:500'],
            'linkedin_url' => ['nullable', 'url', 'max:500'],
            'default_locale' => ['nullable', 'in:ar,en'],
        ]);

        $settings = SiteSetting::get();

        if ($request->hasFile('logo')) {
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('cp/site', 'public');
        }
        if ($request->hasFile('logo_dark')) {
            if ($settings->logo_dark_path) {
                Storage::disk('public')->delete($settings->logo_dark_path);
            }
            $validated['logo_dark_path'] = $request->file('logo_dark')->store('cp/site', 'public');
        }

        $settings->update($validated);

        return redirect()->route('cp.site-settings.edit')->with('success', 'تم حفظ إعدادات الموقع بنجاح.');
    }
}
