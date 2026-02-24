<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\EmpowermentRequest;
use Illuminate\Http\Request;

class EmpowermentRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = EmpowermentRequest::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('cp.empowerment-requests.index', compact('requests'));
    }

    public function edit(EmpowermentRequest $empowerment_request)
    {
        return view('cp.empowerment-requests.edit', compact('empowerment_request'));
    }

    public function update(Request $request, EmpowermentRequest $empowerment_request)
    {
        $request->validate([
            'status' => ['required', 'in:pending,contacted,closed'],
        ]);

        $empowerment_request->update([
            'status' => $request->status,
        ]);

        return redirect()->route('cp.empowerment-requests.index')->with('success', 'تم تحديث حالة الطلب.');
    }
}
