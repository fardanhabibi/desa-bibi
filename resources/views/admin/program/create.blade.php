@extends('layouts.app')

@section('title', 'Tambah Program')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Program</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.program.store') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" name="nama_program" class="form-control @error('nama_program') is-invalid @enderror" value="{{ old('nama_program') }}" required>
                                @error('nama_program')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}" required min="1900" max="2100">
                                @error('tahun')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Anggaran <span class="text-danger">*</span></label>
                                <input type="number" name="anggaran" class="form-control @error('anggaran') is-invalid @enderror" value="{{ old('anggaran') }}" required step="0.01" min="0">
                                @error('anggaran')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.program.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
