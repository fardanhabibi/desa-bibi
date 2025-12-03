@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')

@section('content')
<div class="pc-content">
    <div class="row row-equal">
        <!-- [ statistics ] start -->
        <div class="col-md-6 col-xl-3">
            <div class="card modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 f-w-400 text-muted">Total Penduduk</h6>
                        <div class="dashboard-icon">
                            <i class="ti ti-users"></i>
                        </div>
                    </div>
                    <h4 class="mb-3">{{ \App\Models\Penduduk::count() }} <span class="badge bg-light-success border border-success"><i
                            class="ti ti-trending-up"></i> Aktif</span></h4>
                    <p class="mb-0 text-muted text-sm">Total data penduduk yang terdaftar dalam sistem desa</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 f-w-400 text-muted">Total Surat</h6>
                        <div class="dashboard-icon">
                            <i class="ti ti-file-text"></i>
                        </div>
                    </div>
                    <h4 class="mb-3">{{ \App\Models\Surat::count() }} <span class="badge bg-light-warning border border-warning"><i
                            class="ti ti-trending-up"></i> Processing</span></h4>
                    <p class="mb-0 text-muted text-sm">Total permohonan surat yang masuk ke sistem</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 f-w-400 text-muted">Total Pengaduan</h6>
                        <div class="dashboard-icon">
                            <i class="ti ti-message-circle-2"></i>
                        </div>
                    </div>
                    <h4 class="mb-3">{{ \App\Models\Pengaduan::count() }} <span class="badge bg-light-info border border-info"><i
                            class="ti ti-clock"></i> Pending</span></h4>
                    <p class="mb-0 text-muted text-sm">Total pengaduan yang diajukan oleh warga</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card modern-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 f-w-400 text-muted">Total Agenda</h6>
                        <div class="dashboard-icon">
                            <i class="ti ti-calendar"></i>
                        </div>
                    </div>
                    <h4 class="mb-3">{{ \App\Models\Agenda::count() }} <span class="badge bg-light-danger border border-danger"><i
                            class="ti ti-trending-up"></i> Acara</span></h4>
                    <p class="mb-0 text-muted text-sm">Total agenda kegiatan yang dijadwalkan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Actions -->
    <div class="col-12 mt-3">
        <div class="card modern-card">
            <div class="card-body d-flex flex-wrap align-items-center gap-2">
                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-primary">
                    <i class="ti ti-users me-1"></i> Kelola Penduduk
                </a>
                <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-outline-success">
                    <i class="ti ti-file-check me-1"></i> Pengajuan Surat
                </a>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-warning">
                    <i class="ti ti-message-circle me-1"></i> Kelola Pengaduan
                </a>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline-danger">
                    <i class="ti ti-calendar me-1"></i> Kelola Agenda
                </a>
                <div class="ms-auto text-muted small">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</div>
            </div>
        </div>
    </div>

    <!-- Recent activity -->
    <div class="col-12 mt-3">
        <div class="card modern-card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Pengajuan Terbaru</h5>
                    <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                @php
                    $recentPengajuan = \App\Models\PengajuanSurat::latest()->limit(8)->get();
                @endphp
                @if($recentPengajuan->count())
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>Pengaju</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPengajuan as $idx => $p)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td>{{ $p->jenisSurat->nama ?? 'N/A' }}</td>
                                        <td>{{ $p->user->name ?? $p->user_id }}</td>
                                        <td>
                                            <span class="badge @if($p->status=='approved') bg-light-success text-success @elseif($p->status=='pending') bg-light-warning text-warning @else bg-light-danger text-danger @endif">{{ ucfirst($p->status) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.pengajuan.show', $p->id) }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">Belum ada pengajuan.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card modern-card">
            <div class="card-body">
                <h5 class="mb-3">Ringkasan Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">Total Penduduk: <strong>{{ \App\Models\Penduduk::count() }}</strong></li>
                    <li class="mb-2">Pengajuan Tertunda: <strong>{{ \App\Models\PengajuanSurat::where('status','pending')->count() }}</strong></li>
                    <li class="mb-2">Pengaduan Baru: <strong>{{ \App\Models\Pengaduan::where('status','pending')->count() }}</strong></li>
                    <li class="mb-2">Agenda Mendatang: <strong>{{ \App\Models\Agenda::where('tanggal_mulai', '>=', now())->count() }}</strong></li>
                </ul>
                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-primary btn-sm">Kelola Data</a>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    --primary-gradient-gold: linear-gradient(135deg, #1e3c72, #2a5298, #ffd700);
    --accent-gold: #ffd700;
    --shadow-light: 0 8px 20px rgba(30, 60, 114, 0.08);
    --shadow-medium: 0 12px 30px rgba(30, 60, 114, 0.12);
    --shadow-hover: 0 20px 50px rgba(30, 60, 114, 0.2);
    --border-radius: 16px;
}

/* Modern Card Styles */
.modern-card {
    background: white;
    border-radius: var(--border-radius);
    border: 2px solid transparent;
    box-shadow: var(--shadow-light);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
    position: relative;
}

.modern-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-hover);
    border-color: var(--accent-gold);
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient-gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.modern-card:hover::before {
    transform: scaleX(1);
}

/* Dashboard Icons */
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
    font-weight: 600;
    animation: iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-6px); }
}

/* Custom Badges */
.badge {
    font-weight: 500;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
}

/* Status Badges */
.badge.bg-light-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.05)) !important;
    color: #dc3545 !important;
    border: 1px solid rgba(220, 53, 69, 0.3);
    font-weight: 600;
    padding: 0.5em 0.8em !important;
}

.badge.bg-light-warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05)) !important;
    color: #ff9800 !important;
    border: 1px solid rgba(255, 193, 7, 0.3);
    font-weight: 600;
    padding: 0.5em 0.8em !important;
}

.badge.bg-light-success {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.15), rgba(25, 135, 84, 0.05)) !important;
    color: #198754 !important;
    border: 1px solid rgba(25, 135, 84, 0.3);
    font-weight: 600;
    padding: 0.5em 0.8em !important;
}

.badge.bg-light-info {
    background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(6, 182, 212, 0.05)) !important;
    color: #0891b2 !important;
    border: 1px solid rgba(6, 182, 212, 0.3);
    font-weight: 600;
    padding: 0.5em 0.8em !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .modern-card {
        margin-bottom: 1rem;
    }
}

/* Ensure statistic cards have equal height */
.row-equal > [class*="col-"] > .modern-card {
    height: 100%;
}
.row-equal > [class*="col-"] > .modern-card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>

<script>
// Add some interactive functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add click animation to cards
    const cards = document.querySelectorAll('.modern-card');
    cards.forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection
