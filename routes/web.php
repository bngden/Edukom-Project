<?php

use App\Http\Controllers\Web\BerandaController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PasswordController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/beranda');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:login')->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/beranda', BerandaController::class)->name('beranda');
    Route::get('/akun/kata-sandi', [PasswordController::class, 'edit'])->name('akun.kata-sandi');
    Route::put('/akun/kata-sandi', [PasswordController::class, 'update'])->name('akun.kata-sandi.update');
});
