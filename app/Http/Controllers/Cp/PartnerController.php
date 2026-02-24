<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query()->orderBy('sort_order')->orderByDesc('created_at');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name_ar', 'like', "%{$q}%")
                    ->orWhere('name_en', 'like', "%{$q}%");
            });
        }

        $partners = $query->paginate(12)->withQueryString();

        return view('cp.partners.index', compact('partners'));
    }

    public function create()
    {
        $item = new Partner();
        $item->type = 'company';
        $item->sort_order = 0;
        return view('cp.partners.form', ['item' => $item, 'title' => 'إضافة شريك']);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePartner($request);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('cp/partners', 'public');
        }

        Partner::create($validated);

        return redirect()->route('cp.partners.index')->with('success', 'تم إضافة الشريك بنجاح.');
    }

    public function edit(Partner $partner)
    {
        return view('cp.partners.form', ['item' => $partner, 'title' => 'تعديل الشريك']);
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $this->validatePartner($request);

        if ($request->hasFile('logo')) {
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('cp/partners', 'public');
        }

        $partner->update($validated);

        return redirect()->route('cp.partners.index')->with('success', 'تم تحديث الشريك بنجاح.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
        }
        $partner->delete();
        return redirect()->route('cp.partners.index')->with('success', 'تم حذف الشريك.');
    }

    private function validatePartner(Request $request): array
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'type' => ['required', 'in:individual,company'],
            'link' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        return $validated;
    }
}
