<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\HomeStatistic;
use App\Models\News;
use App\Models\Partner;
use App\Models\SuccessStory;

class HomeController extends Controller
{
    public function index()
    {
        // Cache frequently accessed data
        $homeSetting = cache()->remember('home_setting', 3600, function () {
            return HomeSetting::get();
        });
        
        $statistics = cache()->remember('home_statistics', 3600, function () {
            return HomeStatistic::orderBy('sort_order')->orderBy('id')->get();
        });
        
        $partners = cache()->remember('home_partners', 3600, function () {
            return Partner::orderBy('sort_order')->orderBy('id')->get();
        });
        
        $newsItems = cache()->remember('home_news_items', 1800, function () {
            return News::where('is_published', true)
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->limit(4)
                ->get();
        });
        
        $successStories = cache()->remember('home_success_stories', 3600, function () {
            return SuccessStory::where('is_featured', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->limit(10)
                ->get();
        });

        return view('website.home', compact('homeSetting', 'statistics', 'partners', 'newsItems', 'successStories'));
    }
}
