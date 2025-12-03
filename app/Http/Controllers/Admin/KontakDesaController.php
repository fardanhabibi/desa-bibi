<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakDesa;
use Illuminate\Http\Request;

class KontakDesaController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kontak = KontakDesa::query();

        if ($search) {
            $kontak->where('nama', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%");
        }

        $kontak = $kontak->paginate(15);
        return view('admin.kontak.index', compact('kontak', 'search'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'jabatan' => 'required|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
        ]);

        KontakDesa::create($validated);
        return redirect()->route('admin.kontak.index')->with('success', 'Kontak desa berhasil ditambahkan');
    }

    public function show(KontakDesa $kontak)
    {
        return view('admin.kontak.show', compact('kontak'));
    }

    public function edit(KontakDesa $kontak)
    {
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, KontakDesa $kontak)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'jabatan' => 'required|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email',
        ]);

        $kontak->update($validated);
        return redirect()->route('admin.kontak.index')->with('success', 'Kontak desa berhasil diperbarui');
    }

    public function destroy(KontakDesa $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Kontak desa berhasil dihapus');
    }
}
