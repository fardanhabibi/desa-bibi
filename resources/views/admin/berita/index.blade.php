@extends('layouts.app')

@section('title', 'Berita & Pengumuman')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title"><i class="ti ti-news me-2"></i>Berita & Pengumuman</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-icon btn-ghost-primary btn-sm">
                        <i class="ti ti-plus me-2"></i>Tambah Berita
                    </a>
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
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Tanggal Posting</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($berita as $item)
                                        <tr>
                                            <td>{{ ($berita->currentPage() - 1) * $berita->perPage() + $loop->iteration }}</td>
                                            <td>{{ Str::limit($item->judul, 50) }}</td>
                                            <td>{{ $item->penulis }}</td>
                                            <td>{{ $item->tanggal_posting?->format('d M Y') ?? '-' }}</td>
                                            <td>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.berita.show', $item) }}" class="btn btn-icon btn-ghost-primary btn-sm">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-icon btn-ghost-warning btn-sm">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.berita.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                            <td colspan="5" class="text-center text-muted py-4">Tidak ada data berita</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $berita->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
