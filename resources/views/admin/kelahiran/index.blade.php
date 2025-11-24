@extends('layouts.dashboard')
@section('title', 'Manajemen Kelahiran')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-baby-carriage me-2"></i>Manajemen Data Kelahiran</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelahiran</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kelahiran</h5>
                    <a href="{{ route('admin.kelahiran.create') }}" class="btn btn-sm btn-primary">
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
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Ibu..." value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-primary" type="submit"><i class="ti ti-search"></i></button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Anak</th>
                                    <th>Ibu</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Tempat Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelahiran as $item)
                                <tr>
                                    <td><strong>{{ $item->nama_anak }}</strong></td>
                                    <td>{{ $item->ibu->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>
                                        <a href="{{ route('admin.kelahiran.show', $item) }}" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.kelahiran.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.kelahiran.destroy', $item) }}" method="POST" style="display:inline;">
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

                    {{ $kelahiran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
