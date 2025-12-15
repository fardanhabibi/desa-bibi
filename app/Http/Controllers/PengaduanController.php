<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // User Methods
    public function index(Request $request)
    {
        $query = Pengaduan::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        // Search by nomor_pengaduan or judul
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_pengaduan', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%");
            });
        }

        $pengaduans = $query->paginate(10)->withQueryString();

        // Statistik untuk pengguna saat ini
        $stats = [
            'total' => Pengaduan::where('user_id', Auth::id())->count(),
            'pending' => Pengaduan::where('user_id', Auth::id())->where('status', 'Pending')->count(),
            'diproses' => Pengaduan::where('user_id', Auth::id())->where('status', 'Diproses')->count(),
            'selesai' => Pengaduan::where('user_id', Auth::id())->where('status', 'Selesai')->count(),
            'ditolak' => Pengaduan::where('user_id', Auth::id())->where('status', 'Ditolak')->count(),
        ];

        return view('user.pengaduan.index', compact('pengaduans', 'stats'));
    }

    public function create()
    {
        return view('user.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'file_lampiran' => 'nullable|array',
            'file_lampiran.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'judul.required' => 'Judul pengaduan harus diisi',
            'isi_pengaduan.required' => 'Isi pengaduan harus diisi',
            'file_lampiran.*.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
            'file_lampiran.*.max' => 'Ukuran file maksimal 2MB per file'
        ]);

        $data = $request->except('file_lampiran');
        $data['user_id'] = Auth::id();
        $data['nomor_pengaduan'] = Pengaduan::generateNomorPengaduan();
        $data['status'] = 'Pending';

        // Handle multiple file uploads
        if ($request->hasFile('file_lampiran')) {
            $uploaded = $request->file('file_lampiran');
            $filenames = [];
            foreach ($uploaded as $file) {
                if (!$file->isValid()) continue;
                $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('pengaduan', $filename, 'public');
                $filenames[] = $filename;
            }
            // Save as JSON array
            $data['file_lampiran'] = json_encode($filenames);
        }

        Pengaduan::create($data);

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diajukan dengan nomor: ' . $data['nomor_pengaduan']);
    }

    public function show(Pengaduan $pengaduan)
    {
        // Pastikan user hanya bisa melihat pengaduannya sendiri
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.pengaduan.show', compact('pengaduan'));
    }

    public function destroy(Pengaduan $pengaduan)
    {
        // Pastikan user hanya bisa menghapus pengaduannya sendiri
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dihapus jika status masih Pending
        if ($pengaduan->status !== 'Pending') {
            return back()->withErrors(['error' => 'Pengaduan yang sudah diproses tidak dapat dihapus']);
        }

        // Hapus file jika ada (mendukung multiple)
        if ($pengaduan->file_lampiran) {
            $files = [];
            if (is_array($pengaduan->file_lampiran)) {
                $files = $pengaduan->file_lampiran;
            } else {
                $decoded = json_decode($pengaduan->file_lampiran, true);
                if (is_array($decoded)) {
                    $files = $decoded;
                } else {
                    $files = [$pengaduan->file_lampiran];
                }
            }

            foreach ($files as $f) {
                if ($f) {
                    Storage::disk('public')->delete('pengaduan/' . $f);
                }
            }
        }

        $pengaduan->delete();

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    // Admin Methods
    public function adminIndex(Request $request)
    {
        $query = Pengaduan::with(['user', 'admin'])->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_pengaduan', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $pengaduans = $query->paginate(15);
        
        // Statistik
        $stats = [
            'total' => Pengaduan::count(),
            'pending' => Pengaduan::where('status', 'Pending')->count(),
            'diproses' => Pengaduan::where('status', 'Diproses')->count(),
            'selesai' => Pengaduan::where('status', 'Selesai')->count(),
            'ditolak' => Pengaduan::where('status', 'Ditolak')->count(),
        ];

        return view('admin.pengaduan.index', compact('pengaduans', 'stats'));
    }

    public function adminShow(Pengaduan $pengaduan)
    {
        $pengaduan->load(['user', 'admin']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function adminUpdate(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
            'tanggapan' => 'required|string'
        ], [
            'status.required' => 'Status harus dipilih',
            'tanggapan.required' => 'Tanggapan harus diisi'
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'tanggal_tanggapan' => now(),
            'admin_id' => Auth::id()
        ]);

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Tanggapan berhasil disimpan');
    }

    public function adminDestroy(Pengaduan $pengaduan)
    {
        // Hapus file jika ada (mendukung multiple)
        if ($pengaduan->file_lampiran) {
            $files = [];
            if (is_array($pengaduan->file_lampiran)) {
                $files = $pengaduan->file_lampiran;
            } else {
                $decoded = json_decode($pengaduan->file_lampiran, true);
                if (is_array($decoded)) {
                    $files = $decoded;
                } else {
                    $files = [$pengaduan->file_lampiran];
                }
            }

            foreach ($files as $f) {
                if ($f) {
                    Storage::disk('public')->delete('pengaduan/' . $f);
                }
            }
        }

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }
}