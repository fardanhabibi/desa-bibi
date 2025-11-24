<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Display biodata form for current user
     */
    public function index()
    {
        $user = Auth::user();
        $is_verified_user = $user->is_verified;

        return view('user.biodata', compact('user', 'is_verified_user'));
    }

    /**
     * Show edit form for biodata
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.biodata-edit', compact('user'));
    }

    /**
     * Update biodata for current user
     */
    public function updateBiodata(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:users,nik,' . $user->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'nomor_telpon' => 'required|string|min:10|max:13',
            'alamat' => 'required|string|max:500',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|size:5|numeric',
        ]);

        $user->update($validated);

        return redirect()->route('user.biodata')
                        ->with('success', 'Data penduduk berhasil diperbarui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biodata $biodata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
