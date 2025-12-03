@extends('layouts.app')

@section('title', 'Tambah Kelahiran')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Kelahiran</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.kelahiran.store') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Bayi <span class="text-danger">*</span></label>
                                <input type="text" name="nama_bayi" class="form-control @error('nama_bayi') is-invalid @enderror" value="{{ old('nama_bayi') }}" required>
                                @error('nama_bayi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir (opsional)">
                                    @error('tempat_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ibu (Nama)</label>
                                <input type="text" name="ibu_nama" class="form-control @error('ibu_nama') is-invalid @enderror" value="{{ old('ibu_nama') }}" placeholder="Masukkan Nama Ibu (opsional)">
                                @error('ibu_nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ayah (Nama)</label>
                                <input type="text" name="ayah_nama" class="form-control @error('ayah_nama') is-invalid @enderror" value="{{ old('ayah_nama') }}" placeholder="Masukkan Nama Ayah (opsional)">
                                @error('ayah_nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="kk_no" class="form-control @error('kk_no') is-invalid @enderror" value="{{ old('kk_no') }}" placeholder="Masukkan No. KK (mis. 0999...)" required>
                                @error('kk_no')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">Pilih...</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kelahiran.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
