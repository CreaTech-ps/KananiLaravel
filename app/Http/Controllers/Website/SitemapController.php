<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    public function index()
    {
        // Cache sitemap for 1 hour
        return cache()->remember('sitemap_xml', 3600, function () {
            $routes = [];
            
            // Static routes
            $staticRoutes = [
                ['name' => 'home', 'priority' => '1.0', 'changefreq' => 'daily'],
                ['name' => 'about.index', 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['name' => 'team.index', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['name' => 'partners.index', 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['name' => 'grants.index', 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['name' => 'news.index', 'priority' => '0.9', 'changefreq' => 'daily'],
                ['name' => 'kanani.index', 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['name' => 'tamkeen.index', 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['name' => 'parasols.index', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ];
            
            foreach ($staticRoutes as $route) {
                try {
                    $arUrl = LaravelLocalization::getLocalizedURL('ar', route($route['name'], [], false), [], true);
                    $enUrl = LaravelLocalization::getLocalizedURL('en', route($route['name'], [], false), [], true);
                    
                    $routes[] = [
                        'url' => $arUrl,
                        'priority' => $route['priority'],
                        'changefreq' => $route['changefreq'],
                    ];
                } catch (\Exception $e) {
                    // Skip if route doesn't exist
                }
            }

            // Get all published news
            $news = News::where('is_published', true)
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->get();

            foreach ($news as $item) {
                try {
                    $slug = current_slug($item);
                    $arUrl = LaravelLocalization::getLocalizedURL('ar', route('news.show', ['slug' => $slug], false), [], true);
                    
                    $routes[] = [
                        'url' => $arUrl,
                        'priority' => '0.7',
                        'changefreq' => 'monthly',
                        'lastmod' => $item->updated_at->toAtomString(),
                    ];
                } catch (\Exception $e) {
                    // Skip if route doesn't exist
                }
            }

            // Get all active scholarships
            $scholarships = Scholarship::where('is_active', true)
                ->orderByDesc('created_at')
                ->get();

            foreach ($scholarships as $item) {
                try {
                    $slug = current_slug($item);
                    $arUrl = LaravelLocalization::getLocalizedURL('ar', route('grants.show', ['slug' => $slug], false), [], true);
                    
                    $routes[] = [
                        'url' => $arUrl,
                        'priority' => '0.8',
                        'changefreq' => 'weekly',
                        'lastmod' => $item->updated_at->toAtomString(),
                    ];
                } catch (\Exception $e) {
                    // Skip if route doesn't exist
                }
            }

            $content = view('website.sitemap', compact('routes'))->render();
            
            return response($content, 200)
                ->header('Content-Type', 'application/xml');
        });
    }
}
