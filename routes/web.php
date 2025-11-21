<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengajuanSuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact-us', function () {
    return view('contact');
});

Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');

// Route yang hanya bisa diakses oleh user yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');

    // Request reset link
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

    // Reset password form
    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', function () {
        return view('myprofile');
    })->name('myprofile');

    // User routes
    Route::middleware(['cekRole:user'])->group(function () {
        // Biodata
        Route::get('/biodata', [BiodataController::class, 'index'])->name('user.biodata');
        
        // Dokumen
        Route::get('/dokumen', function () {
            return view('user.dokumen');
        })->name('user.dokumen');
        
        // Status
        Route::get('/status', function () {
            return view('user.status');
        })->name('user.status');
        
        // Daftar Ulang - DIPERBAIKI: gunakan controller
        Route::get('/pengajuan', [PengajuanSuratController::class, 'index'])->name('user.pengajuan.index');

        // Pengaduan Routes - USER
        Route::prefix('pengaduan')->name('user.pengaduan.')->group(function () {
            Route::get('/', [PengaduanController::class, 'index'])->name('index');
            Route::get('/create', [PengaduanController::class, 'create'])->name('create');
            Route::post('/', [PengaduanController::class, 'store'])->name('store');
            Route::get('/{pengaduan}', [PengaduanController::class, 'show'])->name('show');
            Route::delete('/{pengaduan}', [PengaduanController::class, 'destroy'])->name('destroy');
        });

        // Pengajuan Surat Routes - USER
        Route::prefix('surat')->name('user.surat.')->group(function () {
            Route::get('/', [PengajuanSuratController::class, 'index'])->name('index');
            Route::get('/create', [PengajuanSuratController::class, 'create'])->name('create');
            Route::post('/', [PengajuanSuratController::class, 'store'])->name('store');
            Route::get('/{surat}', [PengajuanSuratController::class, 'show'])->name('show');
            Route::delete('/{surat}', [PengajuanSuratController::class, 'destroy'])->name('destroy');
            Route::get('/{surat}/download', [PengajuanSuratController::class, 'downloadSurat'])->name('download');
        });
    });

    // Admin routes
    Route::middleware(['cekRole:admin'])->group(function () {
        // Dashboard Admin
        Route::get('/verifikasi', function () {
            return view('admin.verifikasi');
        })->name('admin.verifikasi');
        
        Route::get('/seleksi', function () {
            return view('admin.seleksi');
        })->name('admin.seleksi');
        
        Route::get('/pengumuman', function () {
            return view('admin.pengumuman');
        })->name('admin.pengumuman');
        
        Route::get('/laporan', function () {
            return view('admin.laporan');
        })->name('admin.laporan');

        // Pengajuan Surat Management Routes - ADMIN - DIPERBAIKI
        Route::prefix('admin/pengajuan')->name('admin.pengajuan.')->group(function () {
            Route::get('/', [PengajuanSuratController::class, 'adminIndex'])->name('index');
            Route::get('/{surat}', [PengajuanSuratController::class, 'adminShow'])->name('show');
            Route::put('/{surat}', [PengajuanSuratController::class, 'adminUpdate'])->name('update');
            Route::delete('/{surat}', [PengajuanSuratController::class, 'adminDestroy'])->name('destroy');
            Route::get('/{surat}/download', [PengajuanSuratController::class, 'adminDownloadSurat'])->name('download');
        });

        // Pengaduan Management Routes - ADMIN
        Route::prefix('admin/pengaduan')->name('admin.pengaduan.')->group(function () {
            Route::get('/', [PengaduanController::class, 'adminIndex'])->name('index');
            Route::get('/{pengaduan}', [PengaduanController::class, 'adminShow'])->name('show');
            Route::put('/{pengaduan}', [PengaduanController::class, 'adminUpdate'])->name('update');
            Route::delete('/{pengaduan}', [PengaduanController::class, 'adminDestroy'])->name('destroy');
        });

        // Pengajuan Surat Management Routes - ADMIN (untuk route /admin/surat)
        Route::prefix('admin/surat')->name('admin.surat.')->group(function () {
            Route::get('/', [PengajuanSuratController::class, 'adminIndex'])->name('index');
            Route::get('/{surat}', [PengajuanSuratController::class, 'adminShow'])->name('show');
            Route::put('/{surat}', [PengajuanSuratController::class, 'adminUpdate'])->name('update');
            Route::delete('/{surat}', [PengajuanSuratController::class, 'adminDestroy'])->name('destroy');
            Route::get('/{surat}/download', [PengajuanSuratController::class, 'adminDownloadSurat'])->name('download');
        });
    });
});