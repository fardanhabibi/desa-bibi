@extends('layouts.app')

@section('title', 'Edit Kartu Keluarga')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Edit Kartu Keluarga</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
    <form method="POST" action="{{ route('admin.kartu_keluarga.update', $kartu_keluarga->id) }}" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk', $kartu_keluarga->no_kk) }}" placeholder="16 digit" required>
                                @error('no_kk')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kepala Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="kepala_keluarga" class="form-control @error('kepala_keluarga') is-invalid @enderror" value="{{ old('kepala_keluarga', $kartu_keluarga->kepala_keluarga) }}" required>
                                @error('kepala_keluarga')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $kartu_keluarga->alamat) }}</textarea>
                                @error('alamat')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">RT</label>
                                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt', $kartu_keluarga->rt) }}">
                                        @error('rt')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">RW</label>
                                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw', $kartu_keluarga->rw) }}">
                                        @error('rw')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Dusun</label>
                                        <input type="text" name="dusun" class="form-control @error('dusun') is-invalid @enderror" value="{{ old('dusun', $kartu_keluarga->dusun) }}">
                                        @error('dusun')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
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
