<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use App\Models\VolunteerDepartment;
use Illuminate\Http\Request;

class VolunteerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = VolunteerApplication::query()->with('department')->orderByDesc('created_at');

        if ($request->filled('department_id')) {
            $query->where('volunteer_department_id', $request->department_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $applications = $query->paginate(15)->withQueryString();
        $departments = VolunteerDepartment::orderBy('name_ar')->get(['id', 'name_ar']);

        return view('cp.volunteer-applications.index', compact('applications', 'departments'));
    }

    public function edit(VolunteerApplication $volunteer_application)
    {
        $volunteer_application->load('department');
        return view('cp.volunteer-applications.edit', compact('volunteer_application'));
    }

    public function update(Request $request, VolunteerApplication $volunteer_application)
    {
        $request->validate([
            'status' => ['required', 'in:pending,under_review,approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $volunteer_application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('cp.volunteer-applications.index')->with('success', 'تم تحديث حالة الطلب.');
    }
}
