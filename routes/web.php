<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Rute untuk pengguna yang terautentikasi
Route::group(['middleware' => 'auth'], function () {
    // Rute untuk halaman beranda
    Route::get('/', [DashboardController::class, 'index'])->name('beranda');
    // Rute resource untuk assets
    Route::resource('assets', AssetController::class);

    // Rute tambahan untuk asset
    Route::prefix('assets')->group(function () {
        // Menampilkan formulir untuk memperbarui aset
        Route::get('{id}/perbarui', [AssetController::class, 'perbarui'])->name('assets.perbarui');

        // Rute khusus untuk memperbarui gambar
        Route::post('{id}/update-gambar', [AssetController::class, 'updateGambar'])->name('assets.updateGambar');

        // Rute untuk menyimpan gambar baru
        Route::post('/simpan-gambar/{id}', [AssetController::class, 'simpanGambar'])->name('assets.simpanGambar');

        // Rute untuk merestore data yang dihapus
        Route::post('restore/{id}', [AssetController::class, 'restore'])->name('assets.restore');



    });

    // Rute untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', KategoriController::class);

    });

// Rute untuk pengguna tamu
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit'); // Menambahkan name untuk rute login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rute untuk meminta reset password
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Rute untuk mengatur ulang password
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Rute untuk menampilkan form reset password
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Rute untuk melakukan reset password
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
