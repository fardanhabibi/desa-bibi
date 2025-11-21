@extends('layouts.dashboard')
@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Pengajuan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Pengajuan Surat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-secondary">
                                <i class="ti ti-file-text f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Pengajuan</h6>
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
                            <h6 class="mb-0">Disetujui</h6>
                            <h4 class="mb-0">{{ $stats['disetujui'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Pengajuan Surat</h5>
                </div>
                <div class="card-body">
                    <!-- Filter & Search -->
                    <form method="GET" action="{{ route('admin.surat.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="jenis_surat" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Jenis Surat</option>
                                    <option value="Surat Keterangan Siswa" {{ request('jenis_surat') == 'Surat Keterangan Siswa' ? 'selected' : '' }}>Surat Keterangan Siswa</option>
                                    <option value="Surat Izin" {{ request('jenis_surat') == 'Surat Izin' ? 'selected' : '' }}>Surat Izin</option>
                                    <option value="Surat Rekomendasi" {{ request('jenis_surat') == 'Surat Rekomendasi' ? 'selected' : '' }}>Surat Rekomendasi</option>
                                    <option value="Surat Keterangan Lulus" {{ request('jenis_surat') == 'Surat Keterangan Lulus' ? 'selected' : '' }}>Surat Keterangan Lulus</option>
                                    <option value="Surat Pindah Sekolah" {{ request('jenis_surat') == 'Surat Pindah Sekolah' ? 'selected' : '' }}>Surat Pindah Sekolah</option>
                                    <option value="Surat Keterangan Aktif Kuliah" {{ request('jenis_surat') == 'Surat Keterangan Aktif Kuliah' ? 'selected' : '' }}>Surat Keterangan Aktif Kuliah</option>
                                    <option value="Lainnya" {{ request('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Cari nomor pengajuan, keperluan, atau nama pemohon..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['status', 'jenis_surat', 'search']))
                                        <a href="{{ route('admin.surat.index') }}" class="btn btn-light">
                                            <i class="ti ti-x"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    @if($pengajuans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Pengajuan</th>
                                        <th>Pemohon</th>
                                        <th>Jenis Surat</th>
                                        <th>Keperluan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajuans as $pengajuan)
                                        <tr>
                                            <td><strong>{{ $pengajuan->nomor_pengajuan }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avtar avtar-xs">
                                                            <i class="ti ti-user"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6 class="mb-0">{{ $pengajuan->user->name }}</h6>
                                                        <small class="text-muted">{{ $pengajuan->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light-primary">
                                                    {{ Str::limit($pengajuan->jenis_surat, 20) }}
                                                </span>
                                            </td>
                                            <td>{{ Str::limit($pengajuan->keperluan, 30) }}</td>
                                            <td>{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $pengajuan->status_badge }}">
                                                    <i class="ti {{ $pengajuan->status_icon }} me-1"></i>
                                                    {{ $pengajuan->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.surat.show', $pengajuan) }}" 
                                                   class="btn btn-sm btn-light-primary" 
                                                   title="Proses">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                @if($pengajuan->file_surat)
                                                    <a href="{{ route('admin.surat.download', $pengajuan) }}" 
                                                       class="btn btn-sm btn-light-success" 
                                                       title="Download">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                @endif
                                                <form action="{{ route('admin.surat.destroy', $pengajuan) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
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
                                Menampilkan {{ $pengajuans->firstItem() }} - {{ $pengajuans->lastItem() }} 
                                dari {{ $pengajuans->total() }} pengajuan
                            </div>
                            <div>
                                {{ $pengajuans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-file-off" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="mt-3 text-muted">Tidak Ada Pengajuan Surat</h5>
                            <p class="text-muted">Belum ada pengajuan surat yang masuk</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection