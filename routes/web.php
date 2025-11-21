<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;

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
Route::middleware(['guest'])->group(
    function () {
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
    }
);


// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', function () {
        return view('myprofile');
    });

    // Admin routes
    Route::middleware(['cekRole:admin'])->group(function () {

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
    });

    // User routes
    Route::middleware(['cekRole:user'])->group(function () {

        Route::get('/biodata',  [BiodataController::class, 'index'])->name('user.biodata');
        Route::get('/dokumen', function () {
            return view('user.dokumen');
        })->name('user.dokumen');
        Route::get('/status', function () {
            return view('user.status');
        })->name('user.status');
        Route::get('/daftar-ulang', function () {
            return view('user.daftar_ulang');
        })->name('user.daftar_ulang');
    });
});
// User routes (dalam middleware auth dan cekRole:user)
Route::middleware(['cekRole:user'])->group(function () {
    // ... routes yang sudah ada ...
    
    // Pengaduan Routes
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('user.pengaduan.index');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('user.pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('user.pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('user.pengaduan.show');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('user.pengaduan.destroy');
});

// Admin routes (dalam middleware auth dan cekRole:admin)
Route::middleware(['cekRole:admin'])->group(function () {
    // ... routes yang sudah ada ...
    
    // Pengaduan Management Routes
    Route::get('/admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.pengaduan.index');
    Route::get('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminShow'])->name('admin.pengaduan.show');
    Route::put('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminUpdate'])->name('admin.pengaduan.update');
    Route::delete('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminDestroy'])->name('admin.pengaduan.destroy');
});
use App\Http\Controllers\PengajuanSuratController;

// ... kode sebelumnya ...

// User routes (dalam middleware auth dan cekRole:user)
Route::middleware(['cekRole:user'])->group(function () {
    // ... routes yang sudah ada ...
    
    // Pengajuan Surat Routes
    Route::get('/surat', [PengajuanSuratController::class, 'index'])->name('user.surat.index');
    Route::get('/surat/create', [PengajuanSuratController::class, 'create'])->name('user.surat.create');
    Route::post('/surat', [PengajuanSuratController::class, 'store'])->name('user.surat.store');
    Route::get('/surat/{surat}', [PengajuanSuratController::class, 'show'])->name('user.surat.show');
    Route::delete('/surat/{surat}', [PengajuanSuratController::class, 'destroy'])->name('user.surat.destroy');
    Route::get('/surat/{surat}/download', [PengajuanSuratController::class, 'downloadSurat'])->name('user.surat.download');
});

// Admin routes (dalam middleware auth dan cekRole:admin)
Route::middleware(['cekRole:admin'])->group(function () {
    // ... routes yang sudah ada ...
    
    // Kelola Pengajuan Surat Routes
    Route::get('/admin/surat', [PengajuanSuratController::class, 'adminIndex'])->name('admin.surat.index');
    Route::get('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminShow'])->name('admin.surat.show');
    Route::put('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminUpdate'])->name('admin.surat.update');
    Route::delete('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminDestroy'])->name('admin.surat.destroy');
    Route::get('/admin/surat/{surat}/download', [PengajuanSuratController::class, 'adminDownloadSurat'])->name('admin.surat.download');
});
// Tambahkan di bagian atas file (setelah use yang sudah ada)

// Tambahkan di dalam Route::middleware(['cekRole:admin'])
Route::get('/admin/surat', [PengajuanSuratController::class, 'adminIndex'])->name('admin.surat.index');
Route::get('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminShow'])->name('admin.surat.show');
Route::put('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminUpdate'])->name('admin.surat.update');
Route::delete('/admin/surat/{surat}', [PengajuanSuratController::class, 'adminDestroy'])->name('admin.surat.destroy');
Route::get('/admin/surat/{surat}/download', [PengajuanSuratController::class, 'adminDownloadSurat'])->name('admin.surat.download');

// Tambahkan di dalam Route::middleware(['cekRole:user'])
Route::get('/surat', [PengajuanSuratController::class, 'index'])->name('user.surat.index');
Route::get('/surat/create', [PengajuanSuratController::class, 'create'])->name('user.surat.create');
Route::post('/surat', [PengajuanSuratController::class, 'store'])->name('user.surat.store');
Route::get('/surat/{surat}', [PengajuanSuratController::class, 'show'])->name('user.surat.show');
Route::delete('/surat/{surat}', [PengajuanSuratController::class, 'destroy'])->name('user.surat.destroy');
Route::get('/surat/{surat}/download', [PengajuanSuratController::class, 'downloadSurat'])->name('user.surat.download');