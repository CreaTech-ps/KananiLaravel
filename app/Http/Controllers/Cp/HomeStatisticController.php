<?php

namespace App\Http\Controllers\Cp;

use App\Http\Controllers\Controller;
use App\Models\HomeStatistic;
use Illuminate\Http\Request;

class HomeStatisticController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'value' => ['required', 'integer'],
            'label_ar' => ['required', 'string', 'max:255'],
            'label_en' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);

        HomeStatistic::create($validated);

        return redirect()->route('cp.home.edit')->with('success', 'تم إضافة الإحصائية بنجاح.');
    }

    public function edit(HomeStatistic $home_statistic)
    {
        return view('cp.home.statistic-form', ['item' => $home_statistic, 'title' => 'تعديل الإحصائية']);
    }

    public function update(Request $request, HomeStatistic $home_statistic)
    {
        $validated = $request->validate([
            'value' => ['required', 'integer'],
            'label_ar' => ['required', 'string', 'max:255'],
            'label_en' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $validated['sort_order'] = (int) ($request->sort_order ?? 0);

        $home_statistic->update($validated);

        return redirect()->route('cp.home.edit')->with('success', 'تم تحديث الإحصائية بنجاح.');
    }

    public function destroy(HomeStatistic $home_statistic)
    {
        $home_statistic->delete();
        return redirect()->route('cp.home.edit')->with('success', 'تم حذف الإحصائية.');
    }
}
