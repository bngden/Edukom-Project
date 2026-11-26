<?php

use App\Http\Controllers\Web\BerandaController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\Owner;
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
    Route::post('/notifikasi/baca-semua', [NotificationController::class, 'readAll'])->name('notifikasi.baca-semua');
    Route::post('/notifikasi/{id}/baca', [NotificationController::class, 'read'])->name('notifikasi.baca');
});

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/', Owner\BerandaController::class)->name('beranda');
    Route::get('/pengaturan/riwayat', Owner\RiwayatController::class)->name('riwayat');

    Route::scopeBindings()->prefix('kebijakan/parameter')->name('parameter')->controller(Owner\ParameterController::class)->group(function () {
        Route::get('/', 'index')->name('');
        Route::get('/{policyParameter:key}', 'show')->name('.show');
        Route::post('/{policyParameter:key}/versi', 'storeVersion')->name('.versions.store');
        Route::post('/{policyParameter:key}/versi/{version}/batal', 'cancelVersion')->name('.versions.cancel');
    });

    Route::scopeBindings()->prefix('kebijakan/komponen-honor')->name('komponen-honor')->controller(Owner\KomponenHonorController::class)->group(function () {
        Route::get('/', 'index')->name('');
        Route::post('/', 'store')->name('.store');
        Route::get('/{honorComponent}', 'show')->name('.show');
        Route::patch('/{honorComponent}', 'update')->name('.update');
        Route::post('/{honorComponent}/besaran', 'storeRate')->name('.rates.store');
        Route::post('/{honorComponent}/besaran/{rate}/batal', 'cancelRate')->name('.rates.cancel');
        Route::post('/{honorComponent}/tingkatan', 'storeTierSet')->name('.tier-sets.store');
        Route::post('/{honorComponent}/tingkatan/{tierSet}/batal', 'cancelTierSet')->name('.tier-sets.cancel');
        Route::post('/{honorComponent}/nonaktifkan', 'deactivate')->name('.deactivate');
        Route::post('/{honorComponent}/batal-nonaktif', 'cancelDeactivation')->name('.cancel-deactivation');
    });

    Route::prefix('kebijakan/alasan-penolakan')->name('alasan-penolakan')->controller(Owner\AlasanPenolakanController::class)->group(function () {
        Route::get('/', 'index')->name('');
        Route::post('/', 'store')->name('.store');
        Route::patch('/{leaveRejectionReason}', 'update')->name('.update');
        Route::post('/{leaveRejectionReason}/naik', 'moveUp')->name('.up');
        Route::post('/{leaveRejectionReason}/turun', 'moveDown')->name('.down');
        Route::post('/{leaveRejectionReason}/nonaktifkan', 'deactivate')->name('.deactivate');
        Route::post('/{leaveRejectionReason}/aktifkan', 'activate')->name('.activate');
        Route::delete('/{leaveRejectionReason}', 'destroy')->name('.destroy');
    });

    Route::get('/kebijakan/masa-simpan', [Owner\MasaSimpanController::class, 'index'])->name('masa-simpan');
    Route::post('/kebijakan/masa-simpan/uji', [Owner\MasaSimpanController::class, 'dryRun'])->name('masa-simpan.dry-run');
});
