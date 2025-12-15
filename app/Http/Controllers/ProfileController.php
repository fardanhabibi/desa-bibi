<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show profile page
     */
    public function show()
    {
        return view('myprofile');
    }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'nama_desa' => 'required|string|max:255',
                'alamat' => 'required|string|max:1000',
                'telepon' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'deskripsi' => 'nullable|string|max:2000',
            ]);

            // Get user
            $user = auth()->user();

            // Update user data - map to actual database columns
            // Note: users table has columns: name, email, nomor_telpon, alamat
            $user->name = $request->nama_desa ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->nomor_telpon = $request->telepon ?? $user->nomor_telpon;
            $user->alamat = $request->alamat ?? $user->alamat;

            // We do not have a 'description' column on users by default; skip saving deskripsi here.
            $user->save();

            return redirect()->route('myprofile')->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('myprofile')->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}
