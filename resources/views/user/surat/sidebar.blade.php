<li class="pc-item"><a href="{{ route('user.biodata') }}" class="pc-link"><span class="pc-micon"><i
                class="ti ti-user"></i></span><span class="pc-mtext">Isi
            Biodata</span></a></li>
<li class="pc-item"><a href="{{ route('user.dokumen') }}" class="pc-link"><span class="pc-micon"><i
                class="ti ti-upload"></i></span><span class="pc-mtext">Upload Dokumen</span></a></li>
<li class="pc-item"><a href="{{ route('user.status') }}" class="pc-link"><span class="pc-micon"><i
                class="ti ti-info-circle"></i></span><span class="pc-mtext">Status Seleksi</span></a></li>
<li class="pc-item"><a href="{{ route('user.daftar_ulang') }}" class="pc-link"><span class="pc-micon"><i
                class="ti ti-refresh"></i></span><span class="pc-mtext">Daftar Ulang</span></a></li>

<!-- Menu Pengajuan Surat -->
<li class="pc-item {{ request()->is('surat*') ? 'active' : '' }}">
    <a href="{{ route('user.surat.index') }}" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>