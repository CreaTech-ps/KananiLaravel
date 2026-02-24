@forelse($partnerships as $item)
@php
    $isActive = $item->getAttribute('is_active') ?? true;
@endphp
@if($item->link)
<a href="{{ $item->link }}" target="_blank" rel="noopener"
    class="bg-white dark:bg-card-dark rounded-3xl p-8 border border-slate-100 dark:border-white/5 transition-all duration-500 flex flex-col items-center text-center">
@else
<div class="bg-white dark:bg-card-dark rounded-3xl p-8 border border-slate-100 dark:border-white/5 transition-all duration-500 flex flex-col items-center text-center">
@endif
    <div class="w-24 h-24 bg-slate-50 dark:bg-accent-dark rounded-2xl flex items-center justify-center mb-6 p-4 overflow-hidden">
        @if($item->logo_path)
        <img alt="{{ localized($item, 'supporter_name') }}" class="w-full h-full object-cover dark:invert opacity-90"
            src="{{ asset('storage/' . $item->logo_path) }}" />
        @else
        <span class="material-symbols-outlined text-5xl text-slate-300">business</span>
        @endif
    </div>

    <h3 class="font-bold text-xl mb-1 text-slate-900 dark:text-white">
        {{ localized($item, 'supporter_name') }}
    </h3>
    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-8">
        {{ $item->sector ? __('tamkeen.sector_' . $item->sector) : '—' }}
    </p>

    <div class="w-full bg-slate-50 dark:bg-accent-dark/30 rounded-2xl p-5 flex items-center justify-between mb-6 border border-transparent">
        <div class="text-start">
            <span class="block text-3xl font-black {{ $isActive ? 'text-primary' : 'text-slate-700 dark:text-slate-300' }}">{{ $item->beneficiaries_count ?? '—' }}</span>
            <span class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-tighter">{{ __('tamkeen.beneficiaries_label') }}</span>
        </div>
        @if($item->start_date)
        <div class="text-end text-[10px] font-bold text-slate-400 leading-tight">
            {{ __('tamkeen.since') }}<br />
            <span class="text-slate-600 dark:text-slate-200">{{ $item->start_date->format('m / Y') }}</span>
        </div>
        @endif
    </div>

    <div class="flex items-center gap-2 text-xs font-bold {{ $isActive ? 'text-primary animate-pulse' : 'text-slate-400' }}">
        <span class="w-2 h-2 rounded-full {{ $isActive ? 'bg-primary' : 'bg-slate-400' }}"></span>
        {{ $isActive ? __('tamkeen.status_active') : __('tamkeen.status_complete') }}
    </div>
@if($item->link)
</a>
@else
</div>
@endif
@empty
<div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">
    {{ __('tamkeen.no_partners') }}
</div>
@endforelse
