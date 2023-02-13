<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;



// Route::get('/', function () {
//     return view('welcome');
// })->name('admin');

// To Check Admin Login
Route::middleware(['auth', 'CheckAdmin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.index');
    });



    // -------------------------- Route For Seeting Admin -------------------------- //
    Route::get('Settings' , [SettingController::class , 'index'])->name('Settings');
    Route::get('Admin.Settings.Update' , [SettingController::class , 'update'])->name('admin.settings.update');








});




require __DIR__.'/auth.php';
