<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->search) {
            $query->where('judul', 'like', "%{$request->search}%")
                  ->orWhere('isi', 'like', "%{$request->search}%");
        }

        $berita = $query->latest('tanggal_posting')->paginate(15);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'tanggal_posting' => 'required|date',
        ]);

        if ($request->hasFile('gambar_url')) {
            $validated['gambar_url'] = $request->file('gambar_url')->store('berita', 'public');
        }

        Berita::create($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'tanggal_posting' => 'required|date',
        ]);

        if ($request->hasFile('gambar_url')) {
            if ($berita->gambar_url) {
                Storage::disk('public')->delete($berita->gambar_url);
            }
            $validated['gambar_url'] = $request->file('gambar_url')->store('berita', 'public');
        }

        $berita->update($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar_url) {
            Storage::disk('public')->delete($berita->gambar_url);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
