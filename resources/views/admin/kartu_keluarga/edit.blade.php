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
                    <form method="POST" action="{{ route('admin.kartu_keluarga.update', $kartuKeluarga->id) }}" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">No. Kartu Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="no_kartu_keluarga" class="form-control @error('no_kartu_keluarga') is-invalid @enderror" value="{{ old('no_kartu_keluarga', $kartuKeluarga->no_kartu_keluarga) }}" required>
                                @error('no_kartu_keluarga')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="3" required>{{ old('alamat_lengkap', $kartuKeluarga->alamat_lengkap) }}</textarea>
                                @error('alamat_lengkap')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kepala Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="kepala_keluarga" class="form-control @error('kepala_keluarga') is-invalid @enderror" value="{{ old('kepala_keluarga', $kartuKeluarga->kepala_keluarga) }}" required>
                                @error('kepala_keluarga')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
