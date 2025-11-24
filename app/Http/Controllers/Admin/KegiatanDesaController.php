<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanDesa;
use App\Models\AparatDesa;
use Illuminate\Http\Request;

class KegiatanDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanDesa::with('penanggungJawab');

        if ($request->search) {
            $query->where('nama_kegiatan', 'like', "%{$request->search}%")
                  ->orWhere('lokasi', 'like', "%{$request->search}%");
        }

        $kegiatan = $query->latest('tanggal')->paginate(15);
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $penanggungJawab = AparatDesa::all();
        return view('admin.kegiatan.create', compact('penanggungJawab'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'penanggung_jawab' => 'required|exists:aparat_desa,id',
            'deskripsi' => 'nullable|string',
        ]);

        KegiatanDesa::create($validated);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(KegiatanDesa $kegiatan)
    {
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function edit(KegiatanDesa $kegiatan)
    {
        $penanggungJawab = AparatDesa::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'penanggungJawab'));
    }

    public function update(Request $request, KegiatanDesa $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'penanggung_jawab' => 'required|exists:aparat_desa,id',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan->update($validated);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(KegiatanDesa $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
