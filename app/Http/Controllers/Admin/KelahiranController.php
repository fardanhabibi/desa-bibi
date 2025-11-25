<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelahiran;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kelahiran = Kelahiran::query();

        if ($search) {
            $kelahiran->where('nama_bayi', 'like', "%{$search}%")
                      ->orWhere('ibu_nik', 'like', "%{$search}%")
                      ->orWhere('ayah_nik', 'like', "%{$search}%");
        }

        $kelahiran = $kelahiran->paginate(15);
        return view('admin.kelahiran.index', compact('kelahiran', 'search'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        $kk = KartuKeluarga::all();
        return view('admin.kelahiran.create', compact('penduduk', 'kk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bayi' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'ibu_nik' => 'required|string',
            'ayah_nik' => 'required|string',
            'kk_id' => 'nullable|integer',
        ]);

        Kelahiran::create($validated);
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil ditambahkan');
    }

    public function show(Kelahiran $kelahiran)
    {
        return view('admin.kelahiran.show', compact('kelahiran'));
    }

    public function edit(Kelahiran $kelahiran)
    {
        $penduduk = Penduduk::all();
        $kk = KartuKeluarga::all();
        return view('admin.kelahiran.edit', compact('kelahiran', 'penduduk', 'kk'));
    }

    public function update(Request $request, Kelahiran $kelahiran)
    {
        $validated = $request->validate([
            'nama_bayi' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'ibu_nik' => 'required|string',
            'ayah_nik' => 'required|string',
            'kk_id' => 'nullable|integer',
        ]);

        $kelahiran->update($validated);
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil diperbarui');
    }

    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil dihapus');
    }
}
