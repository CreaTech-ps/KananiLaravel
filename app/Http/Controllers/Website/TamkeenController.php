<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\TamkeenPartnership;

class TamkeenController extends Controller
{
    public function index()
    {
        $query = TamkeenPartnership::orderBy('sort_order')->orderByDesc('created_at');
        
        // Filter by sector if provided
        if (request()->filled('sector')) {
            $query->where('sector', request('sector'));
        }
        
        $partnerships = $query->paginate(12)->withQueryString();

        $totalBeneficiaries = TamkeenPartnership::sum('beneficiaries_count') ?: 0;
        $totalPartnerships = TamkeenPartnership::count();
        
        // Get unique sectors from partnerships
        $availableSectors = TamkeenPartnership::whereNotNull('sector')
            ->distinct()
            ->pluck('sector')
            ->toArray();

        return view('website.enable', compact('partnerships', 'totalBeneficiaries', 'totalPartnerships', 'availableSectors'));
    }
}
