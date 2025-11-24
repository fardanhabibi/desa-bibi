@extends('layouts.app')

@section('title', 'Tambah Kematian')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Kematian</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.kematian.store') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Almarhum <span class="text-danger">*</span></label>
                                <input type="text" name="nama_almarhum" class="form-control @error('nama_almarhum') is-invalid @enderror" value="{{ old('nama_almarhum') }}" required>
                                @error('nama_almarhum')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Meninggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_meninggal" class="form-control @error('tanggal_meninggal') is-invalid @enderror" value="{{ old('tanggal_meninggal') }}" required>
                                @error('tanggal_meninggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penyebab Kematian <span class="text-danger">*</span></label>
                                <input type="text" name="penyebab_kematian" class="form-control @error('penyebab_kematian') is-invalid @enderror" value="{{ old('penyebab_kematian') }}" required>
                                @error('penyebab_kematian')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor" class="form-control @error('nama_pelapor') is-invalid @enderror" value="{{ old('nama_pelapor') }}" required>
                                @error('nama_pelapor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kematian.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
