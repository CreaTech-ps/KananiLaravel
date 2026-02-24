<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function privacy()
    {
        return view('website.pages.privacy');
    }

    public function terms()
    {
        return view('website.pages.terms');
    }
}
