<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\AboutSection;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::get();
        $sections = AboutSection::getForAbout();

        return view('website.about_us', compact('aboutPage', 'sections'));
    }
}
