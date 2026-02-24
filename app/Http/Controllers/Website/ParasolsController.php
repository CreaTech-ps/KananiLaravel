<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ParasolsImage;
use App\Models\ParasolsRegion;
use App\Models\ParasolsSetting;

class ParasolsController extends Controller
{
    public function index()
    {
        $settings = ParasolsSetting::get();
        $regions = ParasolsRegion::orderBy('sort_order')->orderBy('id')->get();

        $regionId = request('region') ? (int) request('region') : null;

        $query = ParasolsImage::with('region')
            ->orderBy('sort_order')
            ->orderBy('id');

        if ($regionId) {
            $query->where('region_id', $regionId);
        }

        $images = $query->paginate(9)->withQueryString();

        $totalSpaces = $regionId
            ? ParasolsImage::where('region_id', $regionId)->count()
            : ParasolsImage::count();

        return view('website.umbrellas', compact('settings', 'regions', 'images', 'totalSpaces'));
    }

    /**
     * مساحات المظلات للطلب عبر AJAX (فلتر حسب المنطقة بدون إعادة تحميل).
     */
    public function spaces()
    {
        $regionId = request('region') ? (int) request('region') : null;

        $query = ParasolsImage::with('region')
            ->orderBy('sort_order')
            ->orderBy('id');

        if ($regionId) {
            $query->where('region_id', $regionId);
        }

        $images = $query->get();
        $totalSpaces = $images->count();

        $html = view('website.partials.parasols_spaces', compact('images', 'totalSpaces'))->render();

        return response()->json([
            'html' => $html,
            'total' => $totalSpaces,
        ]);
    }
}
