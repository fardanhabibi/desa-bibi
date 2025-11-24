<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramDesa;
use Illuminate\Http\Request;

class ProgramDesaController extends Controller
{
    public function index()
    {
        $search = request('search');
        $program = ProgramDesa::query();

        if ($search) {
            $program->where('nama_program', 'like', "%{$search}%");
        }

        $program = $program->paginate(15);
        return view('admin.program.index', compact('program', 'search'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'anggaran' => 'nullable|numeric',
            'status' => 'required|in:perencanaan,berlangsung,selesai,ditunda',
        ]);

        ProgramDesa::create($validated);
        return redirect()->route('admin.program.index')->with('success', 'Program desa berhasil ditambahkan');
    }

    public function show(ProgramDesa $program)
    {
        return view('admin.program.show', compact('program'));
    }

    public function edit(ProgramDesa $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, ProgramDesa $program)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'anggaran' => 'nullable|numeric',
            'status' => 'required|in:perencanaan,berlangsung,selesai,ditunda',
        ]);

        $program->update($validated);
        return redirect()->route('admin.program.index')->with('success', 'Program desa berhasil diperbarui');
    }

    public function destroy(ProgramDesa $program)
    {
        $program->delete();
        return redirect()->route('admin.program.index')->with('success', 'Program desa berhasil dihapus');
    }
}
