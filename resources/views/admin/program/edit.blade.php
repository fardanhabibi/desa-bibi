@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Edit Program</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-warning">Modul Program Desa telah diarsipkan dan dihapus dari menu. Gunakan <a href="{{ route('admin.kegiatan.index') }}">Kegiatan</a> untuk manajemen konten terkait.</div>
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-primary">Kembali ke Kegiatan</a>
                        </div>
                    </div>
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" name="nama_program" class="form-control @error('nama_program') is-invalid @enderror" value="{{ old('nama_program', $program->nama_program) }}" required>
                                @error('nama_program')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $program->tahun) }}" required min="1900" max="2100">
                                @error('tahun')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Anggaran <span class="text-danger">*</span></label>
                                <input type="number" name="anggaran" class="form-control @error('anggaran') is-invalid @enderror" value="{{ old('anggaran', $program->anggaran) }}" required step="0.01" min="0">
                                @error('anggaran')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                                @error('deskripsi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-link">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
