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
            $kelahiran->whereHas('ibu', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
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
            'anak_nik' => 'nullable|unique:kelahirans,anak_nik',
            'ibu_nik' => 'required|exists:penduduks,nik',
            'ayah_nik' => 'required|exists:penduduks,nik',
            'kk_id' => 'required|exists:kartu_keluargas,id',
            'nama_anak' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'berat_badan' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
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
            'anak_nik' => 'nullable|unique:kelahirans,anak_nik,' . $kelahiran->id,
            'ibu_nik' => 'required|exists:penduduks,nik',
            'ayah_nik' => 'required|exists:penduduks,nik',
            'kk_id' => 'required|exists:kartu_keluargas,id',
            'nama_anak' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'berat_badan' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
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
