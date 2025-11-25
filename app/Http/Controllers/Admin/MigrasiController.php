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
            $migrasi->where('penduduk_nik', 'like', "%{$search}%")
                    ->orWhere('jenis', 'like', "%{$search}%");
        }

        $migrasi = $migrasi->paginate(15);
        return view('admin.migrasi.index', compact('migrasi', 'search'));
    }

    public function create()
    {
        return view('admin.migrasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penduduk' => 'required|string',
            'jenis' => 'required|string',
            'asal_tujuan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Migrasi::create([
            'penduduk_nik' => $validated['nama_penduduk'],
            'jenis' => $validated['jenis'],
            'asal_tujuan' => $validated['asal_tujuan'],
            'tanggal' => $validated['tanggal'],
        ]);
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil ditambahkan');
    }

    public function show(Migrasi $migrasi)
    {
        return view('admin.migrasi.show', compact('migrasi'));
    }

    public function edit(Migrasi $migrasi)
    {
        // Use manual input for penduduk name (stored in penduduk_nik column)
        return view('admin.migrasi.edit', compact('migrasi'));
    }

    public function update(Request $request, Migrasi $migrasi)
    {
        // Validate same fields as store (manual nama input)
        $validated = $request->validate([
            'nama_penduduk' => 'required|string',
            'jenis' => 'required|string',
            'asal_tujuan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $migrasi->update([
            'penduduk_nik' => $validated['nama_penduduk'],
            'jenis' => $validated['jenis'],
            'asal_tujuan' => $validated['asal_tujuan'],
            'tanggal' => $validated['tanggal'],
        ]);
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil diperbarui');
    }

    public function destroy(Migrasi $migrasi)
    {
        $migrasi->delete();
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil dihapus');
    }
}
