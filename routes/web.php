<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Website\StoreController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Cp\StoreOrderController;
use App\Http\Controllers\Cp\StoreProductController;
use App\Http\Controllers\Cp\StoreCategoryController;

// مسارات الموقع الأمامي
$localizedMiddleware = ['locale.from.url', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'];

// تبديل اللغة (Session-based)
Route::get('/locale/switch/{locale}', function (string $locale) {
    $locale = strtolower($locale);
    if (!in_array($locale, ['ar', 'en'], true)) {
        return redirect()->back();
    }
    session(['locale' => $locale]);
    session()->save();
    return redirect()->back();
})->name('locale.switch');

// المتجر (الواجهة الأمامية)
Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/filter', [StoreController::class, 'filter'])->name('store.filter');
Route::get('/product/{slug}', [StoreController::class, 'show'])->name('store.product.show');
Route::get('/store/search', [StoreController::class, 'search'])->name('store.search');

// سلة المشتريات (AJAX)
Route::get('/cart', [CartController::class, 'index'])->name('store.cart');
Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('store.cart.buy-now');
Route::get('/checkout/complete', [CartController::class, 'completePurchase'])->name('store.checkout.complete');
Route::post('/checkout/complete', [CartController::class, 'completePurchaseSubmit'])->name('store.checkout.complete.submit');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('store.checkout');
Route::get('/checkout/success/{id?}', [CartController::class, 'checkoutSuccess'])->name('store.checkout.success');
Route::post('/cart/add', [CartController::class, 'add'])->name('store.cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('store.cart.count');
Route::get('/cart/items', [CartController::class, 'items'])->name('store.cart.items');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('store.cart.remove');

// لوحة التحكم — منتجات المتجر
Route::prefix('cp')->name('cp.')->group(function () {
    Route::resource('store/products', StoreProductController::class)->parameters(['store/products' => 'store_product'])->names('store.products');
    Route::resource('store/categories', StoreCategoryController::class)->except(['create', 'edit', 'show'])->parameters(['store/categories' => 'store_category'])->names('store.categories');
    Route::get('store/orders', [StoreOrderController::class, 'index'])->name('store.orders.index');
    Route::get('store/orders/{order}', [StoreOrderController::class, 'show'])->name('store.orders.show');
    Route::post('store/orders/{order}/status', [StoreOrderController::class, 'updateStatus'])->name('store.orders.status');
});

Route::get('storage/{file}', function ($file) {
    $path = storage_path('app/public/' . $file);
    if (!is_file($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('file', '.+');
