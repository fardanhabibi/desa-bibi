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
                            class="ti ti-trending-up"></i> {{ \App\Models\Surat::where('status', 'diproses')->count() }} Processing</span></h4>
                <p class="mb-0 text-muted text-sm">Total permohonan surat yang masuk ke sistem</p>
            </div>
        </div>
    </div>
    <!-- Kolom Total Berita dihapus karena fitur sudah dihapus -->
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

    <div class="col-md-12 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0">Kunjungan Sistem</h5>
            <ul class="nav nav-pills nav-pills-custom justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-home" type="button" role="tab" aria-controls="chart-tab-home"
                        aria-selected="true">Month</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-profile" type="button" role="tab"
                        aria-controls="chart-tab-profile" aria-selected="false">Week</button>
                </li>
            </ul>
        </div>
        <div class="card modern-card">
            <div class="card-body">
                <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane fade" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                        tabindex="0">
                        <div id="visitor-chart-1"></div>
                    </div>
                    <div class="tab-pane fade show active" id="chart-tab-profile" role="tabpanel"
                        aria-labelledby="chart-tab-profile-tab" tabindex="0">
                        <div id="visitor-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    /* Equalize top statistic cards */
    .row-equal > [class*="col-"] > .modern-card { height: 100%; }
    .row-equal > [class*="col-"] > .modern-card .card-body { display:flex; flex-direction:column; justify-content:space-between; }
    </style>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Ringkasan Aktivitas</h5>
        <div class="card modern-card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                <h3 class="mb-3">$7,650</h3>
                <div id="income-overview-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-8">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0">Pengajuan Terbaru</h5>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Orders</a></li>
                    <li><a class="dropdown-item" href="#">Approved</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Rejected</a></li>
                </ul>
            </div>
        </div>
        <div class="card modern-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">TRACKING NO.</th>
                                <th>PRODUCT NAME</th>
                                <th>TOTAL ORDER</th>
                                <th>STATUS</th>
                                <th class="text-end pe-4">TOTAL AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="badge bg-light-danger text-danger">Rejected</span></td>
                                <td class="text-end pe-4">$40,570</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="badge bg-light-warning text-warning">Pending</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="badge bg-light-success text-success">Approved</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="badge bg-light-danger text-danger">Rejected</span></td>
                                <td class="text-end pe-4">$40,570</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="badge bg-light-warning text-warning">Pending</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="badge bg-light-success text-success">Approved</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Camera Lens</td>
                                <td>40</td>
                                <td><span class="badge bg-light-danger text-danger">Rejected</span></td>
                                <td class="text-end pe-4">$40,570</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Laptop</td>
                                <td>300</td>
                                <td><span class="badge bg-light-warning text-warning">Pending</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="badge bg-light-success text-success">Approved</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                            <tr>
                                <td class="ps-4"><a href="#" class="text-muted">84564564</a></td>
                                <td>Mobile</td>
                                <td>355</td>
                                <td><span class="badge bg-light-success text-success">Approved</span></td>
                                <td class="text-end pe-4">$180,139</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Laporan Kinerja</h5>
        <div class="card modern-card">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <h6 class="mb-0">Performance Metrics</h6>
            </div>
            <div class="list-group list-group-flush">
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1">Finance Growth</h6>
                        <p class="mb-0 text-muted">Company Performance</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">+45.14%</span>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1">Expenses Ratio</h6>
                        <p class="mb-0 text-muted">Cost Management</p>
                    </div>
                    <span class="badge bg-info bg-opacity-10 text-info">0.58%</span>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1">Risk Cases</h6>
                        <p class="mb-0 text-muted">Business Assessment</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">Low</span>
                </a>
            </div>
            <div class="card-body px-2">
                <div id="analytics-report-chart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-8">
        <h5 class="mb-3">Laporan Aktivitas</h5>
        <div class="card modern-card">
            <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                <h3 class="mb-0">$7,650</h3>
                <div id="sales-report-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Riwayat Aktivitas</h5>
        <div class="card modern-card">
            <div class="card-header bg-transparent border-bottom-0 pb-0">
                <h6 class="mb-0">Recent Activities</h6>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                <i class="ti ti-gift f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #002434</h6>
                            <p class="mb-0 text-muted">Today, 2:00 AM</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-success">+ $1,430</h6>
                            <p class="mb-0 text-muted">78%</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                <i class="ti ti-message-circle f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #984947</h6>
                            <p class="mb-0 text-muted">5 August, 1:45 PM</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-danger">- $302</h6>
                            <p class="mb-0 text-muted">8%</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                <i class="ti ti-settings f-18"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order #988784</h6>
                            <p class="mb-0 text-muted">7 hours ago</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-danger">- $682</h6>
                            <p class="mb-0 text-muted">16%</p>
                        </div>
                    </div>
                </a>
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

/* Custom Table */
.table {
    margin-bottom: 0;
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

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr:hover {
    background-color: rgba(74, 108, 247, 0.03);
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

/* Custom Nav Pills */
.nav-pills-custom .nav-link {
    border-radius: 50px;
    padding: 0.6rem 1.4rem;
    margin: 0 0.3rem;
    color: #6c757d;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 2px solid transparent;
}

.nav-pills-custom .nav-link.active {
    background: var(--primary-gradient);
    color: white;
    box-shadow: 0 8px 20px rgba(30, 60, 114, 0.25);
    border-color: var(--accent-gold);
}

.nav-pills-custom .nav-link:not(.active):hover {
    background-color: rgba(30, 60, 114, 0.08);
    color: #1e3c72;
    border-color: rgba(30, 60, 114, 0.2);
}

/* List Group Items */
.list-group-item {
    border: none;
    padding: 1.2rem 1.25rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.list-group-item:hover {
    background: linear-gradient(90deg, rgba(30, 60, 114, 0.05), transparent);
}

.list-group-item-action:hover {
    transform: translateX(8px);
}

/* Avatar Styles */
.avtar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.avtar-s {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    font-size: 1.1rem;
}

.bg-light-success {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.15), rgba(25, 135, 84, 0.05)) !important;
}

.bg-light-primary {
    background: linear-gradient(135deg, rgba(30, 60, 114, 0.15), rgba(30, 60, 114, 0.05)) !important;
}

.bg-light-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.05)) !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .modern-card {
        margin-bottom: 1rem;
    }
    
    .nav-pills-custom .nav-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
    }
}

/* Chart Containers */
#visitor-chart,
#visitor-chart-1,
#income-overview-chart,
#analytics-report-chart,
#sales-report-chart {
    min-height: 250px;
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
    
    // Add hover effect to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});
</script>