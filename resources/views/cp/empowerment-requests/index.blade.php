@extends('cp.layout')

@section('title', 'طلبات المساهمة في التمكين')

@section('content')
<div class="space-y-4">
    @if(session('success'))
        <div class="rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
            <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">طلبات المساهمة في التمكين</h2>
        <a href="{{ route('cp.tamkeen.partnerships.index') }}" class="text-sm text-primary hover:underline">← العودة إلى شراكات تمكين</a>
    </div>

    <form action="{{ route('cp.empowerment-requests.index') }}" method="get" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-4 shadow-sm">
        <div class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">البحث</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="الاسم، البريد الإلكتروني، أو رقم الهاتف" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30" />
            </div>
            <div class="min-w-[140px]">
                <label for="status" class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">الحالة</label>
                <select name="status" id="status" class="cp-input w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-primary/30">
                    <option value="">الكل</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>تم التواصل</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>مغلق</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors">تصفية</button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('cp.empowerment-requests.index') }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">إعادة تعيين</a>
            @endif
        </div>
    </form>

    <div class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        @if($requests->isEmpty())
            <div class="p-12 text-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-4xl mb-2 block">inbox</span>
                لا توجد طلبات مساهمة.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الاسم</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">البريد الإلكتروني</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">رقم الهاتف</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الرسالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">الحالة</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300">التاريخ</th>
                            <th class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 w-24">إجراء</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach($requests as $req)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $req->name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <a href="mailto:{{ $req->email }}" class="text-primary hover:underline">{{ $req->email }}</a>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    @if($req->phone)
                                        <a href="tel:{{ $req->phone }}" class="text-primary hover:underline">{{ $req->phone }}</a>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    @if($req->message)
                                        <span class="line-clamp-1" title="{{ $req->message }}">{{ Str::limit($req->message, 50) }}</span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusLabels = ['pending' => 'قيد الانتظار', 'contacted' => 'تم التواصل', 'closed' => 'مغلق'];
                                        $statusClass = match($req->status) { 
                                            'contacted' => 'bg-primary/20 text-primary', 
                                            'closed' => 'bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-300', 
                                            default => 'bg-amber-500/20 text-amber-600 dark:text-amber-400' 
                                        };
                                    @endphp
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">{{ $statusLabels[$req->status] ?? $req->status }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('cp.empowerment-requests.edit', $req) }}" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-300" title="تعديل الحالة">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($requests->hasPages())
                <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-700">{{ $requests->links() }}</div>
            @endif
        @endif
    </div>
</div>
@endsection
