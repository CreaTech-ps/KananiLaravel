/**
 * Store Cart - jQuery AJAX
 * تحديث السلة لحظياً في النافبار + عرض التفاصيل عند التمرير
 */
(function ($) {
    'use strict';

    const urls = {
        add: window.STORE_CART_ADD_URL || '/cart/add',
        count: window.STORE_CART_COUNT_URL || '/cart/count',
        items: window.STORE_CART_ITEMS_URL || '/cart/items',
        remove: window.STORE_CART_REMOVE_URL || '/cart/remove',
    };

    const productBase = window.STORE_PRODUCT_BASE_URL || '';
    const currencyLabel = window.STORE_CURRENCY_LABEL || 'شيكل';
    const cartEmptyMsg = window.STORE_CART_EMPTY_MSG || 'السلة فارغة';
    const cartTotalLabel = window.STORE_CART_TOTAL_LABEL || 'المجموع';

    const csrfToken = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    };

    const getAjaxHeaders = () => ({
        'X-CSRF-TOKEN': csrfToken(),
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    });

    function updateCartCount(count) {
        const el = document.getElementById('store-cart-count');
        if (el) {
            el.textContent = count;
            el.style.display = count > 0 ? 'flex' : 'none';
            var link = el.closest('a');
            if (link) link.classList.toggle('has-items', count > 0);
        }
    }

    function fetchCount() {
        $.ajax({
            url: urls.count + '?_=' + Date.now(),
            method: 'GET',
            cache: false,
            headers: getAjaxHeaders(),
            success: function (res) {
                if (res && typeof res.count !== 'undefined') {
                    updateCartCount(res.count);
                }
            },
        });
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

            items.forEach(function (item) {
                var img = item.image || 'https://via.placeholder.com/60x60?text=Product';
                var url = productBase ? (productBase + '/' + item.slug) : '#';
                var row = '<a href="' + url + '" class="flex gap-3 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">' +
                    '<img src="' + img + '" alt="" class="w-14 h-14 object-cover rounded-lg flex-shrink-0" />' +
                    '<div class="flex-1 min-w-0">' +
                    '<p class="text-sm font-medium truncate">' + (item.name || '') + '</p>' +
                    '<p class="text-xs text-slate-500">' + item.quantity + ' × ' + item.price.toLocaleString() + ' ' + currencyLabel + '</p>' +
                    '</div>' +
                    '<span class="text-sm font-bold text-primarys flex-shrink-0">' + item.subtotal.toLocaleString() + '</span>' +
                    '</a>';
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

        $.ajax({
            url: urls.items + '?_=' + Date.now(),
            method: 'GET',
            cache: false,
            headers: getAjaxHeaders(),
            success: function (res) {
                loading.classList.add('hidden');
                if (res && res.items) {
                    renderCartDropdown(res.items, res.total || 0);
                } else {
                    renderCartDropdown([], 0);
                }
            },
            error: function () {
                loading.classList.add('hidden');
                renderCartDropdown([], 0);
            },
        });
    }

    function hideCartDropdown() {
        var dd = document.getElementById('store-cart-dropdown');
        if (dd) {
            dd.classList.add('invisible', 'opacity-0');
            dd.classList.remove('visible', 'opacity-100');
        }
    }

    function showToast(message) {
        var toast = $('<div class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[100] px-6 py-3 bg-primarys text-white text-sm font-medium rounded-xl shadow-lg" style="background-color:#96194A;">' + message + '</div>');
        $('body').append(toast);
        setTimeout(function () {
            toast.fadeOut(300, function () { $(this).remove(); });
        }, 2000);
    }

    window.StoreCart = {
        add: function (productId, quantity, onSuccess) {
            quantity = quantity || 1;
            $.ajax({
                url: urls.add,
                method: 'POST',
                headers: getAjaxHeaders(),
                data: JSON.stringify({ product_id: productId, quantity: quantity }),
                success: function (res) {
                    if (res && res.ok) {
                        updateCartCount(res.count);
                        showCartDropdown();
                        if (typeof onSuccess === 'function') onSuccess(res);
                        showToast(window.STORE_CART_ADDED_MSG || 'تمت الإضافة للسلة');
                    }
                },
                error: function (xhr) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'حدث خطأ';
                    showToast(msg);
                },
            });
        },
        updateCount: updateCartCount,
        fetchCount: fetchCount,
    };

    $(function () {
        fetchCount();

        var wrapper = document.getElementById('store-cart-wrapper');
        var dd = document.getElementById('store-cart-dropdown');
        if (wrapper && dd) {
            var hideTimer;
            wrapper.addEventListener('mouseenter', function () {
                clearTimeout(hideTimer);
                showCartDropdown();
            });
            wrapper.addEventListener('mouseleave', function () {
                hideTimer = setTimeout(hideCartDropdown, 150);
            });
        }

        $(document).on('click', '.store-add-to-cart-btn', function (e) {
            e.preventDefault();
            var btn = $(this);
            var productId = btn.data('product-id');
            if (!productId) return;
            var qtyEl = btn.data('quantity-source');
            var quantity = 1;
            if (qtyEl) {
                var q = parseInt($(qtyEl).text(), 10);
                if (!isNaN(q) && q > 0) quantity = q;
            }
            if (typeof window.StoreCart !== 'undefined' && window.StoreCart.add) {
                window.StoreCart.add(productId, quantity);
            }
        });
    });
})(jQuery);
