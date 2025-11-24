<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="/dashboard" class="logo">
            <img src="{{ asset('assets/images/my/logo-black-tp.png') }}" alt="Logo">
            <span class="logo-text">Desa Bibi</span>
        </a>
        <button class="toggle-btn" id="toggleSidebar">
            <i class="ti ti-chevron-left"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-title">Menu Utama</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard*') ? ' active' : '' }}" href="/dashboard">
                        <div class="nav-icon">
                            <i class="ti ti-layout-dashboard"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('data-penduduk*') ? ' active' : '' }}" href="/admin/data-penduduk">
                        <div class="nav-icon">
                            <i class="ti ti-users-group"></i>
                        </div>
                        <span class="nav-text">Data Penduduk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('admin/pengajuan*') ? ' active' : '' }}" href="/admin/pengajuan">
                        <div class="nav-icon">
                            <i class="ti ti-file-check"></i>
                        </div>
                        <span class="nav-text">Pengajuan Layanan</span>
                        <span class="nav-badge">{{ isset($pendingCount) ? $pendingCount : '0' }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('admin/pengaduan*') ? ' active' : '' }}" href="/admin/pengaduan">
                        <div class="nav-icon">
                            <i class="ti ti-message-circle"></i>
                        </div>
                        <span class="nav-text">Pengaduan & Masukan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('admin/berita*') ? ' active' : '' }}" href="/admin/berita">
                        <div class="nav-icon">
                            <i class="ti ti-news"></i>
                        </div>
                        <span class="nav-text">Berita & Pengumuman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('laporan*') ? ' active' : '' }}" href="/laporan">
                        <div class="nav-icon">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <span class="nav-text">Laporan Keuangan</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-title">Pengaturan</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('pengaturan*') ? ' active' : '' }}" href="/pengaturan">
                        <div class="nav-icon">
                            <i class="ti ti-settings"></i>
                        </div>
                        <span class="nav-text">Pengaturan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('profil*') ? ' active' : '' }}" href="/profil">
                        <div class="nav-icon">
                            <i class="ti ti-user"></i>
                        </div>
                        <span class="nav-text">Profil Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('bantuan*') ? ' active' : '' }}" href="/bantuan">
                        <div class="nav-icon">
                            <i class="ti ti-help"></i>
                        </div>
                        <span class="nav-text">Bantuan</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
