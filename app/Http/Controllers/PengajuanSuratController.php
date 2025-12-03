<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Builder awal: hanya data milik user yang login
        $query = PengajuanSurat::where('user_id', $user->id)->latest();

        // Filter oleh status jika diberikan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter oleh jenis surat jika diberikan
        if ($request->filled('jenis_surat')) {
            // Jika nilai filter berbentuk angka => anggap itu ID jenis_surat
            if (is_numeric($request->jenis_surat)) {
                $query->where('jenis_surat_id', $request->jenis_surat);
            } else {
                // Fallback: beberapa data lama menyimpan jenis sebagai teks
                $query->where('jenis_surat', $request->jenis_surat);
            }
        }

        // Pencarian teks: nomor pengajuan, keperluan atau jenis surat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_pengajuan', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%")
                  ->orWhere('jenis_surat', 'like', "%{$search}%");
            });
        }

        // Ambil daftar jenis surat untuk filter dropdown
        $jenisSurat = JenisSurat::orderBy('nama_surat')->get();

        // Ambil hasil dengan pagination dan pertahankan query string
        $pengajuans = $query->paginate(10)->withQueryString();

        // Statistik (total untuk user, tidak terpengaruh filter)
        $stats = [
            'total' => PengajuanSurat::where('user_id', $user->id)->count(),
            'pending' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Pending')->count(),
            'diproses' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Diproses')->count(),
            'disetujui' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Disetujui')->count(),
        ];

        return view('user.pengajuan.index', compact('pengajuans', 'stats', 'jenisSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil daftar jenis surat dari tabel `jenis_surat` sehingga admin dapat
        // mengelolanya tanpa mengubah kode. Jika tabel kosong fallback ke array
        // statis agar form tetap berfungsi.
        $jenisSurat = JenisSurat::orderBy('nama_surat')->get();

        if ($jenisSurat->isEmpty()) {
            $jenisSurat = collect([
                'Surat Keterangan Domisili',
                'Surat Keterangan Usaha',
                'Surat Keterangan Tidak Mampu',
                'Surat Keterangan Kelahiran',
                'Surat Keterangan Kematian',
                'Surat Pengantar',
                'Surat Keterangan Beda Nama',
                'Surat Keterangan Migrasi',
                'Surat Keterangan Lainnya'
            ]);
        }

        return view('user.pengajuan.create', compact('jenisSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|integer|exists:jenis_surat,id',
            'keperluan' => 'required|string|max:500',
            'keterangan' => 'nullable|string|max:1000',
            'file_lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'keperluan.required' => 'Keperluan harus diisi',
            'file_lampiran.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
            'file_lampiran.max' => 'Ukuran file maksimal 2MB'
        ]);

        // Generate nomor pengajuan
        $nomorPengajuan = 'SRT-' . date('Ymd') . '-' . Str::random(6);

        // Ambil nama jenis surat dari tabel untuk disimpan juga ke kolom string
        // agar kompatibel dengan fitur lama yang menggunakan teks.
        $jenis = JenisSurat::find($request->jenis_surat);

        $data = [
            'user_id' => Auth::id(),
            'nomor_pengajuan' => $nomorPengajuan,
            'jenis_surat_id' => $request->jenis_surat,
            'jenis_surat' => $jenis ? $jenis->nama_surat : null,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'status' => 'Pending',
        ];

        // Handle file upload
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pengajuan_surat', $filename, 'public');
            $data['file_lampiran'] = $filename;
        }

        PengajuanSurat::create($data);

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa melihat pengajuannya sendiri
        if ($surat->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.pengajuan.show', compact('surat'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa menghapus pengajuannya sendiri dan status masih pending
        if ($surat->user_id !== Auth::id() || $surat->status !== 'Pending') {
            abort(403);
        }

        // Hapus file lampiran jika ada
        if ($surat->file_lampiran) {
            Storage::disk('public')->delete('pengajuan_surat/' . $surat->file_lampiran);
        }

        $surat->delete();

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan surat berhasil dihapus!');
    }

    /**
     * Print/Preview surat yang sudah disetujui
     */
    public function printSurat(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa melihat suratnya sendiri dan status sudah disetujui
        if ($surat->user_id !== Auth::id() || $surat->status !== 'Disetujui') {
            abort(403);
        }

        return view('user.pengajuan.print', compact('surat'));
    }

    /**
     * Download surat yang sudah disetujui sebagai PDF
     */
    public function downloadSurat(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa mendownload suratnya sendiri dan status sudah disetujui
        if ($surat->user_id !== Auth::id() || $surat->status !== 'Disetujui') {
            abort(403);
        }

        // Generate nama file
        $filename = 'Surat-' . $surat->nomor_pengajuan . '-' . now()->format('Y-m-d') . '.pdf';
        
        // Return view yang bisa dicetak sebagai PDF
        return view('user.pengajuan.print', compact('surat'))
            ->render();
    }

    /**
     * Download surat sebagai HTML file
     */
    public function downloadPdf(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa mendownload suratnya sendiri
        if ($surat->user_id !== Auth::id()) {
            abort(403);
        }
        // Generate nama file (PDF preferred)
        $filename = 'Surat-' . $surat->nomor_pengajuan . '-' . now()->format('Y-m-d') . '.pdf';

        // Jika dompdf tersedia di app container, gunakan untuk generate PDF server-side
        try {
            if (app()->bound('dompdf.wrapper')) {
                $pdf = app('dompdf.wrapper');
                $pdf->loadView('user.pengajuan.print', compact('surat'));
                $pdf->setPaper('a4', 'portrait');
                return $pdf->download($filename);
            }

            // Fallback ke facade PDF jika tersedia
            if (class_exists('\Barryvdh\DomPDF\Facade\Pdf') || class_exists('PDF')) {
                $pdf = \PDF::loadView('user.pengajuan.print', compact('surat'));
                $pdf->setPaper('a4', 'portrait');
                return $pdf->download($filename);
            }
        } catch (\Exception $e) {
            // kalau gagal generate PDF, lanjut ke fallback HTML download
        }

        // Fallback: kembalikan HTML agar styling tetap utuh (user dapat save as PDF di browser)
        $filenameHtml = 'Surat-' . $surat->nomor_pengajuan . '-' . now()->format('Y-m-d') . '.html';
        $html = view('user.pengajuan.print', compact('surat'))->render();
        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filenameHtml . '"',
        ]);
    }

    /**
     * ADMIN METHODS
     */
    public function adminIndex()
    {
        $query = PengajuanSurat::with('user')->latest();

        // jika ada filter request (mis. status atau jenis), tetap bisa ditambahkan di masa depan
        $pengajuans = $query->paginate(10);

        // Statistik untuk kartu di atas
        $stats = [
            'total' => PengajuanSurat::count(),
            'pending' => PengajuanSurat::where('status', 'Pending')->count(),
            'diproses' => PengajuanSurat::where('status', 'Diproses')->count(),
            'disetujui' => PengajuanSurat::where('status', 'Disetujui')->count(),
            'ditolak' => PengajuanSurat::where('status', 'Ditolak')->count(),
        ];

        return view('admin.pengajuan.index', compact('pengajuans', 'stats'));
    }

    public function adminShow(PengajuanSurat $surat)
    {
        return view('admin.pengajuan.show', compact('surat'));
    }

    public function adminUpdate(Request $request, PengajuanSurat $surat)
    {
        // Validasi termasuk file_surat yang boleh diupload oleh admin (PDF, max 5MB)
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Disetujui,Ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
            'file_surat' => 'nullable|file|mimes:pdf|max:5120',
        ], [
            'file_surat.mimes' => 'File harus berformat PDF',
            'file_surat.max' => 'Ukuran file maksimal 5MB',
        ]);

        // Jika admin mengupload file final surat, simpan di storage/public/surat
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());

            // Hapus file lama bila ada
            if ($surat->file_surat) {
                Storage::disk('public')->delete('surat/' . $surat->file_surat);
            }

            $file->storeAs('surat', $filename, 'public');
            $surat->file_surat = $filename;
        }

        // Update status dan catatan admin
        $surat->status = $request->status;
        $surat->catatan_admin = $request->catatan_admin;
        $surat->tanggal_verifikasi = $request->status === 'Disetujui' || $request->status === 'Ditolak' ? now() : null;

        $surat->save();

        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Status pengajuan berhasil diupdate!');
    }

    public function adminDestroy(PengajuanSurat $surat)
    {
        $surat->delete();

        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan surat berhasil dihapus!');
    }

    public function adminDownloadSurat(PengajuanSurat $surat)
    {
        if ($surat->status !== 'Disetujui') {
            abort(404);
        }

        // Return view untuk preview/cetak
        return view('admin.pengajuan.print', compact('surat'));
    }

    /**
     * Download surat sebagai HTML file (Admin)
     */
    public function adminDownloadPdf(PengajuanSurat $surat)
    {
        if ($surat->status !== 'Disetujui') {
            abort(404);
        }
        $filename = 'Surat-' . $surat->nomor_pengajuan . '-' . now()->format('Y-m-d') . '.pdf';

        try {
            if (app()->bound('dompdf.wrapper')) {
                $pdf = app('dompdf.wrapper');
                $pdf->loadView('admin.pengajuan.print', compact('surat'));
                $pdf->setPaper('a4', 'portrait');
                return $pdf->download($filename);
            }

            if (class_exists('\Barryvdh\DomPDF\Facade\Pdf') || class_exists('PDF')) {
                $pdf = \PDF::loadView('admin.pengajuan.print', compact('surat'));
                $pdf->setPaper('a4', 'portrait');
                return $pdf->download($filename);
            }
        } catch (\Exception $e) {
            // fallback ke HTML
        }

        $filenameHtml = 'Surat-' . $surat->nomor_pengajuan . '-' . now()->format('Y-m-d') . '.html';
        $html = view('admin.pengajuan.print', compact('surat'))->render();
        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filenameHtml . '"',
        ]);
    }
}