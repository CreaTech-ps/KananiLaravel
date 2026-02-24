<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->orderByDesc('published_at')->orderByDesc('created_at');

        if ($request->filled('date_from')) {
            $query->whereDate('published_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('published_at', '<=', $request->date_to);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%")
                    ->orWhere('summary_ar', 'like', "%{$q}%");
            });
        }

        $news = $query->paginate(12)->withQueryString();

        return view('cp.news.index', compact('news'));
    }

    public function create()
    {
        $item = new News();
        $item->is_published = true;
        $item->published_at = now();
        return view('cp.news.form', ['item' => $item, 'title' => 'إضافة خبر']);
    }

    public function store(Request $request)
    {
        $validated = $this->validateNews($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('cp/news', 'public');
        }

        $validated['slug_ar'] = $validated['slug_ar'] ?: Str::slug($validated['title_ar']);
        $validated['slug_en'] = $validated['slug_en'] ?: Str::slug($validated['title_en'] ?? $validated['title_ar']);

        News::create($validated);

        return redirect()->route('cp.news.index')->with('success', 'تم إضافة الخبر بنجاح.');
    }

    public function edit(News $news)
    {
        return view('cp.news.form', ['item' => $news, 'title' => 'تعديل الخبر']);
    }

    public function update(Request $request, News $news)
    {
        $validated = $this->validateNews($request, $news);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('cp/news', 'public');
        }

        $validated['slug_ar'] = $validated['slug_ar'] ?: Str::slug($validated['title_ar']);
        $validated['slug_en'] = $validated['slug_en'] ?: Str::slug($validated['title_en'] ?? $validated['title_ar']);

        $news->update($validated);

        return redirect()->route('cp.news.index')->with('success', 'تم تحديث الخبر بنجاح.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        $news->delete();
        return redirect()->route('cp.news.index')->with('success', 'تم حذف الخبر.');
    }

    private function validateNews(Request $request, ?News $news = null): array
    {
        $rules = [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug_ar' => ['nullable', 'string', 'max:255'],
            'slug_en' => ['nullable', 'string', 'max:255'],
            'summary_ar' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ];

        $validated = $request->validate($rules);
        $validated['is_published'] = $request->boolean('is_published');

        return $validated;
    }
}
