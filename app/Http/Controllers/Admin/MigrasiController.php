<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Migrasi;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class MigrasiController extends Controller
{
    public function index()
    {
        $search = request('search');
        $migrasi = Migrasi::query();

        if ($search) {
            $migrasi->whereHas('penduduk', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $migrasi = $migrasi->paginate(15);
        return view('admin.migrasi.index', compact('migrasi', 'search'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.migrasi.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penduduk_nik' => 'required|exists:penduduks,nik',
            'asal_kabupaten' => 'required|string',
            'asal_kecamatan' => 'required|string',
            'tujuan_kabupaten' => 'required|string',
            'tujuan_kecamatan' => 'required|string',
            'tanggal_migrasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Migrasi::create($validated);
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil ditambahkan');
    }

    public function show(Migrasi $migrasi)
    {
        return view('admin.migrasi.show', compact('migrasi'));
    }

    public function edit(Migrasi $migrasi)
    {
        $penduduk = Penduduk::all();
        return view('admin.migrasi.edit', compact('migrasi', 'penduduk'));
    }

    public function update(Request $request, Migrasi $migrasi)
    {
        $validated = $request->validate([
            'penduduk_nik' => 'required|exists:penduduks,nik',
            'asal_kabupaten' => 'required|string',
            'asal_kecamatan' => 'required|string',
            'tujuan_kabupaten' => 'required|string',
            'tujuan_kecamatan' => 'required|string',
            'tanggal_migrasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $migrasi->update($validated);
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil diperbarui');
    }

    public function destroy(Migrasi $migrasi)
    {
        $migrasi->delete();
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil dihapus');
    }
}
