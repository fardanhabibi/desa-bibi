@extends('layouts.app')
@section('title', 'Create Forum Diskusi')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Tambah Topik Forum</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Formulir Tambah Forum Diskusi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.forum.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Topik</label>
                            <input type="text" class="form-control @error('topik') is-invalid @enderror" name="topik" value="{{ old('topik') }}" required>
                            @error('topik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pemilik NIK</label>
                            <input type="text" class="form-control @error('pemilik_nik') is-invalid @enderror" name="pemilik_nik" value="{{ old('pemilik_nik') }}">
                            @error('pemilik_nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Posting</label>
                            <input type="date" class="form-control @error('tanggal_posting') is-invalid @enderror" name="tanggal_posting" value="{{ old('tanggal_posting', now()->toDateString()) }}">
                            @error('tanggal_posting')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="dibuka" {{ old('status') == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
                                <option value="ditutup" {{ old('status') == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.forum.index') }}" class="btn btn-secondary">
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
