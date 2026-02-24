<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @forelse($partners as $partner)
    @if($partner->link)
    <a href="{{ $partner->link }}" target="_blank" rel="noopener"
        class="group bg-white dark:bg-white/[0.02] p-10 rounded-[2.5rem] border border-slate-100 dark:border-white/5 hover:border-primary/30 transition-all duration-500 flex flex-col items-center text-center hover:-translate-y-2 shadow-sm">
    @else
    <div class="group bg-white dark:bg-white/[0.02] p-10 rounded-[2.5rem] border border-slate-100 dark:border-white/5 hover:border-primary/30 transition-all duration-500 flex flex-col items-center text-center hover:-translate-y-2 shadow-sm">
    @endif
        <div class="w-24 h-24 mb-6 flex items-center justify-center grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
            <img alt="{{ localized($partner, 'name') }}" class="max-w-full h-auto object-contain"
                src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : 'https://api.placeholder.com/150?text=Logo' }}" />
        </div>
        <h3 class="font-black text-lg text-slate-900 dark:text-white mb-1 group-hover:text-primary transition-colors">{{ localized($partner, 'name') }}</h3>
        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $partner->type === 'company' ? __('partners.role_company') : __('partners.role_individual') }}</p>
    @if($partner->link)
    </a>
    @else
    </div>
    @endif
    @empty
    <div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">
        {{ __('partners.no_partners') }}
    </div>
    @endforelse
</div>

@if($partners->hasPages())
<div class="mt-20 flex items-center justify-center gap-4 partners-pagination">
    @if ($partners->onFirstPage())
    <span class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-400 cursor-not-allowed">
        <span class="material-symbols-outlined text-xl rtl:rotate-180">chevron_right</span>
    </span>
    @else
    <a href="{{ $partners->previousPageUrl() }}" class="partners-pagination-link w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300 text-slate-900 dark:text-white" data-page="{{ $partners->currentPage() - 1 }}">
        <span class="material-symbols-outlined text-xl rtl:rotate-180">chevron_right</span>
    </a>
    @endif

    <div class="flex gap-2">
        @foreach ($partners->getUrlRange(1, $partners->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="partners-pagination-link w-12 h-12 rounded-2xl flex items-center justify-center font-bold transition-all {{ $page == $partners->currentPage() ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5 text-slate-600 dark:text-slate-400' }}" data-page="{{ $page }}">
            {{ $page }}
        </a>
        @endforeach
    </div>

    @if ($partners->hasMorePages())
    <a href="{{ $partners->nextPageUrl() }}" class="partners-pagination-link w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300 text-slate-900 dark:text-white" data-page="{{ $partners->currentPage() + 1 }}">
        <span class="material-symbols-outlined text-xl rtl:rotate-180">chevron_left</span>
    </a>
    @else
    <span class="w-12 h-12 rounded-2xl border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-400 cursor-not-allowed">
        <span class="material-symbols-outlined text-xl rtl:rotate-180">chevron_left</span>
    </span>
    @endif
</div>
@else
<div class="mt-20 flex items-center justify-center gap-4 partners-pagination"></div>
@endif
