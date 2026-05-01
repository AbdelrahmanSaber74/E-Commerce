<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;



// To Check Admin Login
Route::middleware(['auth', 'CheckAdmin', 'SetLocale'])->group(function () {

    Route::get('/admin', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('admin');



    // -------------------------- Route For Seeting Admin -------------------------- //
    Route::get('Settings' , [SettingController::class , 'index'])->name('Settings');
    Route::get('Admin.Settings.Update' , [SettingController::class , 'update'])->name('admin.settings.update');


    // -------------------------- Route For Categories  Admin -------------------------- //
    Route::resource('Category' , CategoryController::class);

    // -------------------------- Route For Product  Admin -------------------------- //
    Route::resource('Products' , ProductController::class);

    // -------------------------- Route For Orders Admin -------------------------- //
    Route::get('Orders' , [OrderController::class , 'index'])->name('orders.index');
    Route::get('Orders/{id}' , [OrderController::class , 'show'])->name('orders.show');
    Route::post('Orders/UpdateStatus/{id}' , [OrderController::class , 'updateStatus'])->name('orders.updateStatus');
    Route::resource('Coupons' , \App\Http\Controllers\Dashboard\CouponController::class);




});




require __DIR__.'/auth.php';
