<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadFormulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadFormulirController extends Controller
{
    public function index()
    {
        $search = request('search');
        $formulir = DownloadFormulir::query();

        if ($search) {
            $formulir->where('nama_formulir', 'like', "%{$search}%");
        }

        $formulir = $formulir->paginate(15);
        return view('admin.formulir.index', compact('formulir', 'search'));
    }

    public function create()
    {
        return view('admin.formulir.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_formulir' => 'required|string|max:200',
            'file_url' => 'required|file|mimes:pdf,doc,docx',
            'tanggal_upload' => 'required|date',
        ]);

        if ($request->hasFile('file_url')) {
            $validated['file_url'] = $request->file('file_url')->store('formulir', 'public');
        }

        DownloadFormulir::create($validated);
        return redirect()->route('admin.formulir.index')->with('success', 'Formulir berhasil ditambahkan');
    }

    public function show(DownloadFormulir $formulir)
    {
        return view('admin.formulir.show', compact('formulir'));
    }

    public function edit(DownloadFormulir $formulir)
    {
        return view('admin.formulir.edit', compact('formulir'));
    }

    public function update(Request $request, DownloadFormulir $formulir)
    {
        $validated = $request->validate([
            'nama_formulir' => 'required|string|max:200',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx',
            'tanggal_upload' => 'required|date',
        ]);

        if ($request->hasFile('file_url')) {
            if ($formulir->file_url) {
                Storage::disk('public')->delete($formulir->file_url);
            }
            $validated['file_url'] = $request->file('file_url')->store('formulir', 'public');
        }

        $formulir->update($validated);
        return redirect()->route('admin.formulir.index')->with('success', 'Formulir berhasil diperbarui');
    }

    public function destroy(DownloadFormulir $formulir)
    {
        if ($formulir->file_url) {
            Storage::disk('public')->delete($formulir->file_url);
        }
        $formulir->delete();
        return redirect()->route('admin.formulir.index')->with('success', 'Formulir berhasil dihapus');
    }
}
