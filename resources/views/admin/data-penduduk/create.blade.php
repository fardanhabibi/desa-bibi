@extends('layouts.dashboard')
@section('title', 'Tambah Penduduk Baru')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tambah Penduduk Baru</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.data-penduduk.index') }}">Data Penduduk</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Penduduk</li>
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
                        <h5 class="mb-0">Form Pendaftaran Penduduk</h5>
                        <small class="text-muted">Isi semua kolom yang diperlukan untuk menambahkan penduduk baru</small>
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

                        <form action="{{ route('admin.data-penduduk.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

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
                                    value="{{ old('name') }}"
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
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">Email harus unik dan belum terdaftar di sistem</small>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label fw-600" for="password">
                                    <i class="ti ti-lock me-2" style="color: #1e3c72;"></i>Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Masukkan password minimal 8 karakter"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">Minimum 8 karakter dengan kombinasi huruf dan angka</small>
                            </div>

                            <!-- Verifikasi Status -->
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="is_verified" 
                                        name="is_verified"
                                        value="1"
                                        {{ old('is_verified') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-600" for="is_verified">
                                        <i class="ti ti-check me-2" style="color: #198754;"></i>Tandai sebagai Terverifikasi
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-2">Jika diaktifkan, penduduk langsung dapat mengakses sistem</small>
                            </div>

                            <!-- Separator -->
                            <hr class="my-4">

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Simpan Penduduk
                                </button>
                                <a href="{{ route('admin.data-penduduk.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-x me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="col-md-4">
                <div class="card modern-card border-0" style="background: linear-gradient(135deg, rgba(30, 60, 114, 0.05), rgba(255, 215, 0, 0.05));">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="ti ti-info-circle me-2" style="color: #1e3c72;"></i>Informasi Penting
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">Email Unik</strong>
                                <small class="text-muted">Setiap penduduk harus memiliki email yang berbeda dan belum terdaftar</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">Password Aman</strong>
                                <small class="text-muted">Gunakan password yang kuat dengan minimal 8 karakter</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">Verifikasi</strong>
                                <small class="text-muted">Penduduk yang belum terverifikasi tidak dapat login ke sistem</small>
                            </li>
                            <li>
                                <strong class="d-block mb-1">Data Tersimpan</strong>
                                <small class="text-muted">Data penduduk akan tersimpan dengan aman di basis data sistem</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Required Fields Info -->
                <div class="card modern-card border-warning bg-light-warning mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-alert-circle me-2" style="color: #ffc107; font-size: 1.2rem;"></i>
                            <div>
                                <h6 class="mb-1 text-warning">Kolom Wajib Diisi</h6>
                                <small class="text-muted d-block">Tanda <span class="text-danger">*</span> menunjukkan kolom yang harus diisi sebelum menyimpan data</small>
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
    </style>
@endsection
