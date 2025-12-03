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
            $kematian->whereHas('penduduk', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $kematian = $kematian->paginate(15);
        return view('admin.kematian.index', compact('kematian', 'search'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.kematian.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_almarhum' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string',
            'nama_pelapor' => 'required|string',
        ]);

        Kematian::create($validated);
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil ditambahkan');
    }

    public function show(Kematian $kematian)
    {
        return view('admin.kematian.show', compact('kematian'));
    }

    public function edit(Kematian $kematian)
    {
        $penduduk = Penduduk::all();
        return view('admin.kematian.edit', compact('kematian', 'penduduk'));
    }

    public function update(Request $request, Kematian $kematian)
    {
        $validated = $request->validate([
            'nama_almarhum' => 'required|string',
            'tanggal_meninggal' => 'required|date',
            'penyebab_kematian' => 'required|string',
            'nama_pelapor' => 'required|string',
        ]);

        $kematian->update($validated);
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil diperbarui');
    }

    public function destroy(Kematian $kematian)
    {
        $kematian->delete();
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil dihapus');
    }
}
