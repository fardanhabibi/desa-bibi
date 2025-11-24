<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->search) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        if ($request->sort) {
            $query->orderBy($request->sort, $request->dir ?? 'asc');
        } else {
            $query->latest('created_at');
        }

        $penduduk = $query->paginate(15);

        return view('admin.penduduk.index', compact('penduduk'));
    }

    public function create()
    {
        $kartuKeluarga = KartuKeluarga::all();
        return view('admin.penduduk.create', compact('kartuKeluarga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:penduduk',
            'kk_id' => 'nullable|exists:kartu_keluarga,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_kawin' => 'nullable|in:belum_kawin,kawin,cerai_hidup,cerai_mati',
            'no_hp' => 'nullable|string|max:13',
            'email' => 'nullable|email|unique:penduduk',
        ]);

        Penduduk::create($validated);

        return redirect()->route('admin.penduduk.index')
                        ->with('success', 'Penduduk berhasil ditambahkan.');
    }

    public function show(Penduduk $penduduk)
    {
        return view('admin.penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        $kartuKeluarga = KartuKeluarga::all();
        return view('admin.penduduk.edit', compact('penduduk', 'kartuKeluarga'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'kk_id' => 'nullable|exists:kartu_keluarga,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_kawin' => 'nullable|in:belum_kawin,kawin,cerai_hidup,cerai_mati',
            'no_hp' => 'nullable|string|max:13',
            'email' => 'nullable|email|unique:penduduk,email,' . $penduduk->nik . ',nik',
        ]);

        $penduduk->update($validated);

        return redirect()->route('admin.penduduk.index')
                        ->with('success', 'Penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')
                        ->with('success', 'Penduduk berhasil dihapus.');
    }
}

