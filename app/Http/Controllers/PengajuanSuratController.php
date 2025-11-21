<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    // ==================== USER METHODS ====================
    
    public function index()
    {
        $pengajuans = PengajuanSurat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Statistik untuk user
        $stats = [
            'total' => PengajuanSurat::where('user_id', Auth::id())->count(),
            'pending' => PengajuanSurat::where('user_id', Auth::id())->where('status', 'Pending')->count(),
            'diproses' => PengajuanSurat::where('user_id', Auth::id())->where('status', 'Diproses')->count(),
            'disetujui' => PengajuanSurat::where('user_id', Auth::id())->where('status', 'Disetujui')->count(),
        ];
        
        return view('user.surat.index', compact('pengajuans', 'stats'));
    }

    public function create()
    {
        return view('user.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:Surat Keterangan Siswa,Surat Izin,Surat Rekomendasi,Surat Keterangan Lulus,Surat Pindah Sekolah,Surat Keterangan Aktif Kuliah,Lainnya',
            'keperluan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'keperluan.required' => 'Keperluan harus diisi',
            'file_pendukung.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
            'file_pendukung.max' => 'Ukuran file maksimal 2MB'
        ]);

        $data = $request->except('file_pendukung');
        $data['user_id'] = Auth::id();
        $data['nomor_pengajuan'] = PengajuanSurat::generateNomorPengajuan();
        $data['status'] = 'Pending';

        // Handle file upload
        if ($request->hasFile('file_pendukung')) {
            $file = $request->file('file_pendukung');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('surat/pendukung', $filename, 'public');
            $data['file_pendukung'] = $filename;
        }

        PengajuanSurat::create($data);

        return redirect()->route('user.surat.index')
            ->with('success', 'Pengajuan surat berhasil diajukan dengan nomor: ' . $data['nomor_pengajuan']);
    }

    public function show(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa melihat pengajuannya sendiri
        if ($surat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.surat.show', compact('surat'));
    }

    public function destroy(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa menghapus pengajuannya sendiri
        if ($surat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dihapus jika status masih Pending
        if ($surat->status !== 'Pending') {
            return back()->withErrors(['error' => 'Pengajuan surat yang sudah diproses tidak dapat dihapus']);
        }

        // Hapus file jika ada
        if ($surat->file_pendukung) {
            Storage::disk('public')->delete('surat/pendukung/' . $surat->file_pendukung);
        }

        $surat->delete();

        return redirect()->route('user.surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus');
    }

    public function downloadSurat(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa download suratnya sendiri
        if ($surat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan surat sudah disetujui dan file ada
        if ($surat->status !== 'Disetujui' || !$surat->file_surat) {
            return back()->withErrors(['error' => 'Surat belum tersedia untuk didownload']);
        }

        $filePath = storage_path('app/public/surat/hasil/' . $surat->file_surat);
        
        if (!file_exists($filePath)) {
            return back()->withErrors(['error' => 'File surat tidak ditemukan']);
        }

        return response()->download($filePath, $surat->file_surat);
    }

    // ==================== ADMIN METHODS ====================
    
    public function adminIndex(Request $request)
    {
        $query = PengajuanSurat::with(['user', 'admin'])->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_pengajuan', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $pengajuans = $query->paginate(15);
        
        // Statistik
        $stats = [
            'total' => PengajuanSurat::count(),
            'pending' => PengajuanSurat::where('status', 'Pending')->count(),
            'diproses' => PengajuanSurat::where('status', 'Diproses')->count(),
            'disetujui' => PengajuanSurat::where('status', 'Disetujui')->count(),
            'ditolak' => PengajuanSurat::where('status', 'Ditolak')->count(),
        ];

        return view('admin.surat.index', compact('pengajuans', 'stats'));
    }

    public function adminShow(PengajuanSurat $surat)
    {
        $surat->load(['user', 'admin']);
        return view('admin.surat.show', compact('surat'));
    }

    public function adminUpdate(Request $request, PengajuanSurat $surat)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Disetujui,Ditolak',
            'catatan_admin' => 'nullable|string',
            'file_surat' => 'nullable|file|mimes:pdf|max:5120'
        ], [
            'status.required' => 'Status harus dipilih',
            'file_surat.mimes' => 'File surat harus berformat PDF',
            'file_surat.max' => 'Ukuran file maksimal 5MB'
        ]);

        $data = [
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'admin_id' => Auth::id()
        ];

        // Update tanggal berdasarkan status
        if ($request->status === 'Diproses' && $surat->status === 'Pending') {
            $data['tanggal_diproses'] = now();
        }

        if ($request->status === 'Disetujui' || $request->status === 'Ditolak') {
            $data['tanggal_selesai'] = now();
        }

        // Handle file surat upload (untuk status disetujui)
        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($surat->file_surat) {
                Storage::disk('public')->delete('surat/hasil/' . $surat->file_surat);
            }

            $file = $request->file('file_surat');
            $filename = 'SURAT_' . $surat->nomor_pengajuan . '_' . time() . '.pdf';
            $file->storeAs('surat/hasil', $filename, 'public');
            $data['file_surat'] = $filename;
        }

        $surat->update($data);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Status pengajuan surat berhasil diperbarui');
    }

    public function adminDestroy(PengajuanSurat $surat)
    {
        // Hapus file jika ada
        if ($surat->file_pendukung) {
            Storage::disk('public')->delete('surat/pendukung/' . $surat->file_pendukung);
        }
        if ($surat->file_surat) {
            Storage::disk('public')->delete('surat/hasil/' . $surat->file_surat);
        }

        $surat->delete();

        return redirect()->route('admin.surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus');
    }

    public function adminDownloadSurat(PengajuanSurat $surat)
    {
        if (!$surat->file_surat) {
            return back()->withErrors(['error' => 'File surat tidak ditemukan']);
        }

        $filePath = storage_path('app/public/surat/hasil/' . $surat->file_surat);
        
        if (!file_exists($filePath)) {
            return back()->withErrors(['error' => 'File surat tidak ditemukan']);
        }

        return response()->download($filePath, $surat->file_surat);
    }
}
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