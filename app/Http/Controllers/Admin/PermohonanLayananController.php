<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanLayanan;
use App\Models\LayananOnline;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PermohonanLayananController extends Controller
{
    public function index()
    {
        $search = request('search');
        $permohonan = PermohonanLayanan::query();

        if ($search) {
            $permohonan->where('no_permohonan', 'like', "%{$search}%")
                ->orWhereHas('pemohon', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
        }

        $permohonan = $permohonan->paginate(15);
        return view('admin.permohonan_layanan.index', compact('permohonan', 'search'));
    }

    public function create()
    {
        $layanan = LayananOnline::where('status', 'aktif')->get();
        $penduduk = Penduduk::all();
        return view('admin.permohonan_layanan.create', compact('layanan', 'penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_permohonan' => 'required|string|unique:permohonan_layanans,no_permohonan',
            'layanan_id' => 'required|exists:layanan_onlines,id',
            'pemohon_nik' => 'required|exists:penduduks,nik',
            'tanggal_permohonan' => 'required|date',
            'status' => 'required|in:baru|diproses|selesai|ditolak',
            'keterangan' => 'nullable|string',
        ]);

        PermohonanLayanan::create($validated);
        return redirect()->route('admin.permohonan_layanan.index')->with('success', 'Permohonan layanan berhasil ditambahkan');
    }

    public function show(PermohonanLayanan $permohonan_layanan)
    {
        return view('admin.permohonan_layanan.show', compact('permohonan_layanan'));
    }

    public function edit(PermohonanLayanan $permohonan_layanan)
    {
        $layanan = LayananOnline::where('status', 'aktif')->get();
        $penduduk = Penduduk::all();
        return view('admin.permohonan_layanan.edit', compact('permohonan_layanan', 'layanan', 'penduduk'));
    }

    public function update(Request $request, PermohonanLayanan $permohonan_layanan)
    {
        $validated = $request->validate([
            'no_permohonan' => 'required|string|unique:permohonan_layanans,no_permohonan,' . $permohonan_layanan->id,
            'layanan_id' => 'required|exists:layanan_onlines,id',
            'pemohon_nik' => 'required|exists:penduduks,nik',
            'tanggal_permohonan' => 'required|date',
            'status' => 'required|in:baru|diproses|selesai|ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $permohonan_layanan->update($validated);
        return redirect()->route('admin.permohonan_layanan.index')->with('success', 'Permohonan layanan berhasil diperbarui');
    }

    public function destroy(PermohonanLayanan $permohonan_layanan)
    {
        $permohonan_layanan->delete();
        return redirect()->route('admin.permohonan_layanan.index')->with('success', 'Permohonan layanan berhasil dihapus');
    }
}
