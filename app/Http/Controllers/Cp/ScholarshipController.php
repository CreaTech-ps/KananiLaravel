<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::query()->withCount('applications')->orderBy('sort_order')->orderByDesc('created_at');

        if ($request->filled('active')) {
            if ($request->active === '1') {
                $query->where('is_active', true);
            } elseif ($request->active === '0') {
                $query->where('is_active', false);
            }
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('title_en', 'like', "%{$q}%");
            });
        }

        $scholarships = $query->paginate(12)->withQueryString();

        return view('cp.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        $item = new Scholarship();
        $item->is_active = true;
        $item->sort_order = 0;
        return view('cp.scholarships.form', ['item' => $item, 'title' => 'إضافة منحة']);
    }

    public function store(Request $request)
    {
        $validated = $this->validateScholarship($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('cp/scholarships', 'public');
        }
        if ($request->hasFile('application_form_pdf')) {
            $validated['application_form_pdf_path'] = $request->file('application_form_pdf')->store('cp/scholarships', 'public');
        }

        $validated['slug_ar'] = $validated['slug_ar'] ?: Str::slug($validated['title_ar']);
        $validated['slug_en'] = $validated['slug_en'] ?: Str::slug($validated['title_en'] ?? $validated['title_ar']);

        Scholarship::create($validated);

        return redirect()->route('cp.scholarships.index')->with('success', 'تم إضافة المنحة بنجاح.');
    }

    public function edit(Scholarship $scholarship)
    {
        return view('cp.scholarships.form', ['item' => $scholarship, 'title' => 'تعديل المنحة']);
    }

    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $this->validateScholarship($request, $scholarship);

        if ($request->hasFile('image')) {
            if ($scholarship->image_path) {
                Storage::disk('public')->delete($scholarship->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('cp/scholarships', 'public');
        }
        if ($request->hasFile('application_form_pdf')) {
            if ($scholarship->application_form_pdf_path) {
                Storage::disk('public')->delete($scholarship->application_form_pdf_path);
            }
            $validated['application_form_pdf_path'] = $request->file('application_form_pdf')->store('cp/scholarships', 'public');
        }

        $validated['slug_ar'] = $validated['slug_ar'] ?: Str::slug($validated['title_ar']);
        $validated['slug_en'] = $validated['slug_en'] ?: Str::slug($validated['title_en'] ?? $validated['title_ar']);

        $scholarship->update($validated);

        return redirect()->route('cp.scholarships.index')->with('success', 'تم تحديث المنحة بنجاح.');
    }

    public function destroy(Scholarship $scholarship)
    {
        if ($scholarship->image_path) {
            Storage::disk('public')->delete($scholarship->image_path);
        }
        if ($scholarship->application_form_pdf_path) {
            Storage::disk('public')->delete($scholarship->application_form_pdf_path);
        }
        $scholarship->delete();
        return redirect()->route('cp.scholarships.index')->with('success', 'تم حذف المنحة.');
    }

    private function validateScholarship(Request $request, ?Scholarship $scholarship = null): array
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug_ar' => ['nullable', 'string', 'max:255'],
            'slug_en' => ['nullable', 'string', 'max:255'],
            'summary_ar' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'application_start_date' => ['nullable', 'date'],
            'application_end_date' => ['nullable', 'date', 'after_or_equal:application_start_date'],
            'details_ar' => ['nullable', 'string'],
            'details_en' => ['nullable', 'string'],
            'conditions_ar' => ['nullable', 'string'],
            'conditions_en' => ['nullable', 'string'],
            'required_documents_ar' => ['nullable', 'string'],
            'required_documents_en' => ['nullable', 'string'],
            'application_form_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'coverage_percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        return $validated;
    }
}
