@extends('layouts.app')

@section('title', 'Data Surat')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title"><i class="ti ti-file me-2"></i>Data Surat</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.surat.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Tambah Surat
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
                                        <th>No. Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Pemohon</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($surat as $item)
                                        <tr>
                                            <td>{{ ($surat->currentPage() - 1) * $surat->perPage() + $loop->iteration }}</td>
                                            <td>#{{ $item->id }}</td>
                                            <td>{{ $item->jenisSurat->nama_surat ?? '-' }}</td>
                                            <td>{{ $item->pemohon->nama ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $item->status == 'disetujui' ? 'bg-success' : ($item->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->tanggal_pengajuan?->format('d M Y') ?? '-' }}</td>
                                            <td>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.surat.show', $item->id) }}" class="btn btn-icon btn-ghost-primary btn-sm">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.surat.edit', $item->id) }}" class="btn btn-icon btn-ghost-warning btn-sm">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.surat.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                            <td colspan="7" class="text-center text-muted py-4">Tidak ada data surat</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $surat->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
