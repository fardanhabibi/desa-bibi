@extends('layouts.app')
@section('title', 'Detail Layanan Online')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Detail Layanan Online</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Layanan Online</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Layanan</label>
                        <p class="form-control-plaintext">{{ $layanan->nama_layanan }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <p class="form-control-plaintext">{{ $layanan->kategori ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <p class="form-control-plaintext">{{ $layanan->deskripsi ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="form-control-plaintext">
                            @if($layanan->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-warning">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
