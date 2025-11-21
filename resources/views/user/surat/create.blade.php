@extends('layouts.dashboard')
@section('title', 'Ajukan Surat Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Ajukan Surat Baru</h2>
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
                    <h5 class="mb-0">Form Pengajuan Surat</h5>
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

                    <form action="{{ route('user.surat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label" for="jenis_surat">Jenis Surat <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_surat') is-invalid @enderror" 
                                    id="jenis_surat" 
                                    name="jenis_surat" 
                                    required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="Surat Keterangan Siswa" {{ old('jenis_surat') == 'Surat Keterangan Siswa' ? 'selected' : '' }}>Surat Keterangan Siswa</option>
                                <option value="Surat Izin" {{ old('jenis_surat') == 'Surat Izin' ?
                                    <div class="form-group mb-3">
                        <label class="form-label" for="keperluan">Keperluan <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('keperluan') is-invalid @enderror" 
                               id="keperluan" 
                               name="keperluan" 
                               value="{{ old('keperluan') }}"
                               placeholder="Contoh: Pendaftaran Beasiswa, Melanjutkan Kuliah, dll" 
                               required>
                        @error('keperluan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="keterangan">Keterangan Tambahan (Opsional)</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" 
                                  name="keterangan" 
                                  rows="4" 
                                  placeholder="Jelaskan detail tambahan jika diperlukan">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="file_pendukung">File Pendukung (Opsional)</label>
                        <input type="file" 
                               class="form-control @error('file_pendukung') is-invalid @enderror" 
                               id="file_pendukung" 
                               name="file_pendukung"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maksimal 2MB. (Contoh: KTP, KK, Raport, dll)</small>
                        @error('file_pendukung')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i>
                        <strong>Catatan:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pastikan data yang Anda masukkan sudah benar dan sesuai</li>
                            <li>Proses verifikasi akan dilakukan oleh admin maksimal 3 hari kerja</li>
                            <li>Anda akan mendapatkan notifikasi saat surat sudah siap didownload</li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.surat.index') }}" class="btn btn-light">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-send me-1"></i> Ajukan Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
````