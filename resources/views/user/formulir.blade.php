@extends('layouts.dashboard')
@section('title', 'Download Formulir')
@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Download Formulir</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Formulir yang Tersedia</h5>
                    <span class="d-block text-muted font-size-12">Download formulir yang diperlukan untuk berbagai keperluan administrasi</span>
                </div>
                <div class="card-body">
                    @if($formulir && count($formulir) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Formulir</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formulir as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($formulir->currentPage() - 1) * $formulir->perPage() }}</td>
                                            <td>
                                                <strong>{{ $item->nama_formulir }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-light-info">{{ $item->tanggal_upload ? $item->tanggal_upload->format('d M Y') : '-' }}</span>
                                            </td>
                                            <td>
                                                @if($item->file_url)
                                                    <a href="{{ asset($item->file_url) }}" class="btn btn-sm btn-primary" download>
                                                        <i class="ti ti-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada file</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $formulir->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Belum Ada Formulir</h4>
                            <p>Saat ini belum ada formulir yang tersedia. Silakan kembali lagi nanti.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
