<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumDiskusi;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class ForumDiskusiController extends Controller
{
    public function index()
    {
        $search = request('search');
        $forum = ForumDiskusi::query();

        if ($search) {
            $forum->where('judul', 'like', "%{$search}%")
                ->orWhere('isi', 'like', "%{$search}%");
        }

        $forum = $forum->paginate(15);
        return view('admin.forum.index', compact('forum', 'search'));
    }

    public function create()
    {
        $penduduk = Penduduk::all();
        return view('admin.forum.create', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penulis_nik' => 'required|exists:penduduks,nik',
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'kategori' => 'nullable|string',
            'status' => 'required|in:dibuka,ditutup',
        ]);

        $validated['tanggal_buat'] = now();
        ForumDiskusi::create($validated);
        return redirect()->route('admin.forum.index')->with('success', 'Topik forum berhasil ditambahkan');
    }

    public function show(ForumDiskusi $forum)
    {
        return view('admin.forum.show', compact('forum'));
    }

    public function edit(ForumDiskusi $forum)
    {
        $penduduk = Penduduk::all();
        return view('admin.forum.edit', compact('forum', 'penduduk'));
    }

    public function update(Request $request, ForumDiskusi $forum)
    {
        $validated = $request->validate([
            'penulis_nik' => 'required|exists:penduduks,nik',
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'kategori' => 'nullable|string',
            'status' => 'required|in:dibuka,ditutup',
        ]);

        $forum->update($validated);
        return redirect()->route('admin.forum.index')->with('success', 'Topik forum berhasil diperbarui');
    }

    public function destroy(ForumDiskusi $forum)
    {
        $forum->delete();
        return redirect()->route('admin.forum.index')->with('success', 'Topik forum berhasil dihapus');
    }
}
