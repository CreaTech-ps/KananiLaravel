<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\KananiGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KananiGalleryItemController extends Controller
{
    public function index()
    {
        $items = KananiGalleryItem::orderBy('sort_order')->orderByDesc('created_at')->paginate(12);
        return view('cp.kanani.gallery.index', compact('items'));
    }

    public function create()
    {
        $item = new KananiGalleryItem();
        $item->sort_order = 0;
        return view('cp.kanani.gallery.form', ['item' => $item, 'title' => 'إضافة عنصر معرض']);
    }

    public function store(Request $request)
    {
        $request->validate(['image' => ['required', 'image', 'max:2048']]);
        $validated = $this->validateItem($request);
        $validated['image_path'] = $request->file('image')->store('cp/kanani-gallery', 'public');
        KananiGalleryItem::create($validated);
        return redirect()->route('cp.kanani.gallery.index')->with('success', 'تم إضافة العنصر بنجاح.');
    }

    public function edit(KananiGalleryItem $kanani_gallery)
    {
        return view('cp.kanani.gallery.form', [
            'item' => $kanani_gallery,
            'title' => 'تعديل عنصر المعرض',
        ]);
    }

    public function update(Request $request, KananiGalleryItem $kanani_gallery)
    {
        $request->validate(['image' => ['nullable', 'image', 'max:2048']]);
        $validated = $this->validateItem($request);
        if ($request->hasFile('image')) {
            if ($kanani_gallery->image_path) {
                Storage::disk('public')->delete($kanani_gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('cp/kanani-gallery', 'public');
        }
        $kanani_gallery->update($validated);
        return redirect()->route('cp.kanani.gallery.index')->with('success', 'تم تحديث العنصر بنجاح.');
    }

    public function destroy(KananiGalleryItem $kanani_gallery)
    {
        if ($kanani_gallery->image_path) {
            Storage::disk('public')->delete($kanani_gallery->image_path);
        }
        $kanani_gallery->delete();
        return redirect()->route('cp.kanani.gallery.index')->with('success', 'تم حذف العنصر.');
    }

    private function validateItem(Request $request): array
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        return $validated;
    }
}
