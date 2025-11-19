@extends('layouts.dashboard')
@section('title', 'Kelola Pengaduan')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Pengaduan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Pengaduan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-secondary">
                                <i class="ti ti-clipboard f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Pengaduan</h6>
                            <h4 class="mb-0">{{ $stats['total'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ti ti-clock f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Pending</h6>
                            <h4 class="mb-0">{{ $stats['pending'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-info">
                                <i class="ti ti-refresh f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Diproses</h6>
                            <h4 class="mb-0">{{ $stats['diproses'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <i class="ti ti-check f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Selesai</h6>
                            <h4 class="mb-0">{{ $stats['selesai'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Pengaduan</h5>
                </div>
                <div class="card-body">
                    <!-- Filter & Search -->
                    <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="kategori" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Kategori</option>
                                    <option value="Fasilitas" {{ request('kategori') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                    <option value="Akademik" {{ request('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="Administrasi" {{ request('kategori') == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                                    <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Cari nomor pengaduan, judul, atau nama user..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['status', 'kategori', 'search']))
                                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light">
                                            <i class="ti ti-x"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    @if($pengaduans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Pengaduan</th>
                                        <th>Pengirim</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengaduans as $pengaduan)
                                        <tr>
                                            <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avtar avtar-xs">
                                                            <i class="ti ti-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6 class="mb-0">{{ $pengaduan->user->name }}</h6>
                                                        <small class="text-muted">{{ $pengaduan->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ Str::limit($pengaduan->judul, 40) }}</td>
                                            <td><span class="badge bg-light-secondary">{{ $pengaduan->kategori }}</span></td>
                                            <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $pengaduan->status_badge }}">
                                                    {{ $pengaduan->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pengaduan.show', $pengaduan) }}" 
                                                   class="btn btn-sm btn-light-primary" 
                                                   title="Detail & Tanggapi">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.pengaduan.destroy', $pengaduan) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light-danger" title="Hapus">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Menampilkan {{ $pengaduans->firstItem() }} - {{ $pengaduans->lastItem() }} 
                                dari {{ $pengaduans->total() }} pengaduan
                            </div>
                            <div>
                                {{ $pengaduans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="mt-3 text-muted">Tidak Ada Pengaduan</h5>
                            <p class="text-muted">Belum ada pengaduan yang masuk</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection