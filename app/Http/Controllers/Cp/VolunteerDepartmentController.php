<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\VolunteerDepartment;
use Illuminate\Http\Request;

class VolunteerDepartmentController extends Controller
{
    public function index()
    {
        $departments = VolunteerDepartment::orderBy('order')->orderBy('id')->get();
        return view('cp.volunteer-departments.index', compact('departments'));
    }

    public function create()
    {
        return view('cp.volunteer-departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        VolunteerDepartment::create([
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('cp.volunteer-departments.index')
            ->with('success', 'تم إضافة القسم بنجاح.');
    }

    public function edit(VolunteerDepartment $volunteerDepartment)
    {
        return view('cp.volunteer-departments.edit', compact('volunteerDepartment'));
    }

    public function update(Request $request, VolunteerDepartment $volunteerDepartment)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $volunteerDepartment->update([
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'] ?? null,
            'is_active' => $request->has('is_active'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('cp.volunteer-departments.index')
            ->with('success', 'تم تحديث القسم بنجاح.');
    }

    public function destroy(VolunteerDepartment $volunteerDepartment)
    {
        if ($volunteerDepartment->applications()->count() > 0) {
            return redirect()->route('cp.volunteer-departments.index')
                ->with('error', 'لا يمكن حذف القسم لأنه يحتوي على طلبات تطوع.');
        }

        $volunteerDepartment->delete();

        return redirect()->route('cp.volunteer-departments.index')
            ->with('success', 'تم حذف القسم بنجاح.');
    }
}
