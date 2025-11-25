<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kematian;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KematianController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kematian = Kematian::query();

        if ($search) {
            $kematian->where('penduduk_nik', 'like', "%{$search}%")
                      ->orWhere('penyebab', 'like', "%{$search}%");
        }

        $kematian = $kematian->paginate(15);
        return view('admin.kematian.index', compact('kematian', 'search'));
    }

    public function create()
    {
        // form uses manual input fields (nama_almarhum, nama_pelapor) so no need to pass penduduk list
        return view('admin.kematian.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_almarhum' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string',
            'nama_pelapor' => 'nullable|string',
        ]);

        // Map view fields to model columns
        $data = [
            'penduduk_nik' => $validated['nama_almarhum'],
            'tanggal' => $validated['tanggal_meninggal'],
            'penyebab' => $validated['penyebab_kematian'],
            'keterangan' => $validated['nama_pelapor'] ?? null,
        ];

        Kematian::create($data);
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil ditambahkan');
    }

    public function show(Kematian $kematian)
    {
        return view('admin.kematian.show', compact('kematian'));
    }

    public function edit(Kematian $kematian)
    {
        return view('admin.kematian.edit', compact('kematian'));
    }

    public function update(Request $request, Kematian $kematian)
    {
        $validated = $request->validate([
            'nama_almarhum' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string',
            'nama_pelapor' => 'nullable|string',
        ]);

        $data = [
            'penduduk_nik' => $validated['nama_almarhum'],
            'tanggal' => $validated['tanggal_meninggal'],
            'penyebab' => $validated['penyebab_kematian'],
            'keterangan' => $validated['nama_pelapor'] ?? null,
        ];

        $kematian->update($data);
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil diperbarui');
    }

    public function destroy(Kematian $kematian)
    {
        $kematian->delete();
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil dihapus');
    }
}
