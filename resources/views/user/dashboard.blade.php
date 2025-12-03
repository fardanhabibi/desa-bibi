@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="pc-content">
    <!-- Welcome Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card welcome-card" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border: none;">
                <div class="card-body text-white p-3 p-md-4">
                    <div class="row align-items-center">
                        <div class="col-md-8 col-12">
                            <h2 class="mb-2 fw-bold fs-4 fs-md-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                            <p class="mb-0 opacity-90 small">Kelola berbagai kebutuhan administratif dan akses informasi desa dengan mudah</p>
                        </div>
                        <div class="col-md-4 col-12 text-md-end text-center mt-3 mt-md-0">
                            <i class="ti ti-home d-none d-md-inline-block" style="font-size: 4rem; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1 small">Pengajuan Surat</h6>
                            <h3 class="mb-0 fw-bold text-primary fs-4">{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->count() }}</h3>
                        </div>
                        <div class="stat-icon bg-light-primary">
                            <i class="ti ti-file-text text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1 small">Pengaduan</h6>
                            <h3 class="mb-0 fw-bold text-warning fs-4">{{ \App\Models\Pengaduan::where('user_id', Auth::id())->count() }}</h3>
                        </div>
                        <div class="stat-icon bg-light-warning">
                            <i class="ti ti-message-circle text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1 small">Disetujui</h6>
                            <h3 class="mb-0 fw-bold text-success fs-4">{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->where('status', 'approved')->count() }}</h3>
                        </div>
                        <div class="stat-icon bg-light-success">
                            <i class="ti ti-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-3">
            <div class="card stat-card h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1 small">Tertunda</h6>
                            <h3 class="mb-0 fw-bold text-info fs-4">{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->where('status', 'pending')->count() }}</h3>
                        </div>
                        <div class="stat-icon bg-light-info">
                            <i class="ti ti-clock text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Alert -->
    @if (! (Auth::user()->is_verified ?? false))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center flex-column flex-md-row">
                        <div class="d-flex align-items-center mb-2 mb-md-0 w-100">
                            <i class="ti ti-alert-circle me-3 flex-shrink-0" style="font-size: 1.5rem;"></i>
                            <div class="flex-grow-1">
                                <strong>Verifikasi Email Diperlukan</strong><br>
                                <small>Lengkapi verifikasi email Anda untuk mengakses semua fitur dan layanan</small>
                            </div>
                        </div>
                        <div class="ms-md-auto mt-2 mt-md-0">
                            <a href="{{ route('verify.form') }}" class="btn btn-warning btn-sm">Verifikasi Sekarang</a>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check-circle me-2"></i>
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Quick Actions & Profile Sidebar -->
    <div class="row mb-4">
        <!-- Quick Actions -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Akses Cepat</h5>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6 col-12">
                            <a href="{{ route('user.surat.create') }}" class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-plus me-2"></i> 
                                <span>Buat Pengajuan Surat</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-outline-primary w-100 py-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-message-plus me-2"></i> 
                                <span>Buat Pengaduan</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-12">
                            <a href="{{ route('myprofile') }}" class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-user me-2"></i> 
                                <span>Profil Desa</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile & Info Sidebar -->
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="card mb-3">
                <div class="card-body text-center p-3">
                    <div class="mb-3">
                        <div class="avatar-lg mx-auto mb-2">
                            <i class="ti ti-user-circle" style="font-size: 3rem; color: #1e3c72;"></i>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">{{ Auth::user()->name }}</h6>
                    <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>
                    <div class="d-grid">
                        <a href="{{ route('myprofile') }}" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-edit me-1"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card">
                <div class="card-body p-3">
                    <h6 class="card-title fw-bold mb-3">Ringkasan Cepat</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="ti ti-file-text text-primary me-2 flex-shrink-0"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Total Pengajuan</small>
                                <strong>{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->count() }}</strong>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="ti ti-message-circle text-warning me-2 flex-shrink-0"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Total Pengaduan</small>
                                <strong>{{ \App\Models\Pengaduan::where('user_id', Auth::id())->count() }}</strong>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="ti ti-check text-success me-2 flex-shrink-0"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Disetujui</small>
                                <strong>{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->where('status', 'approved')->count() }}</strong>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="ti ti-clock text-info me-2 flex-shrink-0"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Menunggu</small>
                                <strong>{{ \App\Models\PengajuanSurat::where('user_id', Auth::id())->where('status', 'pending')->count() }}</strong>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Pengajuan Terbaru -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 fw-bold">Pengajuan Surat Terbaru</h5>
                    <a href="{{ route('user.surat.index') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @php
                        $pengajuan = \App\Models\PengajuanSurat::where('user_id', Auth::id())->latest()->limit(5)->get();
                    @endphp
                    @if($pengajuan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3 ps-md-4">Jenis Surat</th>
                                        <th class="d-none d-md-table-cell">Tanggal</th>
                                        <th>Status</th>
                                        <th class="text-end pe-3 pe-md-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajuan as $item)
                                        <tr>
                                            <td class="ps-3 ps-md-4 fw-bold">
                                                <span class="d-block d-md-none small text-muted">Jenis Surat:</span>
                                                {{ $item->jenisSurat->nama ?? 'N/A' }}
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <span class="d-block d-md-none small text-muted">Tanggal:</span>
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                <span class="d-block d-md-none small text-muted">Status:</span>
                                                <span class="badge 
                                                    @if($item->status === 'approved') bg-success
                                                    @elseif($item->status === 'rejected') bg-danger
                                                    @elseif($item->status === 'pending') bg-warning text-dark
                                                    @else bg-secondary @endif
                                                ">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-3 pe-md-4">
                                                <a href="{{ route('user.surat.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-eye"></i>
                                                    <span class="d-none d-sm-inline">Detail</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <i class="ti ti-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada pengajuan surat</p>
                            <a href="{{ route('user.surat.create') }}" class="btn btn-sm btn-primary">Buat Pengajuan Baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pengaduan Terbaru -->
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 fw-bold">Pengaduan Terbaru</h5>
                    <a href="{{ route('user.pengaduan.index') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @php
                        $pengaduan = \App\Models\Pengaduan::where('user_id', Auth::id())->latest()->limit(5)->get();
                    @endphp
                    @if($pengaduan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3 ps-md-4">Judul Pengaduan</th>
                                        <th class="d-none d-md-table-cell">Tanggal</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell">Kategori</th>
                                        <th class="text-end pe-3 pe-md-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengaduan as $item)
                                        <tr>
                                            <td class="ps-3 ps-md-4 fw-bold">
                                                <span class="d-block d-md-none small text-muted">Judul:</span>
                                                {{ Str::limit($item->judul, 40) }}
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <span class="d-block d-md-none small text-muted">Tanggal:</span>
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                <span class="d-block d-md-none small text-muted">Status:</span>
                                                <span class="badge 
                                                    @if($item->status === 'resolved') bg-success
                                                    @elseif($item->status === 'rejected') bg-danger
                                                    @elseif($item->status === 'pending') bg-warning text-dark
                                                    @else bg-info @endif
                                                ">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <span class="text-muted small">{{ $item->kategori ?? 'Umum' }}</span>
                                            </td>
                                            <td class="text-end pe-3 pe-md-4">
                                                <a href="{{ route('user.pengaduan.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-eye"></i>
                                                    <span class="d-none d-sm-inline">Detail</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <i class="ti ti-message-circle" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada pengaduan</p>
                            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-sm btn-primary">Buat Pengaduan Baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Elegant colorful theme */
    :root{
        --primary-900: #0f1724;
        --primary-700: #1e3c72;
        --accent-1: #7c3aed; /* violet */
        --accent-2: #06b6d4; /* cyan */
        --accent-3: #f59e0b; /* amber */
        --muted: #6b7280;
    }

    body { background: linear-gradient(180deg, rgba(124,58,237,0.04) 0%, rgba(6,182,212,0.02) 100%); }

    /* Welcome Card */
    .welcome-card {
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary-700) 0%, var(--accent-1) 60%);
        color: #fff;
        box-shadow: 0 20px 50px rgba(30, 60, 114, 0.18), inset 0 -6px 30px rgba(255,255,255,0.03);
        border: none;
    }

    .welcome-card .card-body h2, .welcome-card .card-body p { color: #f8fafc; }

    /* Stat Cards */
    .stat-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform .35s cubic-bezier(.2,.9,.3,1), box-shadow .35s;
        position: relative;
        background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid rgba(30,60,114,0.06);
    }

    .stat-card::after{
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle at 30% 30%, rgba(124,58,237,0.08), transparent 40%);
        transform: rotate(20deg);
        pointer-events: none;
    }

    .stat-card:hover{ transform: translateY(-8px); box-shadow: 0 18px 40px rgba(13,38,82,0.12); }

    .stat-icon {
        width: 60px; height: 60px; border-radius: 12px;
        display:flex; align-items:center; justify-content:center; font-size:1.4rem;
        box-shadow: 0 6px 20px rgba(30,60,114,0.06);
    }

    .stat-icon i{ font-size:1.2rem }

    .stat-icon.bg-primary { background: linear-gradient(135deg, var(--primary-700), var(--accent-1)); color: #fff }
    .stat-icon.bg-warning { background: linear-gradient(135deg, #f97316, #f59e0b); color: #fff }
    .stat-icon.bg-success { background: linear-gradient(135deg, #059669, #10b981); color: #fff }
    .stat-icon.bg-info    { background: linear-gradient(135deg, #06b6d4, #0ea5a1); color: #fff }

    .stat-card h6 { color: var(--muted); font-weight:600; }
    .stat-card h3 { margin-top:6px; font-weight:700; color: var(--primary-900); }

    /* Tables */
    .table thead th { background-color: transparent; border-color: transparent; color: var(--muted); font-weight:700; }
    .table tbody tr:hover { background: linear-gradient(90deg, rgba(124,58,237,0.03), rgba(6,182,212,0.02)); }

    /* Cards */
    .card { border-radius: 12px; border: none; box-shadow: 0 8px 20px rgba(13,38,82,0.04); }
    .card-header { background: transparent; border-bottom: none; padding: .85rem 1rem; }

    /* Buttons */
    .btn-primary { background: linear-gradient(90deg, var(--primary-700), var(--accent-1)); border: none; box-shadow: 0 8px 18px rgba(30,60,114,0.08); }
    .btn-outline-primary { border-color: rgba(30,60,114,0.12); color: var(--primary-700); }

    /* Profile card */
    .avatar-lg i{ background: linear-gradient(90deg, var(--accent-2), var(--accent-1)); -webkit-background-clip: text; color: transparent; }

    /* Responsive adjustments */
    @media (max-width: 992px){
        .pc-content{ padding:0 14px }
        .stat-icon{ width:52px; height:52px }
        .stat-card h3{ font-size:1.3rem }
    }

    @media (max-width: 768px){
        .pc-content{ padding:0 12px }
        .stat-icon{ width:50px; height:50px }
        .welcome-card .card-body{ text-align:center }
        .welcome-card .card-body .row{ align-items:center }
        .quick-actions .btn{ padding: .85rem 0.6rem; font-size:0.9rem }
        .stat-card::after{ display:none }
    }

    @media (max-width: 576px){
        .table thead{ display:none }
        .stat-card{ margin-bottom:12px }
        .stat-card h3{ font-size:1.05rem }
        .welcome-card .card-body h2{ font-size:1.25rem }
        .card-body{ padding: .85rem }
        .quick-actions .btn{ display:block; width:100%; }
        .avatar-lg i{ font-size:2.6rem }
    }
</style>

<script>
    // Script untuk membuat tabel lebih responsif di mobile
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan data-label untuk sel tabel di mobile
        function addTableLabels() {
            if (window.innerWidth < 576) {
                document.querySelectorAll('table tbody tr').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const headers = document.querySelectorAll('table thead th');
                    
                    cells.forEach((cell, index) => {
                        if (headers[index]) {
                            cell.setAttribute('data-label', headers[index].textContent.trim());
                        }
                    });
                });
            } else {
                // Remove data labels on larger screens
                document.querySelectorAll('table tbody td').forEach(cell => {
                    cell.removeAttribute('data-label');
                });
            }
        }

        // Run on load and on resize
        addTableLabels();
        window.addEventListener('resize', addTableLabels);
    });
</script>
@endsection