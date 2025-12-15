@extends('layouts.app')

@section('title', 'Agenda Desa')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title"><i class="ti ti-calendar me-2"></i>Agenda Desa</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Tambah Agenda
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
                                        <th>Nama Acara</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Jam Mulai</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($agenda as $item)
                                        <tr>
                                            <td>{{ ($agenda->currentPage() - 1) * $agenda->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->nama_acara }}</td>
                                            <td>{{ $item->lokasi ?? '-' }}</td>
                                            <td>{{ $item->tanggal_mulai?->format('d M Y') ?? '-' }}</td>
                                            <td>{{ $item->tanggal_selesai?->format('H:i') ?? '-' }}</td>
                                            <td>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.agenda.show', $item->id) }}" class="btn btn-icon btn-ghost-primary btn-sm">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.agenda.edit', $item->id) }}" class="btn btn-icon btn-ghost-warning btn-sm">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.agenda.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                            <td colspan="6" class="text-center text-muted py-4">Tidak ada data agenda</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $agenda->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
