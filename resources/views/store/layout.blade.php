@php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html class="dark" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" lang="{{ $locale }}">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/KANANI-Logo-l.svg') }}">
    <title>@hasSection('title')@yield('title') — {{ __('ui.site_name') ?? 'جمعية أصدقاء بيرزيت' }}@else{{ __('ui.store_embroidery') ?? 'متجر المطرزات الفلسطينية' }} — {{ __('ui.site_name') ?? 'جمعية أصدقاء بيرزيت' }}@endif</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Tajawal', 'sans-serif'] },
                    colors: {
                        primarys: '#96194A',
                        'background-lights': '#f8fafc',
                        'background-darks': '#0f1419',
                        'surface-darks': '#1a2332',
                        'card-dark': '#1e1e1e',
                    }
                }
            }
        }
    </script>
   
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        (function($) {
            'use strict';
            var urls = {
                add: "{{ route('store.cart.add') }}",
                count: "{{ route('store.cart.count') }}",
                items: "{{ route('store.cart.items') }}",
                remove: "{{ route('store.cart.remove') }}",
                search: "{{ route('store.search') }}"
            };
            var productBase = "{{ url('/product') }}";
            var currencyLabel = "{{ __('ui.currency_nis') ?? 'شيكل' }}";
            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            function getHeaders() {
                return { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
            }
            function updateCartCount(count) {
                var el = document.getElementById('store-cart-count');
                if (el) { el.textContent = count; el.style.display = count > 0 ? 'flex' : 'none'; }
            }
            function renderCartDropdown(items, total) {
                var list = document.getElementById('store-cart-items-list');
                var empty = document.getElementById('store-cart-empty');
                var footer = document.getElementById('store-cart-dropdown-footer');
                var totalEl = document.getElementById('store-cart-total');
                if (!list) return;
                list.innerHTML = '';
                if (items && items.length > 0) {
                    empty.classList.add('hidden');
                    footer.classList.remove('hidden');
                    if (totalEl) totalEl.textContent = total.toLocaleString() + ' ' + currencyLabel;
                    items.forEach(function(item) {
                        var img = item.image || 'https://via.placeholder.com/60x60?text=Product';
                        var url = productBase ? (productBase + '/' + item.slug) : '#';
                        var row = '<a href="' + url + '" class="flex gap-3 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">' +
                            '<img src="' + img + '" alt="" class="w-14 h-14 object-cover rounded-lg flex-shrink-0" />' +
                            '<div class="flex-1 min-w-0"><p class="text-sm font-medium truncate">' + (item.name || '') + '</p>' +
                            '<p class="text-xs text-slate-500">' + item.quantity + ' × ' + item.price.toLocaleString() + ' ' + currencyLabel + '</p></div>' +
                            '<span class="text-sm font-bold text-primarys flex-shrink-0">' + item.subtotal.toLocaleString() + '</span></a>';
                        list.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    empty.classList.remove('hidden');
                    footer.classList.add('hidden');
                }
            }
            function showCartDropdown() {
                var dd = document.getElementById('store-cart-dropdown');
                if (!dd) return;
                var loading = document.getElementById('store-cart-loading');
                var list = document.getElementById('store-cart-items-list');
                var empty = document.getElementById('store-cart-empty');
                dd.classList.remove('invisible', 'opacity-0');
                dd.classList.add('visible', 'opacity-100');
                loading.classList.remove('hidden');
                list.innerHTML = '';
                empty.classList.add('hidden');
                $.ajax({ url: urls.items, method: 'GET', cache: false, xhrFields: { withCredentials: true }, headers: getHeaders(), success: function(res) {
                    loading.classList.add('hidden');
                    renderCartDropdown(res && res.items ? res.items : [], res && res.total ? res.total : 0);
                }, error: function() { loading.classList.add('hidden'); renderCartDropdown([], 0); } });
            }
            function hideCartDropdown() {
                var dd = document.getElementById('store-cart-dropdown');
                if (dd) { dd.classList.add('invisible', 'opacity-0'); dd.classList.remove('visible', 'opacity-100'); }
            }
            function showToast(msg) {
                var t = $('<div class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[100] px-6 py-3 bg-primarys text-white text-sm font-medium rounded-xl shadow-lg" style="background-color:#96194A;">' + msg + '</div>');
                $('body').append(t);
                setTimeout(function() { t.fadeOut(300, function() { $(this).remove(); }); }, 2000);
            }
            window.StoreCart = {
                add: function(productId, quantity, onSuccess) {
                    quantity = quantity || 1;
                    $.ajax({ url: urls.add, method: 'POST', cache: false, xhrFields: { withCredentials: true }, headers: getHeaders(), data: JSON.stringify({ product_id: productId, quantity: quantity }),
                        success: function(res) {
                            if (res && res.ok) {
                                updateCartCount(res.count);
                                showCartDropdown();
                                if (typeof onSuccess === 'function') onSuccess(res);
                                showToast("{{ __('ui.store_added_to_cart') ?? 'تمت الإضافة للسلة' }}");
                            }
                        },
                        error: function(xhr) {
                            var m = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'حدث خطأ';
                            showToast(m);
                        }
                    });
                },
                updateCount: updateCartCount,
                fetchCount: function() {
                    $.ajax({ url: urls.count, method: 'GET', cache: false, xhrFields: { withCredentials: true }, headers: getHeaders(), success: function(res) {
                        if (res && typeof res.count !== 'undefined') updateCartCount(res.count);
                    }});
                },
            };
            var searchDebounce;
            function showSearchDropdown() {
                var dd = document.getElementById('store-search-dropdown');
                if (dd) { dd.classList.remove('invisible', 'opacity-0'); dd.classList.add('visible', 'opacity-100'); }
            }
            function hideSearchDropdown() {
                var dd = document.getElementById('store-search-dropdown');
                if (dd) { dd.classList.add('invisible', 'opacity-0'); dd.classList.remove('visible', 'opacity-100'); }
            }
            function renderSearchResults(products) {
                var list = document.getElementById('store-search-results');
                var loading = document.getElementById('store-search-loading');
                var empty = document.getElementById('store-search-empty');
                if (!list) return;
                loading.classList.add('hidden');
                list.innerHTML = '';
                if (products && products.length > 0) {
                    empty.classList.add('hidden');
                    products.forEach(function(p) {
                        var url = productBase + '/' + (p.slug || p.id);
                        var img = p.image || 'https://via.placeholder.com/60x60?text=';
                        var row = '<a href="' + url + '" class="flex gap-3 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">' +
                            '<img src="' + img + '" alt="" class="w-14 h-14 object-cover rounded-lg flex-shrink-0" />' +
                            '<div class="flex-1 min-w-0"><p class="text-sm font-medium truncate text-slate-800 dark:text-white">' + (p.name || '') + '</p>' +
                            '<p class="text-xs text-primary font-bold">' + (p.price ? p.price.toLocaleString() : '') + ' ' + currencyLabel + '</p></div></a>';
                        list.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    empty.classList.remove('hidden');
                }
            }
            function doSearch(q) {
                var loading = document.getElementById('store-search-loading');
                var empty = document.getElementById('store-search-empty');
                if (q.length < 1) {
                    renderSearchResults([]);
                    hideSearchDropdown();
                    return;
                }
                showSearchDropdown();
                loading.classList.remove('hidden');
                empty.classList.add('hidden');
                $.ajax({ url: urls.search, method: 'GET', data: { q: q }, cache: false, success: function(res) {
                    renderSearchResults(res && res.products ? res.products : []);
                }, error: function() { renderSearchResults([]); } });
            }

            $(function() {
                window.StoreCart.fetchCount();
                var wrapper = document.getElementById('store-cart-wrapper');
                var dd = document.getElementById('store-cart-dropdown');
                if (wrapper && dd) {
                    var hideTimer;
                    wrapper.addEventListener('mouseenter', function() { clearTimeout(hideTimer); showCartDropdown(); });
                    wrapper.addEventListener('mouseleave', function() { hideTimer = setTimeout(hideCartDropdown, 150); });
                }
                var searchInput = document.getElementById('store-nav-search');
                var searchWrapper = document.getElementById('store-search-wrapper');
                if (searchInput && searchWrapper) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(searchDebounce);
                        var q = this.value.trim();
                        searchDebounce = setTimeout(function() { doSearch(q); }, 220);
                    });
                    searchInput.addEventListener('focus', function() {
                        if (this.value.trim().length >= 1) doSearch(this.value.trim());
                    });
                    document.addEventListener('click', function(e) {
                        if (!searchWrapper.contains(e.target)) hideSearchDropdown();
                    });
                }
                $(document).on('click', '.store-add-to-cart-btn', function(e) {
                    e.preventDefault();
                    var btn = $(this);
                    var productId = btn.data('product-id');
                    if (!productId) return;
                    var qtyEl = btn.data('quantity-source');
                    var quantity = 1;
                    if (qtyEl) { var q = parseInt($(qtyEl).text(), 10); if (!isNaN(q) && q > 0) quantity = q; }
                    if (window.StoreCart && window.StoreCart.add) window.StoreCart.add(productId, quantity);
                });
            });
        })(jQuery);
    </script>
    @stack('styles')
    @yield('styles')
</head>
<body class="bg-background-lights dark:bg-background-darks text-slate-900 dark:text-slate-100 transition-colors duration-300">
    @include('store.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('store.partials.footer')

    {{-- Theme Toggle --}}
    <button class="fixed bottom-6 {{ $isRtl ? 'left-6' : 'right-6' }} w-12 h-12 bg-white dark:bg-card-dark border border-slate-200 dark:border-white/10 rounded-full shadow-2xl flex items-center justify-center z-50 hover:scale-110 transition-all" id="theme-toggle" onclick="toggleStoreDarkMode()">
        <span class="material-symbols-outlined dark:hidden" id="theme-toggle-dark-icon">dark_mode</span>
        <span class="material-symbols-outlined hidden dark:block text-yellow-400" id="theme-toggle-light-icon">light_mode</span>
    </button>

    <script>
        function toggleStoreDarkMode() {
            const htmlElement = document.documentElement;
            htmlElement.classList.toggle('dark');
            localStorage.setItem('store_theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
        }
        if (localStorage.getItem('store_theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script>
        const menuBtn = document.getElementById('store-mobile-menu-btn');
        const mobileMenu = document.getElementById('store-mobile-menu');
        const menuIcon = document.getElementById('store-menu-icon');
        if (menuBtn && mobileMenu && menuIcon) {
            menuBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.contains('hidden');
                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.innerText = 'close';
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.innerText = 'menu';
                }
            });
        }
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.store-copy-link-btn');
            if (!btn) return;
            const url = btn.getAttribute('data-url') || window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                const t = document.createElement('div');
                t.className = 'fixed bottom-24 left-1/2 -translate-x-1/2 z-[200] px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white text-sm font-medium rounded-lg shadow-lg';
                t.textContent = '{{ __("ui.link_copied") ?? "تم نسخ الرابط" }}';
                document.body.appendChild(t);
                setTimeout(function() { t.remove(); }, 1500);
            });
        });
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
