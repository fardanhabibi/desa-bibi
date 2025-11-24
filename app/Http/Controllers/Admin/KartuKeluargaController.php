<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
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
        return view('admin.kartu_keluarga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string|unique:kartu_keluarga,no_kk|max:16',
            'kepala_keluarga' => 'required|string',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'dusun' => 'nullable|string',
        ]);

        KartuKeluarga::create($validated);
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil ditambahkan');
    }

    public function show(KartuKeluarga $kartu_keluarga)
    {
        return view('admin.kartu_keluarga.show', compact('kartu_keluarga'));
    }

    public function edit(KartuKeluarga $kartu_keluarga)
    {
        return view('admin.kartu_keluarga.edit', compact('kartu_keluarga'));
    }

    public function update(Request $request, KartuKeluarga $kartu_keluarga)
    {
        $validated = $request->validate([
            'no_kk' => 'required|string|unique:kartu_keluarga,no_kk,' . $kartu_keluarga->id . '|max:16',
            'kepala_keluarga' => 'required|string',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'dusun' => 'nullable|string',
        ]);

        $kartu_keluarga->update($validated);
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil diperbarui');
    }

    public function destroy(KartuKeluarga $kartu_keluarga)
    {
        $kartu_keluarga->delete();
        return redirect()->route('admin.kartu_keluarga.index')->with('success', 'Kartu Keluarga berhasil dihapus');
    }
}
