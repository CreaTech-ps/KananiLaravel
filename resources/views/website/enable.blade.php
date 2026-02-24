@extends('website.layout')

@section('title', __('tamkeen.page_title'))

@section('content')
<main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
    <section class="py-16 md:py-20 relative overflow-hidden bg-white dark:bg-[#0C0C0C] transition-colors duration-500">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 text-primary border border-primary/20 mb-8 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest">{{ __('tamkeen.badge') }}</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 dark:text-white mb-8 leading-[1.2] tracking-tight">
                    {{ __('tamkeen.hero_title_line1') }} <span class="text-primary">{{ __('tamkeen.hero_title_line2') }}</span>
                </h1>

                <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl max-w-3xl mx-auto mb-14 leading-relaxed opacity-90">
                    {{ __('tamkeen.hero_subtitle') }}
                </p>

                <div class="flex flex-wrap justify-center gap-6">
                    <a href="{{ __('tamkeen.partner_join_url') ?: '#partner' }}" class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 inline-flex items-center justify-center">
                        {{ __('tamkeen.partner_join') }}
                    </a>
                    <a href="#partners" class="bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg border border-slate-200 dark:border-white/20 hover:bg-slate-200 dark:hover:bg-white/20 transition-all inline-flex items-center justify-center">
                        {{ __('tamkeen.browse_guide') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-30 mt-4 mb-20">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">school</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ str_replace(['+', ','], '', $totalBeneficiaries > 0 ? number_format($totalBeneficiaries) . '+' : '1500') }}">{{ $totalBeneficiaries > 0 ? number_format($totalBeneficiaries) . '+' : '1,500+' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('tamkeen.stat1_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">corporate_fare</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="{{ str_replace(['+', ','], '', $totalPartnerships > 0 ? $totalPartnerships . '+' : '45') }}">{{ $totalPartnerships > 0 ? $totalPartnerships . '+' : '45+' }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('tamkeen.stat2_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
                <div class="group relative bg-white dark:bg-[#121212] p-6 md:p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/5 transition-all duration-500 hover:-translate-y-3 hover:border-primary/20 overflow-hidden">
                    <div class="relative z-10 text-center">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <span class="material-symbols-outlined text-2xl">schedule</span>
                        </div>
                        <h3 class="stat-number text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-1" data-target="10000">10,000+</h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">{{ __('tamkeen.stat3_label') }}</p>
                    </div>
                    <div class="absolute -bottom-12 -end-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="partners" class="mb-20 max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
            <div class="space-y-3">
                <h2 class="text-4xl font-bold text-slate-900 dark:text-white">{{ __('tamkeen.partners_heading') }}</h2>
                <p class="text-lg text-slate-500 dark:text-slate-400 max-w-xl leading-relaxed">
                    {{ __('tamkeen.partners_subtitle') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ __('tamkeen.filter_label') }}</span>
                <select id="sector-filter" class="bg-white dark:bg-card-dark border border-slate-200 dark:border-white/10 rounded-xl text-sm px-4 py-2.5 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer font-medium text-slate-700 dark:text-slate-200">
                    <option value="">{{ __('tamkeen.filter_all') }}</option>
                    @foreach(['tech' => __('tamkeen.sector_tech'), 'banking' => __('tamkeen.sector_banking'), 'industry' => __('tamkeen.sector_industry'), 'logistics' => __('tamkeen.sector_logistics')] as $value => $label)
                        @if(in_array($value, $availableSectors ?? []))
                        <option value="{{ $value }}" {{ request('sector') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="partners-grid">
            @include('website.partials.tamkeen-partners-list', ['partnerships' => $partnerships])
        </div>

        @if($partnerships->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $partnerships->links('pagination::tailwind') }}
        </div>
        @endif
    </section>

    <section class="bg-primary rounded-[2.5rem] p-8 md:p-14 flex flex-col md:flex-row items-center justify-between gap-8 mb-20 relative overflow-hidden shadow-2xl shadow-primary/10">
        <div class="absolute top-0 end-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
        <div class="relative z-10 text-center md:text-right">
            <h2 class="text-white text-3xl md:text-4xl font-extrabold mb-4">{{ __('tamkeen.cta_title') }}</h2>
            <p class="text-white/80 max-w-lg leading-relaxed text-sm md:text-base">
                {{ __('tamkeen.cta_subtitle') }}
            </p>
        </div>
        <button type="button" onclick="openPartnershipForm()" class="relative z-10 bg-background-dark text-white px-10 py-5 rounded-2xl font-bold flex items-center gap-3 hover:bg-black transition-all transform hover:scale-105 shadow-xl whitespace-nowrap">
            <span class="material-symbols-outlined">business_center</span>
            {{ __('tamkeen.cta_button') }}
        </button>
    </section>
</main>

{{-- Lightbox نموذج طلب الشراكة --}}
<div id="partnership-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-md transition-all duration-300 opacity-0 px-4">
    <div class="bg-white dark:bg-card-dark w-full max-w-2xl rounded-[32px] p-8 sm:p-12 relative shadow-2xl scale-95 transition-transform duration-300 flex flex-col max-h-[85vh]" id="partnership-modal-content">
        <button onclick="closePartnershipForm()" class="absolute top-6 end-6 text-slate-400 hover:text-primary transition-colors z-20">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <div class="overflow-y-auto custom-scrollbar">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 text-center">انضم كشريك</h2>
            <form id="partnership-form" class="space-y-6">
                @csrf
                <div>
                    <label for="partnership-company-name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">اسم الشركة *</label>
                    <input type="text" id="partnership-company-name" name="company_name" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="partnership-contact-name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">اسم المسؤول *</label>
                    <input type="text" id="partnership-contact-name" name="contact_name" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="partnership-email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">البريد الإلكتروني *</label>
                    <input type="email" id="partnership-email" name="email" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="partnership-phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">رقم التواصل *</label>
                    <input type="tel" id="partnership-phone" name="phone" required class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="partnership-message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">رسالة إضافية (اختياري)</label>
                    <textarea id="partnership-message" name="message" rows="4" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-800 dark:text-slate-200 px-4 py-3 focus:ring-2 focus:ring-primary/30 focus:border-primary"></textarea>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" onclick="closePartnershipForm()" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        إلغاء
                    </button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-primary text-white hover:bg-primary-dark transition-colors font-medium inline-flex items-center gap-2">
                        <span class="material-symbols-outlined">send</span>
                        إرسال الطلب
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // AJAX Filtering
    $(document).ready(function() {
        $('#sector-filter').on('change', function() {
            var sector = $(this).val();
            $.ajax({
                url: '{{ route("tamkeen.partnerships.filter") }}',
                method: 'GET',
                data: { sector: sector },
                beforeSend: function() {
                    $('#partners-grid').html('<div class="col-span-full text-center py-16"><span class="material-symbols-outlined animate-spin text-4xl text-primary">sync</span></div>');
                },
                success: function(response) {
                    if (response.success) {
                        $('#partners-grid').html(response.html);
                    }
                },
                error: function() {
                    $('#partners-grid').html('<div class="col-span-full text-center py-16 text-red-500">حدث خطأ في تحميل البيانات</div>');
                }
            });
        });
    });

    // Partnership form functions
    function openPartnershipForm() {
        var modal = document.getElementById('partnership-modal');
        var content = document.getElementById('partnership-modal-content');
        if (modal && content) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(function() {
                modal.classList.add('opacity-100');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }
    }
    function closePartnershipForm() {
        var modal = document.getElementById('partnership-modal');
        var content = document.getElementById('partnership-modal-content');
        if (modal && content) {
            modal.classList.remove('opacity-100');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
                var form = document.getElementById('partnership-form');
                if (form) form.reset();
            }, 300);
        }
    }
    document.getElementById('partnership-modal')?.addEventListener('click', function(e) {
        if (e.target === this) closePartnershipForm();
    });
    document.getElementById('partnership-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var submitBtn = this.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> جاري الإرسال...';
        
        fetch('{{ route("tamkeen.partnerships.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closePartnershipForm();
            } else {
                alert(data.message || 'حدث خطأ. يرجى المحاولة مرة أخرى.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ. يرجى المحاولة مرة أخرى.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
</script>
@endpush
