@extends('layouts.dashboard')
@section('title', 'Edit Data Penduduk')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Data Penduduk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.data-penduduk.index') }}">Data Penduduk</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit: {{ $resident->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-8">
                <div class="card modern-card">
                    <div class="card-header bg-transparent border-bottom-0 pb-0">
                        <h5 class="mb-0">Edit Data Penduduk</h5>
                        <small class="text-muted">Perbarui informasi penduduk sesuai kebutuhan</small>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Terjadi Kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="ti ti-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.data-penduduk.update', $resident) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Profile Info Card -->
                            <div class="alert alert-light border rounded-3 mb-4" style="background: linear-gradient(135deg, rgba(30, 60, 114, 0.03), rgba(255, 215, 0, 0.02));">
                                <div class="d-flex align-items-center">
                                    <div class="avtar avtar-lg rounded-circle bg-light-primary me-3">
                                        <img src="{{ $resident->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($resident->name) }}" alt="{{ $resident->name }}">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $resident->name }}</h6>
                                        <small class="text-muted">Terdaftar: {{ $resident->created_at ? $resident->created_at->format('d M Y H:i') : '-' }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label fw-600" for="name">
                                    <i class="ti ti-user me-2" style="color: #1e3c72;"></i>Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('name', $resident->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-600" for="email">
                                    <i class="ti ti-mail me-2" style="color: #1e3c72;"></i>Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Masukkan alamat email"
                                    value="{{ old('email', $resident->email) }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">Email harus unik. Email ini sedang digunakan: <strong>{{ $resident->email }}</strong></small>
                            </div>

                            <!-- Verifikasi Status -->
                            <div class="mb-3">
                                <label class="form-label fw-600">
                                    <i class="ti ti-shield-check me-2" style="color: #1e3c72;"></i>Status Verifikasi
                                </label>
                                <div class="form-check form-switch p-0">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="is_verified" 
                                        name="is_verified"
                                        value="1"
                                        {{ old('is_verified', $resident->is_verified) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-600" for="is_verified">
                                        @if($resident->is_verified)
                                            <span class="badge bg-success">
                                                <i class="ti ti-check me-1"></i>Terverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="ti ti-clock me-1"></i>Belum Terverifikasi
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-2">Centang untuk mengaktifkan akses penduduk ke sistem</small>
                            </div>

                            <!-- Info Section -->
                            <div class="alert alert-light border rounded-3 mb-4" style="background: rgba(30, 60, 114, 0.03);">
                                <h6 class="mb-2 fw-600">
                                    <i class="ti ti-info-circle me-2" style="color: #1e3c72;"></i>Informasi Tambahan
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block"><strong>Pendaftar:</strong> {{ $resident->provider ?? 'Manual' }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block"><strong>Diperbarui:</strong> {{ $resident->updated_at ? $resident->updated_at->format('d M Y H:i') : '-' }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Separator -->
                            <hr class="my-4">

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.data-penduduk.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-x me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <!-- Profile Summary -->
                <div class="card modern-card border-0" style="background: linear-gradient(135deg, rgba(30, 60, 114, 0.05), rgba(255, 215, 0, 0.05));">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="ti ti-user-circle me-2" style="color: #1e3c72;"></i>Ringkasan Profil
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1 text-muted">Nama</strong>
                                <span class="fw-600">{{ $resident->name }}</span>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1 text-muted">Email</strong>
                                <span class="fw-600">{{ $resident->email }}</span>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1 text-muted">Status</strong>
                                @if($resident->is_verified)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning">Belum Terverifikasi</span>
                                @endif
                            </li>
                            <li>
                                <strong class="d-block mb-1 text-muted">Terdaftar</strong>
                                <span class="fw-600">{{ $resident->created_at ? $resident->created_at->format('d M Y') : '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card modern-card border-0 mt-3">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="ti ti-menu-2 me-2" style="color: #1e3c72;"></i>Aksi Tambahan
                        </h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.data-penduduk.show', $resident) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-eye me-2"></i>Lihat Detail
                            </a>
                            <a href="{{ route('admin.data-penduduk.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Warning Card -->
                <div class="card modern-card border-warning bg-light-warning mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-alert-triangle me-2" style="color: #ff9800; font-size: 1.2rem;"></i>
                            <div>
                                <h6 class="mb-2 text-warning">Catatan Penting</h6>
                                <small class="text-muted">
                                    Perubahan email memerlukan verifikasi ulang. Penduduk harus menggunakan email yang baru untuk login.
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

        .avtar-lg {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
        }

        .avtar-lg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-control {
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
            background-color: #fff;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-label {
            color: #1e3c72;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
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
            padding: 0.6rem 1.5rem;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert {
            border-radius: 12px;
            border: none;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-check-input {
            width: 1.5em;
            height: 1.5em;
            margin-top: 0.25em;
            cursor: pointer;
            border-radius: 6px;
        }

        .form-check-input:checked {
            background-color: #1e3c72;
            border-color: #1e3c72;
        }

        .form-check-label {
            cursor: pointer;
            user-select: none;
        }

        .btn-outline-primary {
            color: #1e3c72;
            border-color: #1e3c72;
        }

        .btn-outline-primary:hover {
            background-color: #1e3c72;
            color: white;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .badge {
            font-weight: 600;
            padding: 0.4em 0.7em;
        }
    </style>
@endsection
