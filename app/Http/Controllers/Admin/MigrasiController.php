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
            'penduduk_nik' => 'required|exists:penduduk,nik',
            'asal_daerah' => 'required|string',
            'tujuan_daerah' => 'required|string',
            'tanggal_migrasi' => 'required|date',
            'alasan' => 'nullable|string',
        ]);

        // Map form fields to model columns
        $data = [
            'penduduk_nik' => $validated['penduduk_nik'],
            'asal_tujuan' => $validated['asal_daerah'] . ' -> ' . $validated['tujuan_daerah'],
            'tanggal' => $validated['tanggal_migrasi'],
            'jenis' => $validated['alasan'] ?? null,
        ];

        Migrasi::create($data);
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
            'penduduk_nik' => 'required|exists:penduduk,nik',
            'asal_daerah' => 'required|string',
            'tujuan_daerah' => 'required|string',
            'tanggal_migrasi' => 'required|date',
            'alasan' => 'nullable|string',
        ]);

        $data = [
            'penduduk_nik' => $validated['penduduk_nik'],
            'asal_tujuan' => $validated['asal_daerah'] . ' -> ' . $validated['tujuan_daerah'],
            'tanggal' => $validated['tanggal_migrasi'],
            'jenis' => $validated['alasan'] ?? null,
        ];

        $migrasi->update($data);
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil diperbarui');
    }

    public function destroy(Migrasi $migrasi)
    {
        $migrasi->delete();
        return redirect()->route('admin.migrasi.index')->with('success', 'Data migrasi berhasil dihapus');
    }
}
