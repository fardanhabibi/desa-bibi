@extends('layouts.dashboard')
@section('title', 'Daftar Pengaduan Saya')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengaduan Saya</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Daftar Pengaduan Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle me-2"></i>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pengaduan</h5>
                    <div class="d-flex gap-2 align-items-center">
                        <form method="GET" class="d-flex" style="min-width:300px">
                            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nomor atau judul..." value="{{ request('search') }}">
                            <button class="btn btn-sm btn-outline-primary" type="submit"><i class="ti ti-search"></i></button>
                        </form>
                        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Ajukan Pengaduan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Statistik singkat --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avtar avtar-s bg-light-secondary"><i class="ti ti-file-text f-18"></i></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted">Total Pengaduan</small>
                                        <div class="h5 mb-0">{{ $stats['total'] ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avtar avtar-s bg-light-warning"><i class="ti ti-clock f-18"></i></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted">Pending</small>
                                        <div class="h5 mb-0">{{ $stats['pending'] ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avtar avtar-s bg-light-info"><i class="ti ti-refresh f-18"></i></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted">Diproses</small>
                                        <div class="h5 mb-0">{{ $stats['diproses'] ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avtar avtar-s bg-light-success"><i class="ti ti-check f-18"></i></div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <small class="text-muted">Selesai</small>
                                        <div class="h5 mb-0">{{ $stats['selesai'] ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($pengaduans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Pengaduan</th>
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
                                            <td>{{ Str::limit($pengaduan->judul, 40) }}</td>
                                            <td><span class="badge bg-light-secondary">{{ $pengaduan->kategori }}</span></td>
                                            <td>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge {{ $pengaduan->status_badge }}">
                                                    {{ $pengaduan->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('user.pengaduan.show', $pengaduan) }}" 
                                                   class="btn btn-sm btn-light-primary" title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                @if($pengaduan->status === 'Pending')
                                                    <form action="{{ route('user.pengaduan.destroy', $pengaduan) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light-danger" title="Hapus">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
                                {{ $pengaduans->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="mt-3 text-muted">Belum Ada Pengaduan</h5>
                            <p class="text-muted">Anda belum mengajukan pengaduan apapun</p>
                            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary mt-2">
                                <i class="ti ti-plus me-1"></i> Ajukan Pengaduan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection