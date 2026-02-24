<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\TamkeenPartnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TamkeenPartnershipController extends Controller
{
    public function index(Request $request)
    {
        $query = TamkeenPartnership::query()->orderBy('sort_order')->orderByDesc('created_at');
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('supporter_name_ar', 'like', "%{$q}%")
                    ->orWhere('supporter_name_en', 'like', "%{$q}%");
            });
        }
        $partnerships = $query->paginate(12)->withQueryString();
        return view('cp.tamkeen.partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        $item = new TamkeenPartnership();
        $item->sort_order = 0;
        return view('cp.tamkeen.partnerships.form', ['item' => $item, 'title' => 'إضافة شراكة']);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePartnership($request);
        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('cp/tamkeen', 'public');
        }
        TamkeenPartnership::create($validated);
        return redirect()->route('cp.tamkeen.partnerships.index')->with('success', 'تم إضافة الشراكة بنجاح.');
    }

    public function edit(TamkeenPartnership $partnership)
    {
        return view('cp.tamkeen.partnerships.form', [
            'item' => $partnership,
            'title' => 'تعديل الشراكة',
        ]);
    }

    public function update(Request $request, TamkeenPartnership $partnership)
    {
        $validated = $this->validatePartnership($request);
        if ($request->hasFile('logo')) {
            if ($partnership->logo_path) {
                Storage::disk('public')->delete($partnership->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('cp/tamkeen', 'public');
        }
        $partnership->update($validated);
        return redirect()->route('cp.tamkeen.partnerships.index')->with('success', 'تم تحديث الشراكة بنجاح.');
    }

    public function destroy(TamkeenPartnership $partnership)
    {
        if ($partnership->logo_path) {
            Storage::disk('public')->delete($partnership->logo_path);
        }
        $partnership->delete();
        return redirect()->route('cp.tamkeen.partnerships.index')->with('success', 'تم حذف الشراكة.');
    }

    private function validatePartnership(Request $request): array
    {
        $validated = $request->validate([
            'supporter_name_ar' => ['required', 'string', 'max:255'],
            'supporter_name_en' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'beneficiaries_count' => ['nullable', 'integer', 'min:0'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'link' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        return $validated;
    }
}
