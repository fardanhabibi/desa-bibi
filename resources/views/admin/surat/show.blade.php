@extends('layouts.dashboard')
@section('title', 'Proses Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.surat.index') }}">Kelola Pengajuan Surat</a></li>
                        <li class="breadcrumb-item"
                        <!-- Content -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="ti ti-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Detail Pengajuan -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $surat->nomor_pengajuan }}</h5>
                        <span class="badge {{ $surat->status_badge }}">
                            <i class="ti {{ $surat->status_icon }} me-1"></i>
                            {{ $surat->status }}
                        </span>
                    </div>
                    <a href="{{ route('admin.surat.index') }}" class="btn btn-light">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Informasi Pemohon -->
                <div class="alert alert-light d-flex align-items-start mb-4">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-l">
                            <i class="ti ti-user f-24"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-2">Informasi Pemohon</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-sm mb-0">
                                    <tr>
                                        <td width="120"><strong>Nama</strong></td>
                                        <td>: {{ $surat->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>: {{ $surat->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-sm mb-0">
                                    <tr>
                                        <td width="150"><strong>Tanggal Pengajuan</strong></td>
                                        <td>: {{ $surat->created_at->format('d F Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Verifikasi</strong></td>
                                        <td>: 
                                            @if($surat->user->is_verified)
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning">Belum Terverifikasi</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Pengajuan Surat -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="180"><strong>Jenis Surat</strong></td>
                                <td>: <span class="badge bg-light-primary">{{ $surat->jenis_surat }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Keperluan</strong></td>
                                <td>: {{ $surat->keperluan }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="180"><strong>Status Saat Ini</strong></td>
                                <td>: 
                                    <span class="badge {{ $surat->status_badge }}">
                                        <i class="ti {{ $surat->status_icon }} me-1"></i>
                                        {{ $surat->status }}
                                    </span>
                                </td>
                            </tr>
                            @if($surat->file_pendukung)
                                <tr>
                                    <td><strong>File Pendukung</strong></td>
                                    <td>: 
                                        <a href="{{ asset('storage/surat/pendukung/' . $surat->file_pendukung) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-light-primary">
                                            <i class="ti ti-paperclip me-1"></i> Lihat File
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Keterangan Tambahan -->
                @if($surat->keterangan)
                    <div class="mb-4">
                        <h6 class="mb-3">Keterangan Tambahan dari Pemohon:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($surat->keterangan)) !!}
                        </div>
                    </div>
                @endif

                <!-- Timeline -->
                <div class="mb-4">
                    <h6 class="mb-3">Timeline Proses:</h6>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="p-3 border rounded {{ $surat->created_at ? 'border-success bg-light-success' : '' }}">
                                <i class="ti ti-send f-24 {{ $surat->created_at ? 'text-success' : 'text-muted' }}"></i>
                                <h6 class="mt-2 mb-1">Diajukan</h6>
                                <small class="text-muted">{{ $surat->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 border rounded {{ $surat->tanggal_diproses ? 'border-success bg-light-success' : '' }}">
                                <i class="ti ti-refresh f-24 {{ $surat->tanggal_diproses ? 'text-success' : 'text-muted' }}"></i>
                                <h6 class="mt-2 mb-1">Diproses</h6>
                                <small class="text-muted">
                                    {{ $surat->tanggal_diproses ? $surat->tanggal_diproses->format('d/m/Y H:i') : '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 border rounded {{ $surat->tanggal_selesai ? 'border-success bg-light-success' : '' }}">
                                <i class="ti ti-check f-24 {{ $surat->tanggal_selesai ? 'text-success' : 'text-muted' }}"></i>
                                <h6 class="mt-2 mb-1">Selesai</h6>
                                <small class="text-muted">
                                    {{ $surat->tanggal_selesai ? $surat->tanggal_selesai->format('d/m/Y H:i') : '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 border rounded {{ $surat->file_surat ? 'border-success bg-light-success' : '' }}">
                                <i class="ti ti-file-check f-24 {{ $surat->file_surat ? 'text-success' : 'text-muted' }}"></i>
                                <h6 class="mt-2 mb-1">File Surat</h6>
                                <small class="text-muted">
                                    {{ $surat->file_surat ? 'Tersedia' : 'Belum' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Form Proses Pengajuan -->
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="ti ti-edit me-2"></i>Form Proses Pengajuan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.surat.update', $surat) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="status">Status Pengajuan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" 
                                                name="status" 
                                                required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Pending" {{ old('status', $surat->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Diproses" {{ old('status', $surat->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="Disetujui" {{ old('status', $surat->status) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="Ditolak" {{ old('status', $surat->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="file_surat">Upload File Surat (PDF)</label>
                                        <input type="file" 
                                               class="form-control @error('file_surat') is-invalid @enderror" 
                                               id="file_surat" 
                                               name="file_surat"
                                               accept=".pdf">
                                        <small class="text-muted">Format: PDF. Maksimal 5MB. Upload saat status Disetujui.</small>
                                        @if($surat->file_surat)
                                            <div class="mt-2">
                                                <span class="badge bg-success">
                                                    <i class="ti ti-check me-1"></i>File surat sudah diupload
                                                </span>
                                                <a href="{{ route('admin.surat.download', $surat) }}" class="btn btn-sm btn-light-primary ms-2">
                                                    <i class="ti ti-download"></i> Download
                                                </a>
                                            </div>
                                        @endif
                                        @error('file_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label" for="catatan_admin">Catatan Admin</label>
                                <textarea class="form-control @error('catatan_admin') is-invalid @enderror" 
                                          id="catatan_admin" 
                                          name="catatan_admin" 
                                          rows="4" 
                                          placeholder="Tulis catatan untuk pemohon (opsional tapi disarankan untuk status Disetujui/Ditolak)">{{ old('catatan_admin', $surat->catatan_admin) }}</textarea>
                                @error('catatan_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-info">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Panduan:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Pending</strong> - Pengajuan belum diproses</li>
                                    <li><strong>Diproses</strong> - Surat sedang dalam proses pembuatan</li>
                                    <li><strong>Disetujui</strong> - Surat sudah selesai, upload file surat untuk didownload pemohon</li>
                                    <li><strong>Ditolak</strong> - Pengajuan ditolak, wajib isi alasan penolakan di catatan</li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.surat.index') }}" class="btn btn-light">
                                    <i class="ti ti-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>