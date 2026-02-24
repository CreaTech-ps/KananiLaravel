<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\ParasolsRegion;
use Illuminate\Http\Request;

class ParasolsRegionController extends Controller
{
    public function index()
    {
        $regions = ParasolsRegion::withCount('images')->orderBy('sort_order')->orderBy('id')->get();
        return view('cp.parasols.regions.index', compact('regions'));
    }

    public function create()
    {
        $item = new ParasolsRegion();
        $item->sort_order = 0;
        return view('cp.parasols.regions.form', ['item' => $item, 'title' => 'إضافة منطقة']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        ParasolsRegion::create($validated);
        return redirect()->route('cp.parasols.regions.index')->with('success', 'تم إضافة المنطقة بنجاح.');
    }

    public function edit(ParasolsRegion $region)
    {
        return view('cp.parasols.regions.form', [
            'item' => $region,
            'title' => 'تعديل المنطقة',
        ]);
    }

    public function update(Request $request, ParasolsRegion $region)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        $region->update($validated);
        return redirect()->route('cp.parasols.regions.index')->with('success', 'تم تحديث المنطقة بنجاح.');
    }

    public function destroy(ParasolsRegion $region)
    {
        $region->delete();
        return redirect()->route('cp.parasols.regions.index')->with('success', 'تم حذف المنطقة.');
    }
}
