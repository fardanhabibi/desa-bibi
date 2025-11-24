<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    /**
     * Display a listing of residents.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Search functionality - cari by name, email, atau NIK
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        // Filter by verification status
        if ($request->verification_status) {
            if ($request->verification_status == 'verified') {
                $query->where('is_verified', true);
            } elseif ($request->verification_status == 'unverified') {
                $query->where('is_verified', false);
            }
        }

        // Sort
        $sort = $request->sort ?? 'newest';
        if ($sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        }

        $residents = $query->paginate(15);
        $totalResidents = User::where('role', 'user')->count();
        $verifiedResidents = User::where('role', 'user')->where('is_verified', true)->count();
        $unverifiedResidents = User::where('role', 'user')->where('is_verified', false)->count();

        return view('admin.data-penduduk.index', compact(
            'residents',
            'totalResidents',
            'verifiedResidents',
            'unverifiedResidents'
        ));
    }

    /**
     * Show the form for creating a new resident.
     */
    public function create()
    {
        return view('admin.data-penduduk.create');
    }

    /**
     * Store a newly created resident in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'is_verified' => 'boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'user';
        $validated['is_verified'] = $request->has('is_verified');

        User::create($validated);

        return redirect()->route('admin.data-penduduk.index')
                        ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    /**
     * Display the specified resident.
     */
    public function show(User $resident)
    {
        if ($resident->role !== 'user') {
            abort(403);
        }

        return view('admin.data-penduduk.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resident.
     */
    public function edit(User $resident)
    {
        if ($resident->role !== 'user') {
            abort(403);
        }

        return view('admin.data-penduduk.edit', compact('resident'));
    }

    /**
     * Update the specified resident in storage.
     */
    public function update(Request $request, User $resident)
    {
        if ($resident->role !== 'user') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $resident->id,
            'is_verified' => 'boolean',
        ]);

        $resident->update($validated);

        return redirect()->route('admin.data-penduduk.index')
                        ->with('success', 'Data penduduk berhasil diperbarui');
    }

    /**
     * Remove the specified resident from storage.
     */
    public function destroy(User $resident)
    {
        if ($resident->role !== 'user') {
            abort(403);
        }

        $resident->delete();

        return redirect()->route('admin.data-penduduk.index')
                        ->with('success', 'Data penduduk berhasil dihapus');
    }

    /**
     * Export residents data to CSV.
     */
    public function export()
    {
        $residents = User::where('role', 'user')->get();

        $csv = "Nama,Email,Status Verifikasi,Tanggal Pendaftaran\n";
        foreach ($residents as $resident) {
            $status = $resident->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi';
            $csv .= "\"{$resident->name}\",\"{$resident->email}\",\"{$status}\",\"{$resident->created_at->format('d-m-Y')}\"\n";
        }

        return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="data-penduduk.csv"');
    }
}
