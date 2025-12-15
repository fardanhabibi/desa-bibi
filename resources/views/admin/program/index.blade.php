@extends('layouts.dashboard')
@section('title', 'Manajemen Program Desa')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-chart-bar me-2"></i>Manajemen Program Desa</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Program</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Program Desa</h5>
                    <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-plus me-1"></i> Tambah Baru
                    </a>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Program..." value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-primary" type="submit"><i class="ti ti-search"></i></button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Program</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($program as $item)
                                <tr>
                                    <td><strong>{{ $item->nama_program }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->status == 'berlangsung' ? 'success' : ($item->status == 'selesai' ? 'info' : 'warning') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.kegiatan.index') }}" method="GET" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')" title="Hapus">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $program->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
