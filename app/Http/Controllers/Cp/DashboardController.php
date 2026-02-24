<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news' => DB::table('news')->count(),
            'scholarships' => DB::table('scholarships')->where('is_active', true)->count(),
            'partners' => DB::table('partners')->count(),
            'scholarship_applications' => DB::table('scholarship_applications')->where('status', 'pending')->count(),
            'empowerment_requests' => DB::table('empowerment_requests')->where('status', 'pending')->count(),
            'membership_requests' => DB::table('membership_requests')->where('status', 'pending')->count(),
        ];

        return view('cp.dashboard', compact('stats'));
    }
}
