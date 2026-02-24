<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\TamkeenPartnershipRequest;
use Illuminate\Http\Request;

class TamkeenPartnershipRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = TamkeenPartnershipRequest::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('company_name', 'like', "%{$q}%")
                    ->orWhere('contact_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('cp.tamkeen.partnership-requests.index', compact('requests'));
    }

    public function edit(TamkeenPartnershipRequest $tamkeen_partnership_request)
    {
        return view('cp.tamkeen.partnership-requests.edit', compact('tamkeen_partnership_request'));
    }

    public function update(Request $request, TamkeenPartnershipRequest $tamkeen_partnership_request)
    {
        $request->validate([
            'status' => ['required', 'in:pending,under_review,approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $tamkeen_partnership_request->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('cp.tamkeen.partnership-requests.index')->with('success', 'تم تحديث حالة الطلب.');
    }
}
