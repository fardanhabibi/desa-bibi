
<!-- Dashboard -->
<li class="pc-item {{ request()->is('dashboard*') ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-home"></i></span>
        <span class="pc-mtext">Dashboard</span>
    </a>
</li>

<!-- Pengajuan & Pengaduan -->
<li class="pc-item {{ request()->is('user/pengajuan*') ? 'active' : '' }}">
    <a href="{{ route('user.pengajuan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-refresh"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item {{ request()->is('pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('user.pengaduan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
        <span class="pc-mtext">Pengaduan</span>
    </a>
</li>

<!-- Information Section -->
<li class="pc-item pc-hasmenu {{ request()->is('berita*', 'agenda*', 'faq*', 'formulir*') ? 'active' : '' }}">
    <a href="javascript:void(0)" class="pc-link">
        <span class="pc-micon"><i class="ti ti-news"></i></span>
        <span class="pc-mtext">Informasi</span>
        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
        <li class="pc-item">
            <a class="pc-link" href="{{ route('berita.index') }}">
                <span class="pc-micon"><i class="ti ti-newspaper"></i></span>
                <span class="pc-mtext">Berita Desa</span>
            </a>
        </li>
        <li class="pc-item">
            <a class="pc-link" href="{{ route('agenda.index') }}">
                <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                <span class="pc-mtext">Agenda</span>
            </a>
        </li>
        <li class="pc-item">
            <a class="pc-link" href="{{ route('faq.index') }}">
                <span class="pc-micon"><i class="ti ti-help-circle"></i></span>
                <span class="pc-mtext">FAQ</span>
            </a>
        </li>
        <li class="pc-item">
            <a class="pc-link" href="{{ route('formulir.index') }}">
                <span class="pc-micon"><i class="ti ti-download"></i></span>
                <span class="pc-mtext">Download Formulir</span>
            </a>
        </li>
    </ul>
</li>

<!-- Services -->
<li class="pc-item pc-hasmenu {{ request()->is('forum*', 'kontak*') ? 'active' : '' }}">
    <a href="javascript:void(0)" class="pc-link">
        <span class="pc-micon"><i class="ti ti-help"></i></span>
        <span class="pc-mtext">Layanan</span>
        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
        <li class="pc-item">
            <a class="pc-link" href="{{ route('forum.index') }}">
                <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
                <span class="pc-mtext">Forum Diskusi</span>
            </a>
        </li>
        <li class="pc-item">
            <a class="pc-link" href="{{ route('kontak.index') }}">
                <span class="pc-micon"><i class="ti ti-phone"></i></span>
                <span class="pc-mtext">Kontak Desa</span>
            </a>
        </li>
    </ul>
</li>

<!-- My Profile -->
<li class="pc-item {{ request()->is('myprofile*') ? 'active' : '' }}">
    <a href="{{ route('myprofile') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-user"></i></span>
        <span class="pc-mtext">Profil Saya</span>
    </a>
</li>
