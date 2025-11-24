
<li class="pc-item"><a href="{{ route('user.pengajuan.index') }}" class="pc-link"><span class="pc-micon"><i
                class="ti ti-refresh"></i></span><span class="pc-mtext">Pengajuan</span></a></li>
<li class="pc-item {{ request()->is('pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('user.pengaduan.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
        <span class="pc-mtext">Pengaduan</span>
    </a>
</li>