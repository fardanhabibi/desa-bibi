@extends('layouts.app')
@section('title', 'Create Download Formulir')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Tambah Formulir</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Formulir Tambah Download</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.formulir.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Formulir</label>
                            <input type="text" class="form-control @error('nama_formulir') is-invalid @enderror" name="nama_formulir" value="{{ old('nama_formulir') }}" required>
                            @error('nama_formulir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File URL</label>
                            <input type="text" class="form-control @error('file_url') is-invalid @enderror" name="file_url" value="{{ old('file_url') }}" placeholder="/path/to/file.pdf">
                            @error('file_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Upload</label>
                            <input type="date" class="form-control @error('tanggal_upload') is-invalid @enderror" name="tanggal_upload" value="{{ old('tanggal_upload', now()->toDateString()) }}" required>
                            @error('tanggal_upload')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.formulir.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
