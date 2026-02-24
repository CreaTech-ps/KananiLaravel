<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class RobotsController extends Controller
{
    public function index()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        $content .= "# Disallow admin panel\n";
        $content .= "Disallow: /cp/\n";
        $content .= "Disallow: /admin/\n\n";
        $content .= "# Allow sitemap\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
        
        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
