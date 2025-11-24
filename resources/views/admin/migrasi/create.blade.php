@extends('layouts.app')

@section('title', 'Tambah Migrasi')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Migrasi</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.migrasi.store') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Penduduk <span class="text-danger">*</span></label>
                                <input type="text" name="nama_penduduk" class="form-control @error('nama_penduduk') is-invalid @enderror" value="{{ old('nama_penduduk') }}" required>
                                @error('nama_penduduk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Daerah <span class="text-danger">*</span></label>
                                <input type="text" name="asal_daerah" class="form-control @error('asal_daerah') is-invalid @enderror" value="{{ old('asal_daerah') }}" required>
                                @error('asal_daerah')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tujuan Daerah <span class="text-danger">*</span></label>
                                <input type="text" name="tujuan_daerah" class="form-control @error('tujuan_daerah') is-invalid @enderror" value="{{ old('tujuan_daerah') }}" required>
                                @error('tujuan_daerah')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Migrasi <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_migrasi" class="form-control @error('tanggal_migrasi') is-invalid @enderror" value="{{ old('tanggal_migrasi') }}" required>
                                @error('tanggal_migrasi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alasan <span class="text-danger">*</span></label>
                                <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="3" required>{{ old('alasan') }}</textarea>
                                @error('alasan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.migrasi.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
