<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

// Halaman utama publik
Route::get('/', function () {
    return view('landing.index');
});

// Route yang hanya bisa diakses kalau sudah login
Route::middleware(['auth'])->group(function () {

    // Route khusus admin (middleware role:admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('nasabah', NasabahController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('pengajuan', PengajuanController::class);
    });

    // Route khusus nasabah (middleware role:nasabah)
    Route::middleware('role:nasabah')->group(function () {
        Route::get('dashboard', function () {
            return view('nasabah.dashboard');
        })->name('nasabah.dashboard');

        Route::resource('pengajuan', PengajuanController::class)->only([
            'index',
            'create',
            'store',
            'show'
        ]);
    });
});

// Route auth default (login, register, logout) biasanya sudah ada kalau pake Laravel Breeze, Jetstream, dsb.
