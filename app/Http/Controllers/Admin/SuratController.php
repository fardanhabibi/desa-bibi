<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('jenisSurat', 'pemohon');

        if ($request->search) {
            $search = $request->search;
            $query->whereHas('pemohon', function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            })->orWhere('status', 'like', "%$search%");
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $surat = $query->latest('created_at')->paginate(15);
        return view('admin.surat.index', compact('surat'));
    }

    public function create()
    {
        $jenisSurat = JenisSurat::all();
        $penduduk = Penduduk::all();
        return view('admin.surat.create', compact('jenisSurat', 'penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_id' => 'required|exists:jenis_surat,id',
            'pemohon_nik' => 'required|exists:penduduk,nik',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:diajukan,diproses,disetujui,ditolak',
            'keterangan' => 'nullable|string',
            'file_url' => 'nullable|string',
        ]);

        Surat::create($validated);
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    public function show(Surat $surat)
    {
        return view('admin.surat.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        $jenisSurat = JenisSurat::all();
        $penduduk = Penduduk::all();
        return view('admin.surat.edit', compact('surat', 'jenisSurat', 'penduduk'));
    }

    public function update(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'jenis_id' => 'required|exists:jenis_surat,id',
            'pemohon_nik' => 'required|exists:penduduk,nik',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'status' => 'required|in:diajukan,diproses,disetujui,ditolak',
            'keterangan' => 'nullable|string',
            'file_url' => 'nullable|string',
        ]);

        $surat->update($validated);
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
