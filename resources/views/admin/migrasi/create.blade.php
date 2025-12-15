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
                                <label class="form-label">Penduduk <span class="text-danger">*</span></label>
                                <select name="penduduk_nik" class="form-select @error('penduduk_nik') is-invalid @enderror" required>
                                    <option value="">Pilih penduduk...</option>
                                    @foreach($penduduk as $p)
                                        <option value="{{ $p->nik }}" {{ old('penduduk_nik') == $p->nik ? 'selected' : '' }}>
                                            {{ $p->nama }} ({{ $p->nik }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('penduduk_nik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Jenis Migrasi <span class="text-danger">*</span></label>
                                <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Masuk" {{ old('jenis') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ old('jenis') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                                @error('jenis')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal/Tujuan Daerah <span class="text-danger">*</span></label>
                                <input type="text" name="asal_tujuan" class="form-control @error('asal_tujuan') is-invalid @enderror" value="{{ old('asal_tujuan') }}" required>
                                @error('asal_tujuan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Migrasi <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
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
