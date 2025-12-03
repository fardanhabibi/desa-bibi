@extends('layouts.dashboard')
@section('title', 'Ajukan Pengaduan Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.pengaduan.index') }}">Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Pengaduan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Ajukan Pengaduan Baru</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Pengaduan</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label" for="judul">Judul Pengaduan <span class="text-danger">*</span></label>
                            <input type="text" 
                                class="form-control form-control-sm @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul pengaduan" 
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori dihapus dari form sesuai permintaan -->

                        <div class="form-group mb-3">
                            <label class="form-label" for="isi_pengaduan">Isi Pengaduan <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm @error('isi_pengaduan') is-invalid @enderror" 
                                      id="isi_pengaduan" 
                                      name="isi_pengaduan" 
                                      rows="6" 
                                      placeholder="Jelaskan pengaduan Anda secara detail" 
                                      required>{{ old('isi_pengaduan') }}</textarea>
                            @error('isi_pengaduan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" for="file_lampiran">Lampiran (Opsional)</label>
                            <input type="file"
                                class="form-control form-control-sm @error('file_lampiran') is-invalid @enderror"
                                   id="file_lampiran"
                                   name="file_lampiran[]"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   multiple>
                            <small class="text-muted">Tipe file: PDF, JPG, JPEG, PNG. Maks 2MB per file. Anda dapat memilih lebih dari satu file.</small>
                            @error('file_lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('file_lampiran.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Catatan:</strong> Pastikan pengaduan yang Anda ajukan jelas dan detail agar dapat diproses dengan baik.
                        </div>

                        <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
                            <a href="{{ route('user.pengaduan.index') }}" class="btn btn-light w-100 w-sm-auto">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                                <i class="ti ti-send me-1"></i> Kirim Pengaduan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Compact form tweaks for mobile */
    @media (max-width: 576px) {
        #isi_pengaduan { rows: 4; }
        .form-control-sm { padding: .35rem .5rem; font-size: .875rem; }
        .card-body { padding: .85rem; }
    }
</style>
@endsection