@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <i class="ti ti-users me-2"></i>Data Penduduk
                    </h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Tambah Penduduk
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
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-truncate">
                                    <div class="mb-3">
                                        <input type="text" class="form-control d-inline-block w-25 me-3" placeholder="Cari nama, NIK atau email..." value="{{ request('search') }}" id="searchInput">
                                        <button class="btn btn-outline-secondary" onclick="document.getElementById('searchForm').submit()">
                                            <i class="ti ti-search"></i>Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penduduk as $item)
                                        <tr>
                                            <td>{{ ($penduduk->currentPage() - 1) * $penduduk->perPage() + $loop->iteration }}</td>
                                            <td><span class="font-monospace">{{ $item->nik }}</span></td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                @php
                                                    $jk = strtolower(trim($item->jenis_kelamin ?? ''));
                                                    if (in_array($jk, ['l', 'laki', 'laki-laki', 'male'])) {
                                                        $jkLabel = 'Laki-laki';
                                                        $jkClass = 'bg-blue';
                                                    } elseif (in_array($jk, ['p', 'perempuan', 'female'])) {
                                                        $jkLabel = 'Perempuan';
                                                        $jkClass = 'bg-pink';
                                                    } else {
                                                        $jkLabel = $item->jenis_kelamin ?? '-';
                                                        $jkClass = 'bg-secondary';
                                                    }
                                                @endphp
                                                <span class="badge {{ $jkClass }}">{{ $jkLabel }}</span>
                                                <small class="text-muted ms-1">{{ $jkLabel }}</small>
                                            </td>
                                            <td>{{ Str::limit($item->alamat ?? '-', 30) }}</td>
                                            <td>{{ $item->no_hp ?? '-' }}</td>
                                            <td>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.penduduk.show', $item->nik) }}" class="btn btn-icon btn-ghost-primary btn-sm">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.penduduk.edit', $item->nik) }}" class="btn btn-icon btn-ghost-warning btn-sm">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.penduduk.destroy', $item->nik) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                            <td colspan="7" class="text-center text-muted py-4">Tidak ada data penduduk</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $penduduk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="searchForm" method="GET" action="{{ route('admin.penduduk.index') }}" style="display:none;">
    <input type="hidden" name="search" id="searchHidden" value="{{ request('search') }}">
</form>

<script>
    document.querySelector('input[placeholder*="Cari nama"]').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('searchHidden').value = this.value;
            document.getElementById('searchForm').submit();
        }
    });
</script>
@endsection
