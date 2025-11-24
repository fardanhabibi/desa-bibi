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
                            <h5 class="m-b-10">Lengkapi Data Penduduk</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.biodata') }}">Data Penduduk</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit</li>
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
                        <h5 class="mb-0">Form Data Penduduk</h5>
                        <small class="text-muted">Isi semua informasi data diri Anda dengan benar</small>
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

                        <form action="{{ route('user.biodata.update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="row g-3">
                                <!-- NIK -->
                                <div class="col-md-12">
                                    <label class="form-label fw-600" for="nik">
                                        <i class="ti ti-id me-2" style="color: #1e3c72;"></i>Nomor Induk Kependudukan (NIK)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('nik') is-invalid @enderror" 
                                        id="nik" 
                                        name="nik" 
                                        placeholder="Masukkan NIK (16 digit)"
                                        value="{{ old('nik', $user->nik) }}"
                                        maxlength="16"
                                        required>
                                    @error('nik')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="tempat_lahir">
                                        <i class="ti ti-map-pin me-2" style="color: #1e3c72;"></i>Tempat Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                        id="tempat_lahir" 
                                        name="tempat_lahir" 
                                        placeholder="Contoh: Jakarta"
                                        value="{{ old('tempat_lahir', $user->tempat_lahir) }}"
                                        required>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="tanggal_lahir">
                                        <i class="ti ti-calendar me-2" style="color: #1e3c72;"></i>Tanggal Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                        id="tanggal_lahir" 
                                        name="tanggal_lahir" 
                                        value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                                        required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status Perkawinan -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="status_perkawinan">
                                        <i class="ti ti-heart me-2" style="color: #1e3c72;"></i>Status Perkawinan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control @error('status_perkawinan') is-invalid @enderror" 
                                            id="status_perkawinan" 
                                            name="status_perkawinan" 
                                            required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                    @error('status_perkawinan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nomor Telpon -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="nomor_telpon">
                                        <i class="ti ti-phone me-2" style="color: #1e3c72;"></i>Nomor Telepon
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        class="form-control @error('nomor_telpon') is-invalid @enderror" 
                                        id="nomor_telpon" 
                                        name="nomor_telpon" 
                                        placeholder="Contoh: 08123456789 atau +6281234567890"
                                        value="{{ old('nomor_telpon', $user->nomor_telpon) }}"
                                        required>
                                    @error('nomor_telpon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Dimulai dengan 0 atau +62, total 10-14 digit</small>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12">
                                    <label class="form-label fw-600" for="alamat">
                                        <i class="ti ti-home me-2" style="color: #1e3c72;"></i>Alamat Lengkap
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea 
                                        class="form-control @error('alamat') is-invalid @enderror" 
                                        id="alamat" 
                                        name="alamat" 
                                        rows="3"
                                        placeholder="Masukkan alamat lengkap Anda"
                                        required>{{ old('alamat', $user->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kota -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="kota">
                                        <i class="ti ti-building me-2" style="color: #1e3c72;"></i>Kota/Kabupaten
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('kota') is-invalid @enderror" 
                                        id="kota" 
                                        name="kota" 
                                        placeholder="Contoh: Jakarta Selatan"
                                        value="{{ old('kota', $user->kota) }}"
                                        required>
                                    @error('kota')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="provinsi">
                                        <i class="ti ti-map me-2" style="color: #1e3c72;"></i>Provinsi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('provinsi') is-invalid @enderror" 
                                        id="provinsi" 
                                        name="provinsi" 
                                        placeholder="Contoh: DKI Jakarta"
                                        value="{{ old('provinsi', $user->provinsi) }}"
                                        required>
                                    @error('provinsi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kode Pos -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="kode_pos">
                                        <i class="ti ti-mailbox me-2" style="color: #1e3c72;"></i>Kode Pos
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('kode_pos') is-invalid @enderror" 
                                        id="kode_pos" 
                                        name="kode_pos" 
                                        placeholder="Contoh: 12345"
                                        value="{{ old('kode_pos', $user->kode_pos) }}"
                                        maxlength="5"
                                        required>
                                    @error('kode_pos')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">5 digit angka</small>
                                </div>

                                <!-- Email (Read-only) -->
                                <div class="col-md-6">
                                    <label class="form-label fw-600" for="email">
                                        <i class="ti ti-mail me-2" style="color: #1e3c72;"></i>Email
                                    </label>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        value="{{ $user->email }}"
                                        disabled>
                                    <small class="text-muted d-block mt-1">Email terdaftar di sistem</small>
                                </div>
                            </div>

                            <!-- Separator -->
                            <hr class="my-4">

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Simpan Data
                                </button>
                                <a href="{{ route('user.biodata') }}" class="btn btn-secondary">
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
                            <i class="ti ti-info-circle me-2" style="color: #1e3c72;"></i>Panduan Pengisian
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">NIK</strong>
                                <small class="text-muted">Nomor Induk Kependudukan 16 digit dari KTP</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">Tanggal Lahir</strong>
                                <small class="text-muted">Format: Tanggal bulan tahun sesuai akta kelahiran</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-1">Nomor Telepon</strong>
                                <small class="text-muted">Nomor aktif yang dapat dihubungi</small>
                            </li>
                            <li>
                                <strong class="d-block mb-1">Kode Pos</strong>
                                <small class="text-muted">5 digit kode pos wilayah Anda</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card modern-card border-warning bg-light-warning mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-alert-circle me-2" style="color: #ffc107; font-size: 1.2rem;"></i>
                            <div>
                                <h6 class="mb-1 text-warning">Data Penting</h6>
                                <small class="text-muted d-block">Data yang Anda isikan akan digunakan untuk keperluan administrasi desa. Pastikan semua informasi akurat.</small>
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

        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
            background-color: #fff;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus, .form-select.is-invalid:focus {
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
    </style>
@endsection
