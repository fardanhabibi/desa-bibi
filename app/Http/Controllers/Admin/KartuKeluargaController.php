<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kk = KartuKeluarga::query();

        if ($search) {
            $kk->where('no_kk', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        }

        $kk = $kk->paginate(15);
        return view('admin.kartu_keluarga.index', compact('kk', 'search'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.kartu_keluarga.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string|unique:kartu_keluarga,no_kk|max:16',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'dusun' => 'nullable|string|max:255',
        ]);

        // Sesuaikan key dengan field di model
        KartuKeluarga::create([
            'no_kk' => $validated['no_kk'],
            'kepala_keluarga' => $validated['kepala_keluarga'],
            'alamat' => $validated['alamat'],
            'rt' => $validated['rt'] ?? null,
            'rw' => $validated['rw'] ?? null,
            'dusun' => $validated['dusun'] ?? null,
        ]);
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil ditambahkan');
    }

    public function show(KartuKeluarga $kartu_keluarga)
    {
        return view('admin.kartu_keluarga.show', compact('kartu_keluarga'));
    }

    public function edit(KartuKeluarga $kartu_keluarga)
    {
        $penduduk = Penduduk::all();
        return view('admin.kartu_keluarga.edit', compact('kartu_keluarga', 'penduduk'));
    }

    public function update(Request $request, KartuKeluarga $kartu_keluarga)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string|unique:kartu_keluarga,no_kk,' . $kartu_keluarga->id . '|max:16',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'dusun' => 'nullable|string|max:255',
        ]);

        $kartu_keluarga->update([
            'no_kk' => $validated['no_kk'],
            'kepala_keluarga' => $validated['kepala_keluarga'],
            'alamat' => $validated['alamat'],
            'rt' => $validated['rt'] ?? null,
            'rw' => $validated['rw'] ?? null,
            'dusun' => $validated['dusun'] ?? null,
        ]);
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil diperbarui');
    }

    public function destroy(KartuKeluarga $kartu_keluarga)
    {
        $kartu_keluarga->delete();
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil dihapus');
    }
}
