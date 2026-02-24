<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * عرض صفحة أرشيف الأخبار مع التصفية والترقيم
     */
    public function index(Request $request)
    {
        $query = News::where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        // تصفية حسب السنة
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year);
        }

        // تصفية حسب الشهر
        if ($request->filled('month')) {
            $query->whereMonth('published_at', $request->month);
        }

        $news = $query->paginate(9)->withQueryString();

        // السنوات المتاحة للتصفية (من الأخبار المنشورة) - cached
        $availableYears = cache()->remember('news_available_years', 3600, function () {
            return News::where('is_published', true)
                ->whereNotNull('published_at')
                ->selectRaw('YEAR(published_at) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');
        });

        // إرجاع HTML جزئي عند الطلبات عبر AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('website.partials.news-list', compact('news'))->render(),
            ]);
        }

        return view('website.news', compact('news', 'availableYears'));
    }

    /**
     * عرض تفاصيل خبر واحد
     */
    public function show(string $slug)
    {
        $news = News::where('is_published', true)
            ->where(function ($q) use ($slug) {
                $q->where('slug_ar', $slug)->orWhere('slug_en', $slug)->orWhere('id', $slug);
            })
            ->firstOrFail();

        // أخبار ذات صلة (3 أخبار أحدث، باستثناء الخبر الحالي)
        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('website.news-detail', compact('news', 'relatedNews'));
    }
}
