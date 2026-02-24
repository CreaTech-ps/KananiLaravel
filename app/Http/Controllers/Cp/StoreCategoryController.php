<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreCategoryController extends Controller
{
    public function index()
    {
        $categories = StoreCategory::withCount('products')->orderBy('sort_order')->orderBy('name_ar')->get();

        return view('cp.store.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['slug_ar'] = Str::slug($validated['name_ar']);
        $validated['slug_en'] = Str::slug($validated['name_en'] ?? $validated['name_ar'] ?? '');

        StoreCategory::create($validated);

        return redirect()->route('cp.store.categories.index')->with('success', 'تم إضافة الفئة.');
    }

    public function update(Request $request, StoreCategory $category)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug_ar'] = Str::slug($validated['name_ar']);
        $validated['slug_en'] = Str::slug($validated['name_en'] ?? $validated['name_ar'] ?? '');
        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);

        return redirect()->route('cp.store.categories.index')->with('success', 'تم تحديث الفئة.');
    }

    public function destroy(Request $request, StoreCategory $category)
    {
        $category->products()->update(['category_id' => null]);
        $category->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم حذف الفئة.']);
        }
        return redirect()->route('cp.store.categories.index')->with('success', 'تم حذف الفئة.');
    }
}
