<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('front.index');

// Language Switcher Route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Social Auth Routes
Route::get('auth/{provider}', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirectToProvider'])->name('social.login');
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'handleCallback']);
Route::post('/currency/switch', [App\Http\Controllers\CurrencyController::class, 'switch'])->name('currency.switch');

// To Check User Login
Route::middleware(['auth', 'CheckUser', 'SetLocale'])->group(function () {

    Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('dashboard');
    Route::get('/product/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'show'])->name('product.show');

    // Cart Routes
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/coupon', [App\Http\Controllers\CartController::class, 'applyCoupon'])->name('cart.coupon');

    // Wishlist Routes
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{productId}', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout Routes
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout' , [CheckoutController::class , 'store'])->name('checkout.store')->middleware('throttle:checkout');
    Route::get('/checkout/success/{id}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('orders.success');

    // Account Routes
    Route::get('/account/orders', [App\Http\Controllers\Frontend\AccountController::class, 'orders'])->name('account.orders');
});

require __DIR__.'/auth.php';
