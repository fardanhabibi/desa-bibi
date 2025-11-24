
<li class="pc-item {{ request()->is('admin/data-penduduk*') ? 'active' : '' }}">
    <a href="{{ route('admin.data-penduduk.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-users"></i></span>
        <span class="pc-mtext">Data Penduduk</span>
    </a>
</li>
<li class="pc-item">
    <a href="{{ route('admin.pengajuan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-report"></i></span>
        <span class="pc-mtext">Laporan</span></a>
</li>
<li class="pc-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengaduan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-circle-2"></i></span>
        <span class="pc-mtext">Kelola Pengaduan</span>
    </a>
</li>