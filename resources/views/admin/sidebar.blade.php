
<!-- Penduduk Management -->
<li class="pc-item {{ request()->is('admin/penduduk*') ? 'active' : '' }}">
    <a href="{{ route('admin.penduduk.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-users"></i></span>
        <span class="pc-mtext">Manajemen Penduduk</span>
    </a>
</li>

<!-- Document Management -->
<li class="pc-item pc-hasmenu {{ request()->is('admin/surat*', 'admin/kartu_keluarga*', 'admin/migrasi*', 'admin/kelahiran*', 'admin/kematian*') ? 'active' : '' }}">
    <a href="javascript:void(0)" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Dokumen</span>
        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
        <li class="pc-item {{ request()->is('admin/surat*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.surat.index') }}">
                <span class="pc-micon"><i class="ti ti-file-check"></i></span>
                <span class="pc-mtext">Manajemen Surat</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/kartu_keluarga*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.kartu_keluarga.index') }}">
                <span class="pc-micon"><i class="ti ti-id"></i></span>
                <span class="pc-mtext">Kartu Keluarga</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/migrasi*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.migrasi.index') }}">
                <span class="pc-micon"><i class="ti ti-map"></i></span>
                <span class="pc-mtext">Migrasi</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/kelahiran*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.kelahiran.index') }}">
                <span class="pc-micon"><i class="ti ti-baby-carriage"></i></span>
                <span class="pc-mtext">Kelahiran</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/kematian*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.kematian.index') }}">
                <span class="pc-micon"><i class="ti ti-cross"></i></span>
                <span class="pc-mtext">Kematian</span>
            </a>
        </li>
    </ul>
</li>

<!-- Information Management -->
<li class="pc-item pc-hasmenu {{ request()->is('admin/agenda*', 'admin/faq*', 'admin/kontak*') ? 'active' : '' }}">
    <a href="javascript:void(0)" class="pc-link">
        <span class="pc-micon"><i class="ti ti-news"></i></span>
        <span class="pc-mtext">Informasi</span>
        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
        {{-- Berita removed per request --}}
        <li class="pc-item {{ request()->is('admin/agenda*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.agenda.index') }}">
                <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                <span class="pc-mtext">Agenda</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/faq*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.faq.index') }}">
                <span class="pc-micon"><i class="ti ti-help-circle"></i></span>
                <span class="pc-mtext">FAQ</span>
            </a>
        </li>
        <li class="pc-item {{ request()->is('admin/kontak*') ? 'active' : '' }}">
            <a class="pc-link" href="{{ route('admin.kontak.index') }}">
                <span class="pc-micon"><i class="ti ti-phone"></i></span>
                <span class="pc-mtext">Kontak Desa</span>
            </a>
        </li>
    </ul>
</li>



<!-- Legacy Menu Items -->
<li class="pc-item">
    <a href="{{ route('admin.pengajuan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-report"></i></span>
        <span class="pc-mtext">Kelola Surat</span>
    </a>
</li>
<li class="pc-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengaduan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-circle-2"></i></span>
        <span class="pc-mtext">Kelola Pengaduan</span>
    </a>
</li>