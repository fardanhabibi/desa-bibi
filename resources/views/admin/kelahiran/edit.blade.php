@extends('layouts.app')

@section('title', 'Edit Kelahiran')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Edit Kelahiran</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.kelahiran.update', $kelahiran->id) }}" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Bayi <span class="text-danger">*</span></label>
                                <input type="text" name="nama_bayi" class="form-control @error('nama_bayi') is-invalid @enderror" value="{{ old('nama_bayi', $kelahiran->nama_bayi) }}" required>
                                @error('nama_bayi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $kelahiran->tanggal_lahir) }}" required>
                                @error('tanggal_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $kelahiran->tempat_lahir) }}" required>
                                @error('tempat_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu', $kelahiran->nama_ibu) }}" required>
                                @error('nama_ibu')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah', $kelahiran->nama_ayah) }}" required>
                                @error('nama_ayah')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
