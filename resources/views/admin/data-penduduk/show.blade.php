@extends('layouts.dashboard')
@section('title', 'Detail Penduduk - ' . $resident->name)

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail Data Penduduk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.data-penduduk.index') }}">Data Penduduk</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $resident->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Main Info Card -->
            <div class="col-md-8">
                <div class="card modern-card">
                    <div class="card-body">
                        <!-- Profile Header -->
                        <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                            <div class="avtar avtar-xl rounded-circle bg-light-primary me-4">
                                <img src="{{ $resident->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($resident->name) }}" alt="{{ $resident->name }}">
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="mb-1 fw-bold">{{ $resident->name }}</h4>
                                <small class="text-muted">
                                    <i class="ti ti-calendar me-1"></i>Terdaftar: {{ $resident->created_at ? $resident->created_at->format('d M Y H:i') : '-' }}
                                </small>
                            </div>
                            @if($resident->is_verified)
                                <div class="badge bg-success" style="height: fit-content;">
                                    <i class="ti ti-check me-1"></i>Terverifikasi
                                </div>
                            @else
                                <div class="badge bg-warning" style="height: fit-content;">
                                    <i class="ti ti-clock me-1"></i>Belum Terverifikasi
                                </div>
                            @endif
                        </div>

                        <!-- Detail Information -->
                        <div class="row g-4">
                            <!-- Email Section -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-mail me-2" style="color: #1e3c72;"></i>Email
                                    </label>
                                    <p class="detail-value">
                                        <a href="mailto:{{ $resident->email }}" class="text-decoration-none fw-600">{{ $resident->email }}</a>
                                    </p>
                                </div>
                            </div>

                            <!-- Verification Status Section -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-shield-check me-2" style="color: #1e3c72;"></i>Status Verifikasi
                                    </label>
                                    <p class="detail-value">
                                        @if($resident->is_verified)
                                            <span class="badge bg-light-success text-success fw-600">
                                                <i class="ti ti-check-circle me-1"></i>Terverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-light-warning text-warning fw-600">
                                                <i class="ti ti-clock me-1"></i>Belum Terverifikasi
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Registration Date -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-calendar-event me-2" style="color: #1e3c72;"></i>Tanggal Pendaftaran
                                    </label>
                                    <p class="detail-value fw-600">{{ $resident->created_at ? $resident->created_at->format('d M Y') : '-' }}</p>
                                    <small class="text-muted">{{ $resident->created_at ? $resident->created_at->format('H:i') : '-' }}</small>
                                </div>
                            </div>

                            <!-- Provider -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-brand-google me-2" style="color: #1e3c72;"></i>Metode Pendaftaran
                                    </label>
                                    <p class="detail-value fw-600">{{ ucfirst($resident->provider ?? 'Manual') }}</p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-clock-edit me-2" style="color: #1e3c72;"></i>Terakhir Diperbarui
                                    </label>
                                    <p class="detail-value fw-600">{{ $resident->updated_at ? $resident->updated_at->format('d M Y H:i') : '-' }}</p>
                                </div>
                            </div>

                            <!-- User ID -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="ti ti-hash me-2" style="color: #1e3c72;"></i>ID Pengguna
                                    </label>
                                    <p class="detail-value fw-600">{{ $resident->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info Card -->
                <div class="card modern-card mt-4">
                    <div class="card-header bg-transparent border-bottom">
                        <h6 class="mb-0">
                            <i class="ti ti-info-circle me-2" style="color: #1e3c72;"></i>Informasi Sistem
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="alert alert-light border-start border-4 border-primary" style="border-left-color: #1e3c72 !important;">
                                    <strong>Status Akses:</strong>
                                    @if($resident->is_verified)
                                        <span class="badge bg-success ms-2">Dapat Mengakses Sistem</span>
                                        <p class="mt-2 mb-0 text-muted"><small>Penduduk ini dapat login dan menggunakan semua fitur sistem Desa Bibi</small></p>
                                    @else
                                        <span class="badge bg-warning ms-2">Akses Dibatasi</span>
                                        <p class="mt-2 mb-0 text-muted"><small>Penduduk belum dapat login hingga diverifikasi oleh admin</small></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="card modern-card">
                    <div class="card-header bg-transparent border-bottom">
                        <h6 class="mb-0">
                            <i class="ti ti-list-check me-2" style="color: #1e3c72;"></i>Aksi Cepat
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.data-penduduk.edit', $resident) }}" class="btn btn-primary">
                                <i class="ti ti-edit me-2"></i>Edit Data
                            </a>
                            <a href="{{ route('admin.data-penduduk.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                            <form action="{{ route('admin.data-penduduk.destroy', $resident) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Yakin ingin menghapus penduduk ini? Tindakan ini tidak dapat dibatalkan.')">
                                    <i class="ti ti-trash me-2"></i>Hapus Penduduk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card modern-card mt-3" style="background: linear-gradient(135deg, rgba(30, 60, 114, 0.05), rgba(255, 215, 0, 0.05));">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="ti ti-chart-line me-2" style="color: #1e3c72;"></i>Statistik
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1">Durasi Terdaftar</small>
                                <span class="fw-600">{{ now()->diff($resident->created_at)->days }} hari</span>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1">Status Verifikasi</small>
                                @if($resident->is_verified)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-warning">Tertunda</span>
                                @endif
                            </li>
                            <li>
                                <small class="text-muted d-block mb-1">Tipe Pendaftar</small>
                                <span class="fw-600">Sistem Desa Bibi</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Verification Info Card -->
                <div class="card modern-card mt-3 border-info bg-light-info">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-info-circle me-2" style="color: #0dcaf0; font-size: 1.2rem;"></i>
                            <div>
                                <h6 class="mb-2 text-info">Catatan Verifikasi</h6>
                                <small class="text-muted">
                                    @if($resident->is_verified)
                                        Penduduk telah diverifikasi dan dapat mengakses semua fitur sistem. Anda dapat mengedit data atau menghapus akun jika diperlukan.
                                    @else
                                        Penduduk ini belum terverifikasi. Edit data penduduk untuk mengubah status verifikasi dan mengaktifkan akses ke sistem.
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <style>
        .modern-card {
            background: white;
            border-radius: 16px;
            border: 2px solid transparent;
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(30, 60, 114, 0.15);
            border-color: rgba(255, 215, 0, 0.3);
        }

        .avtar-xl {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid rgba(30, 60, 114, 0.1);
        }

        .avtar-xl img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-item {
            padding: 1rem;
            border-radius: 12px;
            background: rgba(30, 60, 114, 0.03);
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: rgba(30, 60, 114, 0.08);
        }

        .detail-label {
            display: block;
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            margin: 0;
            color: #1e3c72;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(30, 60, 114, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-outline-danger {
            border: 1.5px solid #dc3545;
            color: #dc3545;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }

        .bg-light-success {
            background-color: rgba(25, 135, 84, 0.1) !important;
        }

        .text-success {
            color: #198754 !important;
        }

        .bg-light-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .bg-light-info {
            background-color: rgba(13, 202, 240, 0.1) !important;
        }

        .text-info {
            color: #0dcaf0 !important;
        }

        .border-start {
            border-left: 4px solid rgba(30, 60, 114, 0.2) !important;
        }

        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
@endsection
