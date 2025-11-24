@extends('layouts.app')

@section('title', 'Kegiatan Desa')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title"><i class="ti ti-users-group me-2"></i>Kegiatan Desa</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Tambah Kegiatan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <div>{{ $message }}</div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal</th>
                                        <th>Penanggung Jawab</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kegiatan as $item)
                                        <tr>
                                            <td>{{ ($kegiatan->currentPage() - 1) * $kegiatan->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->nama_kegiatan }}</td>
                                            <td>{{ $item->lokasi ?? '-' }}</td>
                                            <td>{{ $item->tanggal?->format('d M Y') ?? '-' }}</td>
                                            <td>{{ $item->penanggungJawab->nama ?? '-' }}</td>
                                            <td>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.kegiatan.show', $item->id) }}" class="btn btn-icon btn-ghost-primary btn-sm">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.kegiatan.edit', $item->id) }}" class="btn btn-icon btn-ghost-warning btn-sm">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.kegiatan.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-ghost-danger btn-sm">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Tidak ada data kegiatan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $kegiatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
