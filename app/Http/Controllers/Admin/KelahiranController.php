<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelahiran;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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

        // Resolve kk_no to kk_id
        $kk = KartuKeluarga::where('no_kk', $validated['kk_no'])->first();
        if (!$kk) {
            return back()->withInput()->withErrors(['kk_no' => 'Kartu Keluarga tidak ditemukan dengan nomor tersebut.']);
        }

        // Find penduduk by name for ibu and ayah (use first match). Both may be unregistered.
        $ibu = !empty($validated['ibu_nama']) ? Penduduk::where('nama', $validated['ibu_nama'])->first() : null;
        $ayah = !empty($validated['ayah_nama']) ? Penduduk::where('nama', $validated['ayah_nama'])->first() : null;

        $data = [
            'nama_bayi' => $validated['nama_bayi'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'ayah_nik' => $ayah ? $ayah->nik : null,
            'ibu_nik' => $ibu ? $ibu->nik : null,
            'kk_id' => $kk->id,
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'ibu_nama' => $validated['ibu_nama'] ?? null,
            'ayah_nama' => $validated['ayah_nama'] ?? null,
        ];

        Kelahiran::create($data);
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

        $kk = KartuKeluarga::where('no_kk', $validated['kk_no'])->first();
        if (!$kk) {
            return back()->withInput()->withErrors(['kk_no' => 'Kartu Keluarga tidak ditemukan dengan nomor tersebut.']);
        }

        // Find penduduk by name for ibu and ayah (use first match). Both may be unregistered.
        $ibu = !empty($validated['ibu_nama']) ? Penduduk::where('nama', $validated['ibu_nama'])->first() : null;
        $ayah = !empty($validated['ayah_nama']) ? Penduduk::where('nama', $validated['ayah_nama'])->first() : null;

        // Both parents may be unregistered. If found, store their NIK; otherwise store the provided name and leave nik null.
        $data = [
            'nama_bayi' => $validated['nama_bayi'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'ayah_nik' => $ayah ? $ayah->nik : null,
            'ibu_nik' => $ibu ? $ibu->nik : null,
            'kk_id' => $kk->id,
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'ibu_nama' => $validated['ibu_nama'] ?? null,
            'ayah_nama' => $validated['ayah_nama'] ?? null,
        ];

        $kelahiran->update($data);
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil diperbarui');
    }

    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil dihapus');
    }
}
