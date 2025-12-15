<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $surat->nomor_pengajuan }} - {{ $surat->jenis_surat }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            background: #f5f5f5;
            padding: 15px;
            font-size: 11px;
            color: #333;
        }

        /* Ensure printing to single A4 page */
        @page {
            size: A4 portrait;
            margin: 10mm 10mm 10mm 10mm;
        }

        @media print {
            html, body {
                background: white;
                padding: 0;
                margin: 0;
                width: 100%;
                height: auto;
            }
            body {
                font-size: 9px;
                line-height: 1.3;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                box-shadow: none;
                margin: 0;
                padding: 10mm;
                width: 100%;
                max-width: 100%;
                page-break-inside: avoid;
            }
        }

        .print-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 10mm;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            page-break-inside: avoid;
        }

        /* ========== HEADER SECTION ========== */
        .print-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            page-break-inside: avoid;
        }

        .header-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1px;
            letter-spacing: 0.3px;
        }

        .header-subtitle {
            font-size: 9px;
            margin-bottom: 0px;
            font-weight: 500;
        }

        .header-info {
            font-size: 8px;
            color: #555;
            margin-bottom: 0px;
            line-height: 1.2;
        }

        /* ========== NOMOR SURAT SECTION ========== */
        .surat-nomor {
            text-align: right;
            margin-bottom: 6px;
            font-size: 8px;
            page-break-inside: avoid;
        }

        .surat-nomor strong {
            font-size: 9px;
            font-weight: bold;
        }

        /* ========== JUDUL SURAT ========== */
        .surat-title {
            text-align: center;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            page-break-inside: avoid;
        }

        /* ========== KONTEN UTAMA ========== */
        .surat-content {
            margin-bottom: 8px;
            text-align: justify;
            page-break-inside: avoid;
        }

        .surat-content p {
            margin-bottom: 4px;
            text-indent: 0.7cm;
            font-size: 9px;
            line-height: 1.3;
        }

        .surat-content p.no-indent {
            text-indent: 0;
            margin-bottom: 4px;
        }

        /* ========== DATA PEMOHON SECTION ========== */
        .data-pemohon {
            margin: 4px 0;
            padding: 6px 8px;
            background: #fafafa;
            border-left: 3px solid #333;
            page-break-inside: avoid;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
            font-size: 9px;
            line-height: 1.2;
        }

        .data-table td {
            vertical-align: top;
            padding: 1px 3px;
        }

        .data-label {
            width: 130px;
            font-weight: bold;
            padding-right: 4px;
            white-space: nowrap;
        }

        .data-separator {
            width: 8px;
            text-align: center;
            font-weight: bold;
        }

        .data-value {
            word-break: break-word;
        }

        /* ========== SIGNATURE SECTION ========== */
        .surat-ttd {
            margin-top: 12px;
            width: 100%;
            page-break-inside: avoid;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .ttd-cell {
            padding: 0 6px;
            vertical-align: top;
            width: 50%;
            text-align: center;
        }

        .ttd-cell.left {
            text-align: left;
        }

        .ttd-cell.right {
            text-align: right;
        }

        .ttd-title {
            font-weight: bold;
            margin-bottom: 1px;
            font-size: 9px;
            padding: 0 6px;
        }

        .ttd-date {
            font-size: 8px;
            color: #666;
            margin-bottom: 4px;
            padding: 0 6px;
        }

        .ttd-space {
            height: 24px;
            padding: 0 6px;
        }

        .ttd-signature {
            border-top: 1px solid #000;
            padding: 2px 6px 0 6px;
            font-weight: bold;
            font-size: 8px;
            line-height: 1.2;
            height: 20px;
            overflow: hidden;
        }

        .ttd-position {
            font-size: 8px;
            margin-top: 1px;
            color: #333;
            padding: 0 6px;
        }

        /* ========== FOOTER SECTION ========== */
        .footer-info {
            margin-top: 4px;
            padding-top: 4px;
            border-top: 1px solid #ddd;
            font-size: 8px;
            color: #666;
            text-align: center;
            page-break-inside: avoid;
            line-height: 1.3;
        }

        /* ========== ACTION BUTTONS ========== */
        .action-buttons {
            text-align: center;
            margin-top: 25px;
            gap: 10px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 18px;
            margin: 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-print {
            background: #007bff;
            color: white;
            border-color: #0056b3;
        }

        .btn-print:hover {
            background: #0056b3;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border-color: #5a6268;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        /* ========== WATERMARK ========== */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(200,200,200,0.15);
            white-space: nowrap;
            z-index: -1;
            pointer-events: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="print-container" style="position: relative;">
        <div class="watermark">SURAT RESMI</div>

        <!-- Header -->
        <div class="print-header">
            <div class="header-title">Pemerintah Desa Urangagung</div>
            <div class="header-subtitle">Kecamatan Sidoarjo, Kabupaten Sidoarjo</div>
            <div class="header-subtitle">Provinsi Jawa Timur, Indonesia</div>
            <div class="header-info">Jl. Balai Desa No.1 61261 | Telepon: (031) 897-1234</div>
            <div class="header-info">Email: info@urangagung.sidoarjokab.go.id</div>
        </div>

        <!-- Nomor Surat -->
        <div class="surat-nomor">
            <strong>Nomor: {{ $surat->nomor_pengajuan }}/{{ now()->format('m') }}/{{ now()->year }}</strong>
        </div>

        <!-- Jenis Surat -->
        <div class="surat-title">
            {{ strtoupper($surat->jenis_surat) }}
        </div>

        <!-- Konten Surat -->
        <div class="surat-content">
            <p class="no-indent">
                Yang bertanda tangan dibawah ini, Pemerintah Desa Urangagung, Kecamatan Sidoarjo, Kabupaten Sidoarjo, Provinsi Jawa Timur, dengan ini menerangkan bahwa:
            </p>

            <!-- Data Pemohon -->
            <div class="data-pemohon">
                <table class="data-table" aria-hidden="false">
                    <tr>
                        <td class="data-label">Nama</td>
                        <td class="data-separator">:</td>
                        <td class="data-value">{{ $surat->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">NIK</td>
                        <td class="data-separator">:</td>
                        <td class="data-value">{{ $surat->user->nik }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Tempat/Tanggal Lahir</td>
                        <td class="data-separator">:</td>
                        <td class="data-value">{{ $surat->user->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->user->tanggal_lahir)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Alamat</td>
                        <td class="data-separator">:</td>
                        <td class="data-value">{{ $surat->user->alamat }}, {{ $surat->user->kota }}, {{ $surat->user->provinsi }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Pekerjaan</td>
                        <td class="data-separator">:</td>
                        <td class="data-value">{{ $surat->user->pekerjaan ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <p class="no-indent">
                Adalah benar orang tersebut diatas, yang berdomisili dan terdaftar sebagai penduduk di Desa Urangagung, Kecamatan Sidoarjo, Kabupaten Sidoarjo.
            </p>

            @if(!empty($surat->detail) && is_array($surat->detail))
                <div class="data-pemohon" style="margin-top:10px;">
                    <div class="data-row" style="margin-bottom:6px;">
                        <div class="data-label">Detail Pengajuan</div>
                        <div class="data-separator">:</div>
                        <div class="data-value">
                            @php
                                $labels = [
                                    'alamat' => 'Alamat',
                                    'lama_tinggal' => 'Lama Tinggal (tahun)',
                                    'nama_usaha' => 'Nama Usaha',
                                    'alamat_usaha' => 'Alamat Usaha',
                                    'kondisi_ekonomi' => 'Keterangan Kondisi Ekonomi',
                                    'jumlah_tanggungan' => 'Jumlah Tanggungan',
                                    'nama_bayi' => 'Nama Bayi',
                                    'tanggal_lahir' => 'Tanggal Lahir',
                                    'tempat_lahir' => 'Tempat Lahir',
                                    'nama_almarhum' => 'Nama Almarhum',
                                    'tanggal_meninggal' => 'Tanggal Meninggal',
                                    'sebab' => 'Sebab Kematian',
                                    'tujuan' => 'Tujuan Pengantar',
                                    'keterangan_pengantar' => 'Keterangan Pengantar',
                                    'nama_lama' => 'Nama Lama',
                                    'nama_baru' => 'Nama Baru',
                                    'alasan_perubahan' => 'Alasan Perubahan Nama',
                                    'alamat_tujuan' => 'Alamat Tujuan Migrasi',
                                    'alasan_migrasi' => 'Alasan Migrasi',
                                    'judul' => 'Judul / Perihal',
                                    'rincian' => 'Rincian',
                                ];
                            @endphp

                            <table class="data-table">
                                @foreach($surat->detail as $k => $v)
                                    @if($v === null || $v === '')
                                        @continue
                                    @endif
                                    @php
                                        $label = $labels[$k] ?? ucwords(str_replace(['_','-'], [' ',' '], $k));
                                        $value = $v;
                                        if(str_contains(strtolower($k), 'tanggal') && !empty($v)){
                                            try{
                                                $value = \Carbon\Carbon::parse($v)->format('d F Y');
                                            } catch(\Exception $e) {
                                                // keep raw
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td class="data-label">{{ $label }}</td>
                                        <td class="data-separator">:</td>
                                        <td class="data-value">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <p class="no-indent">
                Surat keterangan ini diberikan kepada yang bersangkutan untuk keperluan:
            </p>

            <p class="no-indent" style="font-weight: bold;">
                <u>{{ $surat->keperluan }}</u>
            </p>

            @if($surat->keterangan)
                <p class="no-indent">
                    Keterangan tambahan: {{ $surat->keterangan }}
                </p>
            @endif

            <p class="no-indent">
                Demikian surat keterangan ini diberikan untuk dapat digunakan sebagaimana perlunya.
            </p>
        </div>

        <!-- Tanda Tangan -->
        <div class="surat-ttd">
            <table class="ttd-table">
                <tr>
                    <td class="ttd-cell left"><div class="ttd-title" style="text-align: left;">Pemohon,</div></td>
                    <td class="ttd-cell right"><div class="ttd-title" style="text-align: right;">Pemerintah Desa Urangagung,</div></td>
                </tr>
                <tr>
                    <td class="ttd-cell left"></td>
                    <td class="ttd-cell right"><div class="ttd-date">Sidoarjo, {{ now()->format('d F Y') }}</div></td>
                </tr>
                <tr>
                    <td class="ttd-cell left"><div class="ttd-space"></div></td>
                    <td class="ttd-cell right"><div class="ttd-space"></div></td>
                </tr>
                <tr>
                    <td class="ttd-cell left"><div class="ttd-signature">{{ $surat->user->name }}</div></td>
                    <td class="ttd-cell right"><div class="ttd-signature">..............................</div></td>
                </tr>
                <tr>
                    <td class="ttd-cell left"></td>
                    <td class="ttd-cell right"><div class="ttd-position">Kepala Desa/Petugas</div></td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer-info">
            <p>Surat ini dibuat secara digital melalui Sistem Informasi Desa (SID) Urangagung pada {{ now()->format('d F Y H:i') }}</p>
            <p>Nomor Registrasi: {{ $surat->nomor_pengajuan }} | Status: {{ $surat->status }}</p>
        </div>
    </div>

    <!-- Action Buttons (No Print) -->
    <div class="action-buttons no-print" style="margin-top: 30px;">
        <button class="btn btn-print" onclick="window.print()">
            <i class="ti ti-printer"></i> Cetak/Print
        </button>
        <a href="{{ route('user.surat.show', $surat) }}" class="btn btn-back">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    <script>
        // Auto-print jika dibuka dari parameter ?print=1
        if (new URLSearchParams(window.location.search).get('print') === '1') {
            window.print();
        }
    </script>
</body>
</html>
