<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\TrackVisits;

// Include admin routes
require __DIR__ . '/admin.php';

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
Route::middleware(['auth', 'web', TrackVisits::class])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        // Redirect based on role
        if ($user->role == 'admin') {
            // Get dashboard data for admin
            $totalVisitors = \App\Models\Visit::distinct('user_id')->count('user_id');
            $totalVisits = \App\Models\Visit::count();
            
            // Pengunjung bulan ini
            $visitorsThisMonth = \App\Models\Visit::whereYear('visited_at', now()->year)
                ->whereMonth('visited_at', now()->month)
                ->distinct('user_id')
                ->count('user_id');
            
            $visitorGrowth = $totalVisitors > 0 ? round(($visitorsThisMonth / $totalVisitors) * 100, 1) : 0;
            
            // Residents (users with role 'user')
            $registeredResidents = \App\Models\User::where('role', 'user')->count();
            $newResidentsThisMonth = \App\Models\User::where('role', 'user')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();
            $residentGrowth = $registeredResidents > 0 ? round(($newResidentsThisMonth / $registeredResidents) * 100, 1) : 0;
            
            // Pengajuan Surat
            $totalPengajuan = \App\Models\PengajuanSurat::count();
            $approvedPengajuan = \App\Models\PengajuanSurat::where('status', 'approved')->count();
            $pengajuanApprovalRate = $totalPengajuan > 0 ? round(($approvedPengajuan / $totalPengajuan) * 100, 1) : 0;
            
            // Berita/Pengumuman
            $totalBerita = \App\Models\Pengaduan::count();
            $pendingBerita = \App\Models\Pengaduan::where('status', 'pending')->count();

            return view('dashboard', compact(
                'totalVisitors',
                'visitorsThisMonth',
                'visitorGrowth',
                'registeredResidents',
                'newResidentsThisMonth',
                'residentGrowth',
                'totalPengajuan',
                'pengajuanApprovalRate',
                'totalBerita',
                'pendingBerita',
                'user'
            ));
        } else {
            // For regular users - show user dashboard
            return view('user.dashboard', compact('user'));
        }
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/myprofile', [ProfileController::class, 'show'])->name('myprofile');
    Route::post('/myprofile', [ProfileController::class, 'update'])->name('myprofile.update');

    // User-facing public routes (view only)
    Route::get('/berita', function () {
        $berita = \App\Models\Berita::paginate(12);
        return view('user.berita', compact('berita'));
    })->name('berita.index');

    Route::get('/agenda', function () {
        $agenda = \App\Models\Agenda::paginate(12);
        return view('user.agenda', compact('agenda'));
    })->name('agenda.index');

    Route::get('/faq', function () {
        $faq = \App\Models\Faq::paginate(12);
        return view('user.faq', compact('faq'));
    })->name('faq.index');

    Route::get('/formulir', function () {
        $formulir = \App\Models\DownloadFormulir::paginate(12);
        return view('user.formulir', compact('formulir'));
    })->name('formulir.index');

    Route::get('/forum', function () {
        $forum = \App\Models\ForumDiskusi::where('status', 'dibuka')->paginate(12);
        return view('user.forum', compact('forum'));
    })->name('forum.index');

    Route::get('/kontak', function () {
        $kontak = \App\Models\KontakDesa::all();
        return view('user.kontak', compact('kontak'));
    })->name('kontak.index');

    // User routes
    Route::middleware(['cekRole:user'])->group(function () {
        // Biodata
        Route::get('/biodata', [BiodataController::class, 'index'])->name('user.biodata');
        Route::get('/biodata/edit', [BiodataController::class, 'edit'])->name('user.biodata.edit');
        Route::post('/biodata/update', [BiodataController::class, 'updateBiodata'])->name('user.biodata.update');
        
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
            Route::get('/{surat}/print', [PengajuanSuratController::class, 'printSurat'])->name('print');
            Route::get('/{surat}/download', [PengajuanSuratController::class, 'downloadSurat'])->name('download');
            Route::get('/{surat}/download-pdf', [PengajuanSuratController::class, 'downloadPdf'])->name('downloadPdf');
            Route::get('/{surat}/print', [PengajuanSuratController::class, 'printSurat'])->name('print');
        });
    });

    // Admin routes
    Route::middleware(['cekRole:admin'])->group(function () {
        // Data Penduduk Management
        Route::prefix('admin/data-penduduk')->name('admin.data-penduduk.')->group(function () {
            Route::get('/', [DataPendudukController::class, 'index'])->name('index');
            Route::get('/create', [DataPendudukController::class, 'create'])->name('create');
            Route::post('/', [DataPendudukController::class, 'store'])->name('store');
            Route::get('/{resident}', [DataPendudukController::class, 'show'])->name('show');
            Route::get('/{resident}/edit', [DataPendudukController::class, 'edit'])->name('edit');
            Route::put('/{resident}', [DataPendudukController::class, 'update'])->name('update');
            Route::delete('/{resident}', [DataPendudukController::class, 'destroy'])->name('destroy');
            Route::get('/export/csv', [DataPendudukController::class, 'export'])->name('export');
        });

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
            Route::get('/{surat}/download-pdf', [PengajuanSuratController::class, 'adminDownloadPdf'])->name('downloadPdf');
            Route::get('/{surat}/print', [PengajuanSuratController::class, 'printSurat'])->name('print');
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

        // Temporary debug route to inspect kelahiran schema and latest row (remove after debugging)
        Route::get('/_debug/kelahiran', function () {
            // Only allow on local or when app.debug is enabled
            if (!app()->environment('local') && !config('app.debug')) {
                abort(404);
            }

            $hasIbuNama = \Illuminate\Support\Facades\Schema::hasColumn('kelahiran', 'ibu_nama');
            $hasAyahNama = \Illuminate\Support\Facades\Schema::hasColumn('kelahiran', 'ayah_nama');
            $hasTempatLahir = \Illuminate\Support\Facades\Schema::hasColumn('kelahiran', 'tempat_lahir');
            $latest = \App\Models\Kelahiran::latest()->first();

            return response()->json([
                'has_columns' => [
                    'ibu_nama' => $hasIbuNama,
                    'ayah_nama' => $hasAyahNama,
                    'tempat_lahir' => $hasTempatLahir,
                ],
                'latest_kelahiran' => $latest,
            ]);
        });
    });
});