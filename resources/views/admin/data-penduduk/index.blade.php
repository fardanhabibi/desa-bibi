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
                            <h5 class="m-b-10">Data Penduduk Desa Urangagung</h5>
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
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-md-6 col-xl-4">
                <div class="card modern-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-2">Total Penduduk</h6>
                                <h3 class="m-0">{{ $totalResidents }}</h3>
                            </div>
                            <div class="dashboard-icon">
                                <i class="ti ti-users-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card modern-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-2">Terverifikasi</h6>
                                <h3 class="m-0 text-success">{{ $verifiedResidents }}</h3>
                            </div>
                            <div class="dashboard-icon" style="color: #198754;">
                                <i class="ti ti-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card modern-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted mb-2">Belum Terverifikasi</h6>
                                <h3 class="m-0 text-warning">{{ $unverifiedResidents }}</h3>
                            </div>
                            <div class="dashboard-icon" style="color: #ffc107;">
                                <i class="ti ti-user-exclamation"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="col-md-12">
                <div class="card modern-card">
                    <div class="card-header bg-transparent border-bottom-0 pb-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="mb-0">Daftar Penduduk</h5>
                            <a href="{{ route('admin.data-penduduk.create') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-plus me-2"></i>Tambah Penduduk
                            </a>
                        </div>

                        <!-- Filter & Search -->
                        <form method="GET" class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari nama, email, atau NIK..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="verification_status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="verified" {{ request('verification_status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                        <option value="unverified" {{ request('verification_status') == 'unverified' ? 'selected' : '' }}>Belum Terverifikasi</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="sort" class="form-control">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Tertua</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                                    <a href="{{ route('admin.data-penduduk.index') }}" class="btn btn-sm btn-secondary">Reset</a>
                                    <a href="{{ route('admin.data-penduduk.export') }}" class="btn btn-sm btn-success">
                                        <i class="ti ti-download me-1"></i>Export CSV
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                                <th class="ps-4">No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>No. HP</th>
                                                <th class="text-end pe-4">Aksi</th>
                                            </tr>
                                </thead>
                                <tbody>
                                    @forelse($residents as $index => $resident)
                                        <tr>
                                            <td class="ps-4">{{ ($residents->currentPage() - 1) * $residents->perPage() + $loop->iteration }}</td>
                                            <td>{{ $resident->nik ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avtar avtar-s rounded-circle bg-light-primary me-2">
                                                        <img src="{{ $resident->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($resident->nama) }}" alt="{{ $resident->nama }}">
                                                    </div>
                                                    <div>
                                                        <span class="fw-600">{{ $resident->nama }}</span>
                                                        <br>
                                                        <small class="text-muted">{{ $resident->pekerjaan ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $jk = strtolower(trim($resident->jenis_kelamin ?? ''));
                                                    if (in_array($jk, ['l', 'laki', 'laki-laki', 'male'])) {
                                                        $jkLabel = 'Laki-laki';
                                                    } elseif (in_array($jk, ['p', 'perempuan', 'female'])) {
                                                        $jkLabel = 'Perempuan';
                                                    } else {
                                                        $jkLabel = $resident->jenis_kelamin ?? '-';
                                                    }
                                                @endphp
                                                {{ $jkLabel }}
                                            </td>
                                            <td>{{ Str::limit($resident->alamat ?? '-', 60) }}</td>
                                            <td>{{ $resident->no_hp ?? ($resident->nomor_telpon ?? '-') }}</td>
                                            <td class="text-end pe-4">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.data-penduduk.show', $resident) }}">
                                                                <i class="ti ti-eye me-2"></i>Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.data-penduduk.edit', $resident) }}">
                                                                <i class="ti ti-edit me-2"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('admin.data-penduduk.destroy', $resident) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                                    <i class="ti ti-trash me-2"></i>Hapus
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="ti ti-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                                <p class="mt-3">Tidak ada data penduduk</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="card-footer border-top-0">
                        {{ $residents->links() }}
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
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(30, 60, 114, 0.2);
            border-color: #ffd700;
        }

        .dashboard-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(30, 60, 114, 0.1), rgba(255, 215, 0, 0.05));
            color: #1e3c72;
            font-size: 1.5rem;
        }

        .avtar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
        }

        .avtar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }

        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
        }

        .table thead th {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            color: #6c757d;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 0.75rem;
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:hover {
            background-color: rgba(30, 60, 114, 0.03);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(30, 60, 114, 0.1);
            color: #1e3c72;
        }

        .dropdown-item.text-danger:hover {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545 !important;
        }
    </style>
@endsection
