@extends('layouts.app')

@section('title', 'Tambah Kartu Keluarga')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Kartu Keluarga</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.kartu_keluarga.store') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk') }}" required>
                                @error('no_kk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kepala Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="kepala_keluarga" class="form-control @error('kepala_keluarga') is-invalid @enderror" value="{{ old('kepala_keluarga') }}" required>
                                @error('kepala_keluarga')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}">
                                    @error('rt')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw') }}">
                                    @error('rw')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Dusun</label>
                                    <input type="text" name="dusun" class="form-control @error('dusun') is-invalid @enderror" value="{{ old('dusun') }}">
                                    @error('dusun')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kartu_keluarga.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
