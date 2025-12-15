<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\KartuKeluargaController;
use App\Http\Controllers\Admin\MigrasiController;
use App\Http\Controllers\Admin\KelahiranController;
use App\Http\Controllers\Admin\KematianController;
use App\Http\Controllers\Admin\ForumDiskusiController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\KontakDesaController;
use App\Models\Penduduk;

// Route Model Binding
Route::model('penduduk', Penduduk::class);

Route::middleware(['auth', 'cekRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Penduduk Management - with custom bind untuk NIK
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/penduduk/{penduduk}', [PendudukController::class, 'show'])->name('penduduk.show')->where('penduduk', '[0-9]+');
    Route::get('/penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit')->where('penduduk', '[0-9]+');
    Route::put('/penduduk/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update')->where('penduduk', '[0-9]+');
    Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy')->where('penduduk', '[0-9]+');

    // Surat Management
    Route::resource('surat', SuratController::class);

    // Berita Management (removed)
    // Redirect any legacy berita routes to kegiatan index to avoid 404s
    Route::any('berita/{any?}', function () {
        return redirect()->route('admin.kegiatan.index');
    })->where('any', '.*');

    // Agenda Management
    Route::resource('agenda', AgendaController::class);

    // Kartu Keluarga Management
    Route::resource('kartu_keluarga', KartuKeluargaController::class);

    // Migrasi Management
    Route::resource('migrasi', MigrasiController::class);

    // Kelahiran Management
    Route::resource('kelahiran', KelahiranController::class);

    // Kematian Management
    Route::resource('kematian', KematianController::class);

    // Forum Diskusi Management
    Route::resource('forum', ForumDiskusiController::class);

    // FAQ Management
    Route::resource('faq', FaqController::class);

    // Download Formulir Management (removed)

    // Kontak Desa Management
    Route::resource('kontak', KontakDesaController::class);

    // Redirect old URLs to Kegiatan index to avoid broken links
    Route::any('permohonan_layanan/{any?}', function () {
        return redirect()->route('admin.kegiatan.index');
    })->where('any', '.*');

    Route::any('program/{any?}', function () {
        return redirect()->route('admin.kegiatan.index');
    })->where('any', '.*');
});
