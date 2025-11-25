@extends('layouts.app')

@section('title', 'Edit Migrasi')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Edit Migrasi</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.migrasi.update', $migrasi) }}" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Penduduk <span class="text-danger">*</span></label>
                                <input type="text" name="nama_penduduk" class="form-control @error('nama_penduduk') is-invalid @enderror" value="{{ old('nama_penduduk', $migrasi->penduduk_nik) }}" required>
                                @error('nama_penduduk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Jenis Migrasi <span class="text-danger">*</span></label>
                                <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Masuk" {{ old('jenis', $migrasi->jenis) == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ old('jenis', $migrasi->jenis) == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                                @error('jenis')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal/Tujuan Daerah <span class="text-danger">*</span></label>
                                <input type="text" name="asal_tujuan" class="form-control @error('asal_tujuan') is-invalid @enderror" value="{{ old('asal_tujuan', $migrasi->asal_tujuan) }}" required>
                                @error('asal_tujuan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Migrasi <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $migrasi->tanggal ? $migrasi->tanggal->format('Y-m-d') : null) }}" required>
                                @error('tanggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
