<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($images as $item)
    <div class="group bg-white dark:bg-card-dark rounded-[2.5rem] overflow-hidden border border-slate-100 dark:border-white/5 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-2">
        <div class="relative h-72 overflow-hidden">
            <img alt="{{ localized($item, 'title') }}"
                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800' }}" 
                loading="lazy" width="400" height="300" />
            <div class="absolute top-6 right-6">
                @if($item->status === 'available')
                <span class="bg-emerald-500 text-white text-[11px] font-black px-4 py-2 rounded-full flex items-center gap-2 shadow-xl backdrop-blur-md">
                    <span class="w-2 h-2 bg-white rounded-full animate-ping"></span>
                    {{ __('parasols.status_available') }}
                </span>
                @elseif($item->status === 'newly_booked')
                <span class="bg-blue-500 text-white text-[11px] font-black px-4 py-2 rounded-full flex items-center gap-2 shadow-xl backdrop-blur-md">
                    <span class="material-symbols-outlined text-sm">new_releases</span>
                    {{ __('parasols.status_newly_booked') }}
                </span>
                @elseif($item->status === 'ending_soon')
                <span class="bg-orange-500 text-white text-[11px] font-black px-4 py-2 rounded-full flex items-center gap-2 shadow-xl backdrop-blur-md">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    {{ __('parasols.status_ending_soon') }}
                </span>
                @endif
            </div>
            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/20 to-transparent"></div>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white group-hover:text-primary transition-colors leading-snug">
                    {{ localized($item, 'title') }}
                </h3>
                {{-- عرض السعر فقط للمساحات المتاحة للحجز أو التي تنتهي قريباً --}}
                @if(($item->status === 'available' || $item->status === 'ending_soon') && !empty($item->price))
                <div class="text-start">
                    <p class="text-primary font-black text-2xl">${{ $item->price }}</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase text-center">/ {{ __('parasols.per_month') }}</p>
                </div>
                @endif
            </div>

            @if(localized($item, 'location') || localized($item, 'detailed_location'))
            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-sm mb-8">
                <span class="material-symbols-outlined text-primary text-lg">location_on</span>
                <span class="font-medium">
                    @if(localized($item, 'detailed_location'))
                        {{ localized($item, 'detailed_location') }}
                    @else
                        {{ localized($item, 'location') }}
                    @endif
                </span>
            </div>
            @endif

            {{-- قسم الجهة المعلنة - يظهر فقط إذا تم إدخال بيانات الجهة المعلنة --}}
            @if($item->advertiser_name_ar || $item->advertiser_name_en)
            <div class="flex items-start pt-5 border-t border-slate-100 dark:border-slate-800">
                <span class="flex items-center pt-1 gap-2 text-sm text-slate-600 dark:text-slate-400">{{ __('parasols.advertiser_label') }} :</span>
                <div class="flex -space-x-2 rtl:space-x-reverse">
                    {{-- عرض شعار/أيقونة الجهة المعلنة فقط --}}
                    @if($item->advertiser_logo_path)
                    <img src="{{ asset('storage/' . $item->advertiser_logo_path) }}" alt="{{ localized($item, 'advertiser_name') }}" class="w-8 h-8 rounded-full border-2 border-white dark:border-surface-dark object-cover shadow-sm" loading="lazy" width="32" height="32" />
                    @else
                    <div class="w-8 h-8 rounded-full border-2 border-white dark:border-surface-dark bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-[10px] font-bold text-slate-800 dark:text-slate-300 shadow-sm">
                        {{ Str::limit(localized($item, 'advertiser_name') ?? 'A', 2) }}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16 text-slate-500 dark:text-slate-400">
        {{ __('parasols.no_spaces') }}
    </div>
    @endforelse
</div>
