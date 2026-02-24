<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'company');
        if (!in_array($type, ['company', 'individual'])) {
            $type = 'company';
        }

        $partners = Partner::where('type', $type)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(8)
            ->withQueryString();

        $totalPartners = Partner::count();
        $companyCount = Partner::where('type', 'company')->count();
        $individualCount = Partner::where('type', 'individual')->count();

        if ($request->ajax() || $request->query('ajax')) {
            $html = view('website.partials.partners_list', compact('partners'))->render();
            return response()->json([
                'html' => $html,
                'type' => $type,
                'current_page' => $partners->currentPage(),
                'last_page' => $partners->lastPage(),
            ]);
        }

        return view('website.success_partners', compact('partners', 'totalPartners', 'companyCount', 'individualCount', 'type'));
    }
}
