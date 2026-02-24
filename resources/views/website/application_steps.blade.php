@extends('website.layout')
@section('title', __('ui.apply_portal') . ': ' . localized($scholarship, 'title'))

@section('content')
<main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <section class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <nav class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                <a class="hover:underline" href="{{ localized_route('home') }}">{{ __('ui.nav_home') }}</a>
                <span class="material-symbols-outlined text-xs rtl:rotate-180">chevron_left</span>
                <a class="hover:underline" href="{{ localized_route('grants.index') }}">{{ __('ui.nav_grants') }}</a>
                <span class="material-symbols-outlined text-xs rtl:rotate-180">chevron_left</span>
                <a class="hover:underline" href="{{ localized_route('grants.show', ['slug' => current_slug($scholarship)]) }}">{{ localized($scholarship, 'title') }}</a>
                <span class="material-symbols-outlined text-xs rtl:rotate-180">chevron_left</span>
                <span class="text-primary">{{ __('ui.apply_portal') }}</span>
            </nav>
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ __('ui.open_for_apply') }}</span>
            </div>
            <h1 class="text-4xl font-bold dark:text-white">{{ __('ui.apply_portal') }}: {{ localized($scholarship, 'title') }}</h1>
            <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-2xl leading-relaxed">
                {{ __('ui.apply_portal_intro') }}
            </p>
        </div>
        @if($scholarship->application_end_date)
        <div class="bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 p-5 rounded-xl flex items-center gap-4 min-w-[240px]">
            <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/20 flex items-center justify-center text-red-600">
                <span class="material-symbols-outlined">history_toggle_off</span>
            </div>
            <div>
                <p class="text-xs text-red-600/80 font-medium">{{ __('ui.deadline') }}</p>
                <p class="text-xl font-bold text-red-600">{{ $scholarship->application_end_date->locale(app()->getLocale())->translatedFormat('d F Y') }}</p>
            </div>
        </div>
        @endif
    </section>
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-emerald-600 text-2xl">check_circle</span>
        <p class="text-emerald-800 dark:text-emerald-200 font-medium">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-red-600 text-2xl">error</span>
        <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
    </div>
    @endif
    <form action="{{ localized_route('grants.apply.store', ['slug' => current_slug($scholarship)]) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf
        <div class="lg:col-span-8 space-y-8">
            <section id="form-step-1" class="bg-white dark:bg-card-dark border border-gray-200 dark:border-white/10 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-1 h-full bg-primary"></div>
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-primary/10 text-primary px-3 py-1 rounded-md text-xs font-bold whitespace-nowrap">{{ __('ui.step_1') }}</div>
                        <div>
                            <h3 class="text-xl font-bold mb-1">{{ __('ui.step_1_title') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('ui.step_1_desc') }}</p>
                        </div>
                    </div>
                    @if($scholarship->application_form_pdf_path)
                    <a href="{{ asset('storage/' . $scholarship->application_form_pdf_path) }}" target="_blank" rel="noopener"
                        class="w-full md:w-auto flex items-center justify-center gap-2 border-2 border-primary text-primary hover:bg-primary hover:text-white transition-all px-8 py-3 rounded-lg font-bold">
                        <span class="material-symbols-outlined">download</span>
                        {{ __('ui.download_grant_form_pdf') }}
                    </a>
                    @endif
                </div>
            </section>
            <section id="form-step-2" class="bg-white dark:bg-card-dark border border-gray-200 dark:border-white/10 rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-400 px-3 py-1 rounded-md text-xs font-bold">{{ __('ui.step_2') }}</span>
                    <h3 class="text-xl font-bold">{{ __('ui.step_2_title') }}</h3>
                </div>
                <input type="file" name="filled_form" id="filled_form" required accept=".pdf,.jpg,.jpeg,.png"
                    class="hidden" />
                <label for="filled_form" class="block border-2 border-dashed border-gray-200 dark:border-white/10 rounded-xl p-12 flex flex-col items-center justify-center text-center group hover:border-primary transition-colors cursor-pointer" id="drop-zone">
                    <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-white/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary">cloud_upload</span>
                    </div>
                    <p class="text-lg font-medium mb-1">{{ __('ui.step_2_drag_drop') }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{!! __('ui.step_2_browse') !!}</p>
                    <p id="file-name" class="text-sm text-primary font-bold mt-2 hidden"></p>
                </label>
                @error('filled_form')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </section>
            <section id="form-step-3" class="bg-white dark:bg-card-dark border border-gray-200 dark:border-white/10 rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-8">
                    <span class="bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-400 px-3 py-1 rounded-md text-xs font-bold">{{ __('ui.step_3') }}</span>
                    <h3 class="text-xl font-bold">{{ __('ui.step_3_title') }}</h3>
                </div>
                <div class="space-y-8">
                    <div class="space-y-2 max-w-md">
                        <label for="applicant_name" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('ui.full_name') }} <span class="text-red-500">*</span></label>
                        <input name="applicant_name" id="applicant_name" value="{{ old('applicant_name') }}" required
                            class="w-full bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none @error('applicant_name') border-red-500 @enderror" placeholder="{{ __('ui.full_name_placeholder') }}" type="text" />
                        @error('applicant_name')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2 max-w-md">
                        <label for="applicant_id_number" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('ui.id_number') }} <span class="text-red-500">*</span></label>
                        <input name="applicant_id_number" id="applicant_id_number" value="{{ old('applicant_id_number') }}" required
                            class="w-full bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent outline-none @error('applicant_id_number') border-red-500 @enderror" placeholder="{{ __('ui.id_number_placeholder') }}" type="text" />
                        @error('applicant_id_number')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('ui.attach_additional_docs') }}</p>
                        <div id="additional-files-container" class="space-y-3">
                            @for($i = 0; $i < 5; $i++)
                            <div class="flex items-center gap-3 additional-file-row">
                                <input type="file" name="additional_files[]" accept=".pdf,.jpg,.jpeg,.png" class="hidden additional-file-input" />
                                <label class="flex-1 border-2 border-dashed border-gray-200 dark:border-white/10 rounded-lg px-4 py-3 text-sm text-gray-500 dark:text-gray-400 cursor-pointer hover:border-primary transition-colors additional-file-label">{{ __('ui.choose_file') }}</label>
                                <span class="additional-file-name text-sm text-primary hidden"></span>
                                <button type="button" class="remove-additional text-slate-400 hover:text-red-500 hidden" aria-label="{{ __('ui.remove') }}"><span class="material-symbols-outlined text-lg">close</span></button>
                            </div>
                            @endfor
                        </div>
                        <button type="button" id="add-more-files-btn" class="text-primary font-bold text-sm flex items-center gap-1 hover:underline">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            {{ __('ui.add_another_attachment') }}
                        </button>
                        @error('additional_files.*')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>
            <section id="form-step-4" class="bg-white dark:bg-card-dark border border-gray-200 dark:border-white/10 rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-8">
                    <span class="bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-400 px-3 py-1 rounded-md text-xs font-bold">{{ __('ui.step_4') }}</span>
                    <h3 class="text-xl font-bold">{{ __('ui.step_4_title') }}</h3>
                </div>
                <div class="bg-gray-50 dark:bg-background-dark border border-gray-100 dark:border-white/10 p-6 rounded-xl mb-8">
                    <label class="flex items-start gap-4 cursor-pointer">
                        <input name="consent" id="consent" value="1" {{ old('consent') ? 'checked' : '' }} required
                            class="mt-1 w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary @error('consent') border-red-500 @enderror" type="checkbox" />
                        <span class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            {{ __('ui.consent_text') }}
                        </span>
                    </label>
                    @error('consent')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-3 hover:shadow-lg hover:shadow-primary/20 transition-all">
                    {{ __('ui.submit_final_application') }}
                    <span class="material-symbols-outlined">send</span>
                </button>
                <div class="mt-8 flex items-center justify-center gap-6 text-gray-400">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="material-symbols-outlined text-sm text-primary">verified_user</span>
                        {{ __('ui.ssl_encryption') }}
                    </div>
                    <div class="w-px h-4 bg-gray-200 dark:bg-white/10"></div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="material-symbols-outlined text-sm text-primary">verified</span>
                        {{ __('ui.officially_certified') }}
                    </div>
                </div>
            </section>
        </div>
        <aside class="lg:col-span-4 space-y-8">
            <div class="bg-white dark:bg-card-dark border border-gray-200 dark:border-white/10 rounded-2xl p-8 sticky top-24">
                <div class="flex items-center gap-2 mb-8">
                    <span class="material-symbols-outlined text-primary">fact_check</span>
                    <h3 class="font-bold text-lg">{{ __('ui.application_guide_title') }}</h3>
                </div>
                <div class="relative timeline-line space-y-10" id="sidebar-steps">
                    <div id="sidebar-step-1" class="flex gap-4 step-node transition-all duration-300" data-step="1">
                        <div class="step-circle w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold flex-shrink-0">
                            <span class="step-number">1</span>
                            <span class="step-check material-symbols-outlined text-2xl hidden">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-primary step-title">{{ __('ui.step_1_guide_title') }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">{{ __('ui.step_1_guide_desc') }}</p>
                        </div>
                    </div>
                    <div id="sidebar-step-2" class="flex gap-4 step-node opacity-60 transition-all duration-300" data-step="2">
                        <div class="step-circle w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 text-gray-600 dark:text-gray-400 flex items-center justify-center font-bold flex-shrink-0">
                            <span class="step-number">2</span>
                            <span class="step-check material-symbols-outlined text-2xl hidden">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold step-title">{{ __('ui.step_2_guide_title') }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">{{ __('ui.step_2_guide_desc') }}</p>
                        </div>
                    </div>
                    <div id="sidebar-step-3" class="flex gap-4 step-node opacity-60 transition-all duration-300" data-step="3">
                        <div class="step-circle w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 text-gray-600 dark:text-gray-400 flex items-center justify-center font-bold flex-shrink-0">
                            <span class="step-number">3</span>
                            <span class="step-check material-symbols-outlined text-2xl hidden">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold step-title">{{ __('ui.step_3_guide_title') }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">{{ __('ui.step_3_guide_desc') }}</p>
                        </div>
                    </div>
                    <div id="sidebar-step-4" class="flex gap-4 step-node opacity-60 transition-all duration-300" data-step="4">
                        <div class="step-circle w-10 h-10 rounded-full bg-gray-200 dark:bg-white/10 text-gray-600 dark:text-gray-400 flex items-center justify-center font-bold flex-shrink-0">
                            <span class="step-number">4</span>
                            <span class="step-check material-symbols-outlined text-2xl hidden">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold step-title">{{ __('ui.step_4_guide_title') }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">{{ __('ui.step_4_guide_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-900/20 p-5 rounded-xl flex gap-3">
                    <span class="material-symbols-outlined text-amber-600">info</span>
                    <div>
                        <h5 class="text-sm font-bold text-amber-800 dark:text-amber-400 mb-1">{{ __('ui.important_note') }}</h5>
                        <p class="text-xs text-amber-700/80 dark:text-amber-400/80 leading-relaxed">{{ __('ui.important_note_text') }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </form>
    </section>
</main>
@endsection

@section('scripts')
<script>
function updateSidebarSteps() {
    var filledForm = document.getElementById('filled_form');
    var step2Done = filledForm && filledForm.files && filledForm.files.length > 0;
    var nameEl = document.getElementById('applicant_name');
    var idEl = document.getElementById('applicant_id_number');
    var step3Done = nameEl && idEl && nameEl.value.trim() !== '' && idEl.value.trim() !== '';
    var consentEl = document.getElementById('consent');
    var step4Done = consentEl && consentEl.checked;
    var completed = [ true, step2Done, step3Done, step4Done ];
    var currentStep = 1;
    for (var s = 1; s <= 4; s++) {
        if (!completed[s - 1]) { currentStep = s; break; }
    }
    if (completed[3]) currentStep = 4;
    for (var i = 1; i <= 4; i++) {
        var node = document.getElementById('sidebar-step-' + i);
        if (!node) continue;
        var circle = node.querySelector('.step-circle');
        var numSpan = node.querySelector('.step-number');
        var checkSpan = node.querySelector('.step-check');
        var titleEl = node.querySelector('.step-title');
        var isDone = completed[i - 1];
        var isCurrent = (i === currentStep);
        node.classList.remove('opacity-60');
        node.style.opacity = '';
        circle.classList.remove('bg-primary', 'bg-green-500', 'bg-gray-200', 'text-white', 'text-gray-600', 'dark:bg-white/10', 'dark:text-gray-400', 'border', 'border-primary/30');
        if (numSpan) numSpan.classList.add('hidden');
        if (checkSpan) checkSpan.classList.add('hidden');
        if (titleEl) titleEl.classList.remove('text-primary');
        if (isDone) {
            circle.classList.add('bg-green-500', 'text-white');
            if (numSpan) numSpan.classList.add('hidden');
            if (checkSpan) checkSpan.classList.remove('hidden');
        } else if (isCurrent) {
            circle.classList.add('bg-primary', 'text-white');
            if (numSpan) numSpan.classList.remove('hidden');
            if (titleEl) titleEl.classList.add('text-primary');
            node.style.opacity = '1';
        } else {
            circle.classList.add('bg-gray-200', 'dark:bg-white/10', 'text-gray-600', 'dark:text-gray-400');
            if (numSpan) numSpan.classList.remove('hidden');
            node.classList.add('opacity-60');
        }
    }
}

document.getElementById('filled_form')?.addEventListener('change', function() {
    var fileName = document.getElementById('file-name');
    if (this.files && this.files.length) {
        var fileSelectedText = '{{ __('ui.file_selected', ['filename' => ':filename']) }}';
        fileName.textContent = fileSelectedText.replace(':filename', this.files[0].name);
        fileName.classList.remove('hidden');
    } else {
        fileName.classList.add('hidden');
    }
    updateSidebarSteps();
});
var dropZone = document.getElementById('drop-zone');
if (dropZone) {
    ['dragenter', 'dragover'].forEach(function(e) { dropZone.addEventListener(e, function(ev) { ev.preventDefault(); dropZone.classList.add('border-primary', 'bg-primary/5'); }); });
    ['dragleave', 'drop'].forEach(function(e) { dropZone.addEventListener(e, function(ev) { ev.preventDefault(); dropZone.classList.remove('border-primary', 'bg-primary/5'); }); });
    dropZone.addEventListener('drop', function(e) {
        var input = document.getElementById('filled_form');
        if (input && e.dataTransfer.files.length) { input.files = e.dataTransfer.files; input.dispatchEvent(new Event('change')); }
    });
}
document.getElementById('applicant_name')?.addEventListener('input', updateSidebarSteps);
document.getElementById('applicant_name')?.addEventListener('blur', updateSidebarSteps);
document.getElementById('applicant_id_number')?.addEventListener('input', updateSidebarSteps);
document.getElementById('applicant_id_number')?.addEventListener('blur', updateSidebarSteps);
document.getElementById('consent')?.addEventListener('change', updateSidebarSteps);
document.addEventListener('DOMContentLoaded', updateSidebarSteps);
(function() {
    var container = document.getElementById('additional-files-container');
    var addBtn = document.getElementById('add-more-files-btn');
    var maxFiles = 10;
    function countRows() { return container ? container.querySelectorAll('.additional-file-row').length : 0; }
    function bindRow(row) {
        var input = row.querySelector('.additional-file-input');
        var label = row.querySelector('.additional-file-label');
        var nameSpan = row.querySelector('.additional-file-name');
        var removeBtn = row.querySelector('.remove-additional');
        if (!input || !label) return;
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                nameSpan.textContent = this.files[0].name;
                nameSpan.classList.remove('hidden');
                if (removeBtn) removeBtn.classList.remove('hidden');
            } else {
                nameSpan.classList.add('hidden');
                if (removeBtn) removeBtn.classList.add('hidden');
            }
        });
        label.addEventListener('click', function(e) { e.preventDefault(); input.click(); });
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                input.value = '';
                nameSpan.classList.add('hidden');
                removeBtn.classList.add('hidden');
            });
        }
    }
    container.querySelectorAll('.additional-file-row').forEach(bindRow);
    addBtn && addBtn.addEventListener('click', function() {
        if (countRows() >= maxFiles) return;
        var first = container.querySelector('.additional-file-row');
        if (!first) return;
        var clone = first.cloneNode(true);
        clone.querySelector('.additional-file-input').value = '';
        clone.querySelector('.additional-file-name').textContent = '';
        clone.querySelector('.additional-file-name').classList.add('hidden');
        var rb = clone.querySelector('.remove-additional');
        if (rb) rb.classList.add('hidden');
        container.appendChild(clone);
        bindRow(clone);
    });
})();
</script>
@endsection
