<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::get();
        $boardMembers = TeamMember::where('type', 'board')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $executiveStaff = TeamMember::whereIn('type', ['executive', 'staff'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('website.our_team', compact('boardMembers', 'executiveStaff', 'aboutPage'));
    }
}
