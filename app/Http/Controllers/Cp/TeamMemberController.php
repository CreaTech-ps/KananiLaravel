<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query()->orderBy('sort_order')->orderBy('type')->orderByDesc('created_at');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name_ar', 'like', "%{$q}%")
                    ->orWhere('title_ar', 'like', "%{$q}%");
            });
        }

        $members = $query->paginate(15)->withQueryString();

        return view('cp.team-members.index', compact('members'));
    }

    public function create()
    {
        $item = new TeamMember();
        $item->type = 'board';
        $item->sort_order = 0;
        return view('cp.team-members.form', ['item' => $item, 'title' => 'إضافة عضو']);
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('cp/team', 'public');
        }

        TeamMember::create($validated);

        return redirect()->route('cp.team-members.index')->with('success', 'تم إضافة العضو بنجاح.');
    }

    public function edit(TeamMember $team_member)
    {
        return view('cp.team-members.form', ['item' => $team_member, 'title' => 'تعديل العضو']);
    }

    public function update(Request $request, TeamMember $team_member)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            if ($team_member->photo_path) {
                Storage::disk('public')->delete($team_member->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('cp/team', 'public');
        }

        $team_member->update($validated);

        return redirect()->route('cp.team-members.index')->with('success', 'تم تحديث العضو بنجاح.');
    }

    public function destroy(TeamMember $team_member)
    {
        if ($team_member->photo_path) {
            Storage::disk('public')->delete($team_member->photo_path);
        }
        $team_member->delete();
        return redirect()->route('cp.team-members.index')->with('success', 'تم حذف العضو.');
    }

    private function validateMember(Request $request): array
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'type' => ['required', 'in:board,executive,staff'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);
        return $validated;
    }
}
