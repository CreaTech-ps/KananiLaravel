<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\ParasolsImage;
use App\Models\ParasolsRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParasolsImageController extends Controller
{
    public function index(ParasolsRegion $region)
    {
        $images = $region->images()->orderBy('sort_order')->orderBy('id')->paginate(12);
        return view('cp.parasols.images.index', compact('region', 'images'));
    }

    public function create(ParasolsRegion $region)
    {
        $item = new ParasolsImage();
        $item->region_id = $region->id;
        $item->sort_order = 0;
        return view('cp.parasols.images.form', ['item' => $item, 'region' => $region, 'title' => 'إضافة صورة']);
    }

    public function store(Request $request, ParasolsRegion $region)
    {
        $request->validate(['image' => ['required', 'image', 'max:2048']]);
        $validated = $this->validateImage($request);
        $validated['region_id'] = $region->id;
        $validated['image_path'] = $request->file('image')->store('cp/parasols/' . $region->id, 'public');
        ParasolsImage::create($validated);
        return redirect()->route('cp.parasols.regions.images.index', $region)->with('success', 'تم إضافة الصورة بنجاح.');
    }

    public function edit(ParasolsRegion $region, ParasolsImage $image)
    {
        return view('cp.parasols.images.form', [
            'item' => $image,
            'region' => $region,
            'title' => 'تعديل الصورة',
        ]);
    }

    public function update(Request $request, ParasolsRegion $region, ParasolsImage $image)
    {
        $request->validate(['image' => ['nullable', 'image', 'max:2048']]);
        $validated = $this->validateImage($request);
        if ($request->hasFile('image')) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('cp/parasols/' . $region->id, 'public');
        }
        if ($request->hasFile('advertiser_logo')) {
            if ($image->advertiser_logo_path) {
                Storage::disk('public')->delete($image->advertiser_logo_path);
            }
        }
        $image->update($validated);
        return redirect()->route('cp.parasols.regions.images.index', $region)->with('success', 'تم تحديث الصورة بنجاح.');
    }

    public function destroy(ParasolsRegion $region, ParasolsImage $image)
    {
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return redirect()->route('cp.parasols.regions.images.index', $region)->with('success', 'تم حذف الصورة.');
    }

    private function validateImage(Request $request): array
    {
        $validated = $request->validate([
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'location_ar' => ['nullable', 'string', 'max:500'],
            'location_en' => ['nullable', 'string', 'max:500'],
            'detailed_location_ar' => ['nullable', 'string'],
            'detailed_location_en' => ['nullable', 'string'],
            'price' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'in:available,newly_booked,ending_soon'],
            'advertiser_name_ar' => ['nullable', 'string', 'max:255'],
            'advertiser_name_en' => ['nullable', 'string', 'max:255'],
            'advertiser_logo' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        
        if ($request->hasFile('advertiser_logo')) {
            $validated['advertiser_logo_path'] = $request->file('advertiser_logo')->store('cp/parasols/advertisers', 'public');
        }
        
        return $validated;
    }
}
