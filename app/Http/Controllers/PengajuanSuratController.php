<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data pengajuan surat user yang login
        $pengajuans = PengajuanSurat::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // Hitung statistik
        $stats = [
            'total' => PengajuanSurat::where('user_id', $user->id)->count(),
            'pending' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Pending')->count(),
            'diproses' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Diproses')->count(),
            'disetujui' => PengajuanSurat::where('user_id', $user->id)->where('status', 'Disetujui')->count(),
        ];

        return view('user.pengajuan.index', compact('pengajuans', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisSurat = [
            'Surat Keterangan Domisili',
            'Surat Keterangan Usaha',
            'Surat Keterangan Tidak Mampu',
            'Surat Keterangan Kelahiran',
            'Surat Keterangan Kematian',
            'Surat Pengantar',
            'Surat Keterangan Beda Nama',
            'Surat Keterangan Lainnya'
        ];

        return view('user.pengajuan.create', compact('jenisSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'keperluan' => 'required|string|max:500',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        // Generate nomor pengajuan
        $nomorPengajuan = 'SRT-' . date('Ymd') . '-' . Str::random(6);

        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'nomor_pengajuan' => $nomorPengajuan,
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'status' => 'Pending',
        ]);

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

        $surat->delete();

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan surat berhasil dihapus!');
    }

    /**
     * Download surat yang sudah disetujui
     */
    public function downloadSurat(PengajuanSurat $surat)
    {
        // Pastikan user hanya bisa mendownload suratnya sendiri dan status sudah disetujui
        if ($surat->user_id !== Auth::id() || $surat->status !== 'Disetujui' || !$surat->file_surat) {
            abort(404);
        }

        // Implementasi download file
        // return response()->download(storage_path('app/' . $surat->file_surat));
        
        // Untuk sementara, return pesan
        return redirect()->back()->with('info', 'Fitur download akan segera tersedia.');
    }

    /**
     * ADMIN METHODS
     */
    public function adminIndex()
    {
        $pengajuans = PengajuanSurat::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    public function adminShow(PengajuanSurat $surat)
    {
        return view('admin.pengajuan.show', compact('surat'));
    }

    public function adminUpdate(Request $request, PengajuanSurat $surat)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Disetujui,Ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $surat->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'tanggal_verifikasi' => $request->status === 'Disetujui' || $request->status === 'Ditolak' ? now() : null,
        ]);

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
        if (!$surat->file_surat) {
            abort(404);
        }

        // Implementasi download file untuk admin
        // return response()->download(storage_path('app/' . $surat->file_surat));
        
        return redirect()->back()->with('info', 'Fitur download akan segera tersedia.');
    }
}