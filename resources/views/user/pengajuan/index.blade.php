@extends('layouts.dashboard')
@section('title', 'Pengajuan Surat Saya')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengajuan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengajuan Surat Saya</h2>
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
                            <div class="avtar avtar-s bg-light-primary">
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
                    <h5 class="mb-0">Daftar Pengajuan Surat</h5>
                    <a href="{{ route('user.surat.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Ajukan Surat Baru
                    </a>
                </div>
                <div class="card-body">
                    <!-- Filter & Search (mirip admin) -->
                    <form method="GET" action="{{ route('user.pengajuan.index') }}" class="mb-4">
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
                                    @if(isset($jenisSurat) && $jenisSurat->isNotEmpty())
                                        @foreach($jenisSurat as $jenis)
                                            <option value="{{ $jenis->id }}" {{ (string)request('jenis_surat') === (string)$jenis->id ? 'selected' : '' }}>{{ $jenis->nama_surat }}</option>
                                        @endforeach
                                    @else
                                        <option value="Surat Keterangan Domisili" {{ request('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                        <option value="Surat Keterangan Usaha" {{ request('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                                        <option value="Surat Keterangan Tidak Mampu" {{ request('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                                        <option value="Surat Keterangan Kelahiran" {{ request('jenis_surat') == 'Surat Keterangan Kelahiran' ? 'selected' : '' }}>Surat Keterangan Kelahiran</option>
                                        <option value="Surat Keterangan Kematian" {{ request('jenis_surat') == 'Surat Keterangan Kematian' ? 'selected' : '' }}>Surat Keterangan Kematian</option>
                                        <option value="Surat Pengantar" {{ request('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                                        <option value="Surat Keterangan Beda Nama" {{ request('jenis_surat') == 'Surat Keterangan Beda Nama' ? 'selected' : '' }}>Surat Keterangan Beda Nama</option>
                                        <option value="Surat Keterangan Lainnya" {{ request('jenis_surat') == 'Surat Keterangan Lainnya' ? 'selected' : '' }}>Surat Keterangan Lainnya</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control" 
                                           placeholder="Cari nomor pengajuan, keperluan, atau jenis surat..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-search"></i> Cari
                                    </button>
                                    @if(request()->hasAny(['status', 'jenis_surat', 'search']))
                                        <a href="{{ route('user.pengajuan.index') }}" class="btn btn-light">
                                            <i class="ti ti-x"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($pengajuans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Pengajuan</th>
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
                                                <span class="badge bg-light-primary">
                                                    {{ $pengajuan->jenisSurat->nama_surat ?? $pengajuan->jenis_surat }}
                                                </span>
                                            </td>
                                            <td>{{ Str::limit($pengajuan->keperluan, 40) }}</td>
                                            <td>{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $pengajuan->status_badge }}">
                                                    <i class="ti {{ $pengajuan->status_icon }} me-1"></i>
                                                    {{ $pengajuan->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('user.surat.show', $pengajuan) }}" 
                                                   class="btn btn-sm btn-light-primary" 
                                                   title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                
                                                @if($pengajuan->status === 'Disetujui' && $pengajuan->file_surat)
                                                    <a href="{{ route('user.surat.download', $pengajuan) }}" 
                                                       class="btn btn-sm btn-light-success" 
                                                       title="Download Surat">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                @endif

                                                @if($pengajuan->status === 'Pending')
                                                    <form action="{{ route('user.surat.destroy', $pengajuan) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
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
                                Menampilkan {{ $pengajuans->firstItem() }} - {{ $pengajuans->lastItem() }} 
                                dari {{ $pengajuans->total() }} pengajuan
                            </div>
                            <div>
                                {{ $pengajuans->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-file-off" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="mt-3 text-muted">Belum Ada Pengajuan Surat</h5>
                            <p class="text-muted">Anda belum mengajukan surat apapun</p>
                            <a href="{{ route('user.surat.create') }}" class="btn btn-primary mt-2">
                                <i class="ti ti-plus me-1"></i> Ajukan Surat Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection