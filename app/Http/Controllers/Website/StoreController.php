<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = StoreProduct::with('category', 'sizes', 'colors')
            ->where('is_active', true);

        if ($request->filled('category')) {
            $slugOrId = $request->category;
            $query->where(function ($q) use ($slugOrId) {
                $q->where('category_id', $slugOrId)
                    ->orWhereHas('category', fn ($q2) => $q2->where('slug_ar', $slugOrId)->orWhere('slug_en', $slugOrId));
            });
        }

        if ($request->filled('max_price')) {
            $maxP = (int) $request->max_price;
            if ($maxP > 0) {
                $query->where('price', '<=', $maxP);
            }
        }

        if ($request->filled('q')) {
            $searchTerm = trim($request->q);
            if ($searchTerm !== '') {
                $query->where(function ($q2) use ($searchTerm) {
                    $q2->where('name_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('name_en', 'like', "%{$searchTerm}%")
                        ->orWhere('slug_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('slug_en', 'like', "%{$searchTerm}%")
                        ->orWhere('description_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('description_en', 'like', "%{$searchTerm}%");
                });
            }
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price'),
                'price_desc' => $query->orderByDesc('price'),
                default => $query->orderByDesc('created_at'),
            };
        } else {
            $query->orderByDesc('created_at');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = StoreCategory::withCount(['products' => fn ($q) => $q->where('is_active', true)])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $totalProducts = StoreProduct::where('is_active', true)->count();
        $minPrice = 0;
        $maxPrice = (int) (StoreProduct::where('is_active', true)->max('price') ?: 1500);

        return view('store.index', compact('categories', 'products', 'totalProducts', 'minPrice', 'maxPrice'));
    }

    public function filter(Request $request)
    {
        $query = StoreProduct::with('category', 'sizes', 'colors')
            ->where('is_active', true);

        if ($request->filled('category')) {
            $slugOrId = $request->category;
            $query->where(function ($q) use ($slugOrId) {
                $q->where('category_id', $slugOrId)
                    ->orWhereHas('category', fn ($q2) => $q2->where('slug_ar', $slugOrId)->orWhere('slug_en', $slugOrId));
            });
        }

        if ($request->filled('max_price')) {
            $maxP = (int) $request->max_price;
            if ($maxP > 0) {
                $query->where('price', '<=', $maxP);
            }
        }

        if ($request->filled('q')) {
            $searchTerm = trim($request->q);
            if ($searchTerm !== '') {
                $query->where(function ($q2) use ($searchTerm) {
                    $q2->where('name_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('name_en', 'like', "%{$searchTerm}%")
                        ->orWhere('slug_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('slug_en', 'like', "%{$searchTerm}%")
                        ->orWhere('description_ar', 'like', "%{$searchTerm}%")
                        ->orWhere('description_en', 'like', "%{$searchTerm}%");
                });
            }
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price'),
                'price_desc' => $query->orderByDesc('price'),
                default => $query->orderByDesc('created_at'),
            };
        } else {
            $query->orderByDesc('created_at');
        }

        $page = max(1, (int) ($request->page ?? 1));
        $products = $query->paginate(12, ['*'], 'page', $page)->withQueryString();

        $html = view('store.partials.products-grid', [
            'products' => $products,
        ])->render();

        return response()->json([
            'html' => $html,
            'has_pages' => $products->hasPages(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
            'from' => $products->firstItem(),
            'to' => $products->lastItem(),
        ]);
    }

    public function show(string $slug)
    {
        $product = StoreProduct::where('is_active', true)
            ->where(function ($q) use ($slug) {
                $q->where('slug_ar', $slug)->orWhere('slug_en', $slug)->orWhere('id', $slug);
            })
            ->with('sizes', 'colors', 'category')
            ->first();

        $relatedProducts = collect();
        if ($product && $product->category_id) {
            $relatedProducts = StoreProduct::where('is_active', true)
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->with('category')
                ->limit(4)
                ->get();
        }
        if ($relatedProducts->count() < 4) {
            $relatedProducts = $relatedProducts->merge(
                StoreProduct::where('is_active', true)
                    ->whereNotIn('id', $relatedProducts->pluck('id')->push($product?->id)->filter())
                    ->with('category')
                    ->limit(4 - $relatedProducts->count())
                    ->get()
            );
        }

        return view('store.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $q = trim($request->q ?? '');
        if (strlen($q) < 1) {
            return response()->json(['products' => []]);
        }

        $products = StoreProduct::where('is_active', true)
            ->where(function ($query) use ($q) {
                $query->where('name_ar', 'like', "%{$q}%")
                    ->orWhere('name_en', 'like', "%{$q}%")
                    ->orWhere('slug_ar', 'like', "%{$q}%")
                    ->orWhere('slug_en', 'like', "%{$q}%");
            })
            ->limit(8)
            ->get();

        $locale = app()->getLocale();
        $items = $products->map(function ($p) use ($locale) {
            $slug = $locale === 'ar' ? ($p->slug_ar ?? $p->id) : ($p->slug_en ?? $p->slug_ar ?? $p->id);
            $name = $locale === 'ar' ? ($p->name_ar ?? '') : ($p->name_en ?? $p->name_ar ?? '');
            return [
                'id' => $p->id,
                'name' => $name,
                'slug' => $slug,
                'price' => (float) $p->price,
                'image' => $p->image_path ? asset('storage/' . $p->image_path) : null,
            ];
        })->values();

        return response()->json(['products' => $items]);
    }
}
