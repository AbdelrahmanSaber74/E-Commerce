<?php

use App\Http\Controllers\Dashboard\CategorieController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;



// To Check Admin Login
Route::middleware(['auth', 'CheckAdmin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.index');
    });



    // -------------------------- Route For Seeting Admin -------------------------- //
    Route::get('Settings' , [SettingController::class , 'index'])->name('Settings');
    Route::get('Admin.Settings.Update' , [SettingController::class , 'update'])->name('admin.settings.update');


    // -------------------------- Route For Categories  Admin -------------------------- //
    Route::resource('Category' , CategorieController::class);

    // -------------------------- Route For Product  Admin -------------------------- //
    Route::resource('Products' , ProductController::class);




});




require __DIR__.'/auth.php';
