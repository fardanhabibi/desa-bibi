<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananOnline;
use Illuminate\Http\Request;

class LayananOnlineController extends Controller
{
    public function index()
    {
        $search = request('search');
        $layanan = LayananOnline::query();

        if ($search) {
            $layanan->where('nama_layanan', 'like', "%{$search}%");
        }

        $layanan = $layanan->paginate(15);
        return view('admin.layanan.index', compact('layanan', 'search'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'biaya' => 'nullable|numeric',
            'waktu_proses' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        LayananOnline::create($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan online berhasil ditambahkan');
    }

    public function show(LayananOnline $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    public function edit(LayananOnline $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, LayananOnline $layanan)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'biaya' => 'nullable|numeric',
            'waktu_proses' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $layanan->update($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan online berhasil diperbarui');
    }

    public function destroy(LayananOnline $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan online berhasil dihapus');
    }
}
