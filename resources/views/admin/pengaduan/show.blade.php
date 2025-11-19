@extends('layouts.dashboard')
@section('title', 'Detail & Tanggapi Pengaduan')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengaduan.index') }}">Kelola Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Detail & Tanggapi Pengaduan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

            <!-- Detail Pengaduan -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $pengaduan->nomor_pengaduan }}</h5>
                            <span class="badge {{ $pengaduan->status_badge }}">{{ $pengaduan->status }}</span>
                        </div>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Informasi Pengirim -->
                    <div class="alert alert-light d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-l">
                                <i class="ti ti-user f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Informasi Pengirim</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <td width="100"><strong>Nama</strong></td>
                                            <td>: {{ $pengaduan->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>: {{ $pengaduan->user->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <td width="120"><strong>Tanggal Dibuat</strong></td>
                                            <td>: {{ $pengaduan->created_at->format('d F Y, H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kategori</strong></td>
                                            <td>: <span class="badge bg-light-secondary">{{ $pengaduan->kategori }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Judul & Isi Pengaduan -->
                    <div class="mb-4">
                        <h6 class="mb-2">Judul Pengaduan:</h6>
                        <p class="mb-0"><strong>{{ $pengaduan->judul }}</strong></p>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-3">Isi Pengaduan:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($pengaduan->isi_pengaduan)) !!}
                        </div>
                    </div>

                    <!-- File Lampiran -->
                    @if($pengaduan->file_lampiran)
                        <div class="mb-4">
                            <h6 class="mb-3">File Lampiran:</h6>
                            <a href="{{ asset('storage/pengaduan/' . $pengaduan->file_lampiran) }}" 
                               target="_blank" 
                               class="btn btn-light-primary">
                                <i class="ti ti-download me-1"></i> Download File
                            </a>
                        </div>
                    @endif

                    <hr>

                    <!-- Tanggapan yang Sudah Ada -->
                    @if($pengaduan->tanggapan)
                        <div class="alert alert-success mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="mb-0"><i class="ti ti-message-circle me-2"></i>Tanggapan Sebelumnya</h6>
                                <small class="text-muted">
                                    {{ $pengaduan->tanggal_tanggapan->format('d F Y, H:i') }}
                                    @if($pengaduan->admin)
                                        <br>oleh {{ $pengaduan->admin->name }}
                                    @endif
                                </small>
                            </div>
                            <div class="p-3 bg-white rounded">
                                {!! nl2br(e($pengaduan->tanggapan)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Form Tanggapan -->
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="ti ti-message-circle me-2"></i>Form Tanggapan</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label class="form-label" for="status">Status Pengaduan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Pending" {{ old('status', $pengaduan->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Diproses" {{ old('status', $pengaduan->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ old('status', $pengaduan->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Ditolak" {{ old('status', $pengaduan->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label" for="tanggapan">Tanggapan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('tanggapan') is-invalid @enderror" 
                                              id="tanggapan" 
                                              name="tanggapan" 
                                              rows="6" 
                                              placeholder="Tulis tanggapan Anda untuk pengaduan ini..." 
                                              required>{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                                    @error('tanggapan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light">
                                        <i class="ti ti-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-check me-1"></i> Simpan Tanggapan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection