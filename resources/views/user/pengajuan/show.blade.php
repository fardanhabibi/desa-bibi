@extends('layouts.dashboard')
@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Detail Pengajuan Surat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle me-2"></i>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Surat Letter Format -->
            <div class="card">
                <div class="card-body p-5" style="font-family: 'Times New Roman', Times, serif; line-height: 1.8;">
                    <!-- Header Surat -->
                    <div style="text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 20px;">
                        <div style="font-size: 16px; font-weight: bold;">PEMERINTAH DESA URANGAGUNG</div>
                        <div style="font-size: 14px; margin-bottom: 5px;">Kecamatan Sidoarjo, Kabupaten Sidoarjo</div>
                        <div style="font-size: 12px; margin-bottom: 10px;">Jl. Balai Desa No.1 61261, Provinsi Jawa Timur</div>
                        <div style="font-size: 12px; color: #666;">Telp: (031) 897-1234 | Email: info@urangagung.sidoarjokab.go.id</div>
                    </div>

                    <!-- Nomor Surat -->
                    <div style="text-align: right; margin-bottom: 30px; font-size: 12px;">
                        <strong>Nomor: {{ $surat->nomor_pengajuan }}/{{ now()->format('m') }}/{{ now()->year }}</strong>
                    </div>

                    <!-- Jenis Surat -->
                    <div style="text-align: center; margin-bottom: 30px; font-weight: bold; font-size: 14px;">
                        {{ strtoupper($surat->jenis_surat) }}
                    </div>

                    <!-- Isi Surat -->
                    <div style="text-align: justify; margin-bottom: 20px;">
                        <p style="margin-bottom: 15px;">
                            Yang bertanda tangan dibawah ini, Pemerintah Desa Urangagung, Kecamatan Sidoarjo, Kabupaten Sidoarjo, Provinsi Jawa Timur, dengan ini menerangkan bahwa:
                        </p>

                        <!-- Data Pemohon -->
                        <div style="margin: 25px 0; padding: 15px; background: #f9f9f9; border-left: 4px solid #333;">
                            <table style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="width: 150px;"><strong>Nama</strong></td>
                                    <td>: {{ $surat->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIK</strong></td>
                                    <td>: {{ $surat->user->nik }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat/Tanggal Lahir</strong></td>
                                    <td>: {{ $surat->user->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->user->tanggal_lahir)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $surat->user->alamat }}, {{ $surat->user->kota }}, {{ $surat->user->provinsi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan</strong></td>
                                    <td>: {{ $surat->user->pekerjaan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <p style="margin-bottom: 15px;">
                            Adalah benar orang tersebut diatas, yang berdomisili dan terdaftar sebagai penduduk di Desa Urangagung, Kecamatan Sidoarjo, Kabupaten Sidoarjo.
                        </p>

                        <p style="margin-bottom: 15px;">
                            Surat keterangan ini diberikan kepada yang bersangkutan untuk keperluan:
                        </p>

                        <p style="margin-bottom: 15px; font-weight: bold; text-decoration: underline;">
                            {{ $surat->keperluan }}
                        </p>

                        @if($surat->keterangan)
                            <p style="margin-bottom: 15px;">
                                <strong>Keterangan tambahan:</strong> {{ $surat->keterangan }}
                            </p>
                        @endif

                        <p style="margin-bottom: 30px;">
                            Demikian surat keterangan ini diberikan untuk dapat digunakan sebagaimana perlunya.
                        </p>
                    </div>

                    <!-- Tanda Tangan -->
                    <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                        <div style="width: 45%; text-align: center;">
                            <div style="font-weight: bold; margin-bottom: 50px;">Pemohon,</div>
                            <div style="border-top: 1px solid #000; padding-top: 5px;">
                                <strong>{{ $surat->user->name }}</strong>
                            </div>
                        </div>
                        <div style="width: 45%; text-align: center;">
                            <div style="font-weight: bold; margin-bottom: 5px;">Pemerintah Desa Urangagung,</div>
                            <div style="font-size: 11px; margin-bottom: 50px;">Sidoarjo, {{ now()->format('d F Y') }}</div>
                            <div style="border-top: 1px solid #000; padding-top: 5px;">
                                <div style="margin-bottom: 5px;">..............................</div>
                                <div style="font-size: 11px;">Kepala Desa/Petugas</div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div style="margin-top: 40px; padding-top: 15px; border-top: 1px solid #ddd; font-size: 11px; color: #666; text-align: center;">
                        <p style="margin-bottom: 5px;">Surat ini dibuat secara digital melalui Sistem Informasi Desa (SID) Urangagung</p>
                        <p style="margin-bottom: 0;">Nomor Registrasi: {{ $surat->nomor_pengajuan }} | Status: <span class="badge {{ $surat->status_badge }}">{{ $surat->status }}</span></p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                        <a href="{{ route('user.surat.index') }}" class="btn btn-light order-2 order-md-1">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                        <div class="d-flex gap-2 order-1 order-md-2">
                            <button class="btn btn-primary" onclick="window.print()">
                                <i class="ti ti-printer me-1"></i> Cetak
                            </button>
                            <a href="{{ route('user.surat.downloadPdf', $surat) }}" class="btn btn-success">
                                <i class="ti ti-download me-1"></i> Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            margin: 0;
            padding: 0;
        }
        .page-header,
        .card-footer,
        .btn {
            display: none;
        }
        .card {
            box-shadow: none;
            border: none;
        }
    }
</style>
@endsection