/**
 * Store filters - AJAX instant filter for categories and price
 */
(function ($) {
    'use strict';

    var $main = $('#store-main');
    var filterUrl = $main.data('filter-url');
    if (!filterUrl) return;

    var state = {
        category: $main.data('category') || '',
        max_price: parseInt($('#price-range').val(), 10) || '',
        sort: $('#store-sort').val() || 'newest',
        page: 1,
        q: $main.data('search') || '',
    };

    var showingText = $('#store-showing-text').data('template') || null;
    var showingTemplate = 'عرض {from}-{to} من أصل {total} منتج';

    function getState() {
        state.max_price = parseInt($('#price-range').val(), 10) || $('#store-sidebar').data('max-price') || 1500;
        state.sort = $('#store-sort').val() || 'newest';
        return state;
    }

    function updateShowingText(from, to, total) {
        var el = document.getElementById('store-showing-text');
        if (!el) return;
        var tpl = el.getAttribute('data-tpl') || 'عرض {from}-{to} من أصل {total} منتج';
        el.textContent = tpl.replace('{from}', from).replace('{to}', to).replace('{total}', total);
    }

    function runFilter(page) {
        if (page) state.page = page;
        getState();

        var params = {
            category: state.category,
            max_price: state.max_price,
            sort: state.sort,
            page: state.page,
            q: state.q || undefined,
        };

        var $wrapper = $('#store-products-wrapper');
        $wrapper.css('opacity', '0.6').css('pointer-events', 'none');

        $.get(filterUrl, params)
            .done(function (res) {
                if (res && res.html) {
                    $wrapper.html(res.html);
                    if (res.from !== undefined && res.to !== undefined && res.total !== undefined) {
                        updateShowingText(res.from || 0, res.to || 0, res.total || 0);
                    }
                    bindPagination();
                }
            })
            .fail(function () {
                $wrapper.css('opacity', '1').css('pointer-events', '');
            })
            .always(function () {
                $wrapper.css('opacity', '1').css('pointer-events', '');
            });
    }

    function bindPagination() {
        $(document).off('click.storefilter', '.store-filter-pagination');
        $(document).on('click.storefilter', '.store-filter-pagination', function (e) {
            e.preventDefault();
            var page = $(this).data('page');
            if (page) runFilter(page);
        });
    }

    function setActiveCategory(cat) {
        state.category = cat;
        $('.store-filter-category').removeClass('bg-primarys text-white font-medium').addClass('hover:bg-primarys/10');
        $('.store-filter-category').find('.store-cat-count').removeClass('opacity-70').addClass('text-slate-500');
        var $active = $('.store-filter-category[data-category="' + (cat || '') + '"]');
        $active.addClass('bg-primarys text-white font-medium').removeClass('hover:bg-primarys/10');
        $active.find('.store-cat-count').addClass('opacity-70').removeClass('text-slate-500');
    }

    $(function () {
        var initialCategory = (function () {
            var m = /[?&]category=([^&]+)/.exec(window.location.search);
            return m ? decodeURIComponent(m[1]) : '';
        })();
        var initialSearch = (function () {
            var m = /[?&]q=([^&]+)/.exec(window.location.search);
            return m ? decodeURIComponent(m[1]) : '';
        })();
        if (initialCategory) {
            setActiveCategory(initialCategory);
            state.category = initialCategory;
        }
        if (initialSearch) state.q = initialSearch;


        $('.store-filter-category').on('click', function (e) {
            e.preventDefault();
            var cat = $(this).data('category') || '';
            setActiveCategory(cat);
            state.page = 1;
            runFilter(1);
        });

        var priceTimeout;
        $('#price-range').on('input change', function () {
            var val = $(this).val();
            $('#price-range-value').text(val + ' ' + (window.STORE_CURRENCY_LABEL || 'شيكل'));
            clearTimeout(priceTimeout);
            priceTimeout = setTimeout(function () {
                state.max_price = parseInt(val, 10);
                state.page = 1;
                runFilter(1);
            }, 300);
        });

        $('#store-sort').on('change', function () {
            state.sort = $(this).val();
            state.page = 1;
            runFilter(1);
        });

        bindPagination();
    });
})(jQuery);
