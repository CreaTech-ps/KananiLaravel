<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\KananiGalleryItem;
use App\Models\KananiSetting;

class KananiController extends Controller
{
    public function index()
    {
        $settings = KananiSetting::get();
        $items = KananiGalleryItem::orderBy('sort_order')->orderByDesc('created_at')->limit(8)->get();

        return view('website.canaanite', compact('settings', 'items'));
    }
}
