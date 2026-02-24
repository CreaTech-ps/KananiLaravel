<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use Illuminate\Http\Request;

class ScholarshipApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = ScholarshipApplication::query()->with('scholarship')->orderByDesc('created_at');

        if ($request->filled('scholarship_id')) {
            $query->where('scholarship_id', $request->scholarship_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(15)->withQueryString();
        $scholarships = Scholarship::orderBy('title_ar')->get(['id', 'title_ar']);

        return view('cp.scholarship-applications.index', compact('applications', 'scholarships'));
    }

    public function edit(ScholarshipApplication $scholarship_application)
    {
        $scholarship_application->load('scholarship');
        return view('cp.scholarship-applications.edit', compact('scholarship_application'));
    }

    public function update(Request $request, ScholarshipApplication $scholarship_application)
    {
        $request->validate([
            'status' => ['required', 'in:pending,under_review,approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);
        $scholarship_application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);
        return redirect()->route('cp.scholarship-applications.index', ['scholarship_id' => $scholarship_application->scholarship_id])->with('success', 'تم تحديث حالة الطلب.');
    }
}
