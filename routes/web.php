<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QrAbsenController;
use App\Http\Controllers\LocationHistoryController;


Route::get('/', function () {
    return view('pages.auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('qr_absens', QrAbsenController::class);
    Route::resource('location-histories', LocationHistoryController::class)->middleware('auth');
    Route::delete('qr_absens-destroy-all', [QrAbsenController::class, 'destroyAll'])->name('qr_absens.destroyAll');
    Route::get('/qr-absens/{id}/download', [QrAbsenController::class, 'downloadPDF'])->name('qr_absens.download');
    Route::delete('location-histories-destroy-all', [LocationHistoryController::class, 'destroyAll'])->name('location-histories.destroyAll');
    Route::get('luar_area/laporan_range', [LocationHistoryController::class, 'outOfRangeReport'])->name('location-histories.out-of-range');

});
