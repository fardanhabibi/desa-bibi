@extends('layouts.dashboard')
@section('title', 'Data Penduduk')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Penduduk Saya</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Data Penduduk</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        @if (!$user->nik)
            <!-- Belum lengkap -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>
                            <i class="ti ti-alert-circle me-2"></i>Data Penduduk Belum Lengkap
                        </strong>
                        <p class="mt-2 mb-2">Mohon segera lengkapi data penduduk Anda untuk mengakses semua fitur sistem.</p>
                        <a href="{{ route('user.biodata.edit') }}" class="btn btn-sm btn-warning">
                            <i class="ti ti-edit me-1"></i>Isi Data Sekarang
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4">
                <div class="card modern-card">
                    <div class="card-body text-center">
                        <div class="avtar avtar-xl rounded-circle bg-light-primary mb-3 mx-auto">
                            <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" 
                                 alt="{{ $user->name }}">
                        </div>
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        
                        @if ($user->nik)
                            <div class="badge bg-success mb-3">
                                <i class="ti ti-check-circle me-1"></i>Data Lengkap
                            </div>
                        @else
                            <div class="badge bg-warning mb-3">
                                <i class="ti ti-alert-circle me-1"></i>Data Belum Lengkap
                            </div>
                        @endif

                        <a href="{{ route('user.biodata.edit') }}" class="btn btn-sm btn-primary w-100">
                            <i class="ti ti-edit me-1"></i>Edit Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Data Details -->
            <div class="col-md-8">
                <div class="card modern-card">
                    <div class="card-header bg-transparent border-bottom">
                        <h6 class="mb-0">
                            <i class="ti ti-user-check me-2" style="color: #1e3c72;"></i>Informasi Pribadi
                        </h6>
                    </div>

                    <div class="card-body">
                        @if ($user->nik)
                            <!-- Data Grid -->
                            <div class="row g-4">
                                <!-- NIK -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-id me-2" style="color: #1e3c72;"></i>NIK
                                        </label>
                                        <p class="detail-value">{{ $user->nik }}</p>
                                    </div>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-map-pin me-2" style="color: #1e3c72;"></i>Tempat Lahir
                                        </label>
                                        <p class="detail-value">{{ $user->tempat_lahir }}</p>
                                    </div>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-calendar me-2" style="color: #1e3c72;"></i>Tanggal Lahir
                                        </label>
                                        <p class="detail-value">{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d F Y') : '-' }}</p>
                                    </div>
                                </div>

                                <!-- Status Perkawinan -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-heart me-2" style="color: #1e3c72;"></i>Status Perkawinan
                                        </label>
                                        <p class="detail-value">{{ $user->status_perkawinan ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-phone me-2" style="color: #1e3c72;"></i>Nomor Telepon
                                        </label>
                                        <p class="detail-value">
                                            <a href="tel:{{ $user->nomor_telpon }}" class="text-decoration-none">
                                                {{ $user->nomor_telpon ?? '-' }}
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-mail me-2" style="color: #1e3c72;"></i>Email
                                        </label>
                                        <p class="detail-value">
                                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                {{ $user->email }}
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-home me-2" style="color: #1e3c72;"></i>Alamat Lengkap
                                        </label>
                                        <p class="detail-value">{{ $user->alamat ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Kota -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-building me-2" style="color: #1e3c72;"></i>Kota/Kabupaten
                                        </label>
                                        <p class="detail-value">{{ $user->kota ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Provinsi -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-map me-2" style="color: #1e3c72;"></i>Provinsi
                                        </label>
                                        <p class="detail-value">{{ $user->provinsi ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Kode Pos -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="ti ti-mailbox me-2" style="color: #1e3c72;"></i>Kode Pos
                                        </label>
                                        <p class="detail-value">{{ $user->kode_pos ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Placeholder untuk data yang belum diisi -->
                            <div class="text-center py-5">
                                <i class="ti ti-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                <h6 class="mt-3 text-muted">Data Penduduk Belum Diisi</h6>
                                <p class="text-muted mb-3">Lengkapi informasi pribadi Anda sekarang</p>
                                <a href="{{ route('user.biodata.edit') }}" class="btn btn-primary">
                                    <i class="ti ti-edit me-1"></i>Isi Data Sekarang
                                </a>
                            </div>
                        @endif
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
            word-break: break-word;
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

        .btn-warning {
            background-color: #ffc107;
            border: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
            border-radius: 6px;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
@endsection
