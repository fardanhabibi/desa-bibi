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

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $surat->nomor_pengajuan }}</h5>
                            <span class="badge {{ $surat->status_badge }}">
                                <i class="ti {{ $surat->status_icon }} me-1"></i>
                                {{ $surat->status }}
                            </span>
                        </div>
                        <a href="{{ route('user.surat.index') }}" class="btn btn-light">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Timeline Status -->
                    <div class="mb-4">
                        <h6 class="mb-3">Timeline Proses</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avtar avtar-l {{ $surat->status !== 'Pending' ? 'bg-success' : 'bg-light-secondary' }} mb-2">
                                        <i class="ti ti-send f-24"></i>
                                    </div>
                                    <h6 class="mb-1">Diajukan</h6>
                                    <small class="text-muted">{{ $surat->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avtar avtar-l {{ $surat->tanggal_diproses ? 'bg-success' : 'bg-light-secondary' }} mb-2">
                                        <i class="ti ti-refresh f-24"></i>
                                    </div>
                                    <h6 class="mb-1">Diproses</h6>
                                    <small class="text-muted">
                                        {{ $surat->tanggal_diproses ? $surat->tanggal_diproses->format('d/m/Y H:i') : '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avtar avtar-l {{ $surat->status === 'Disetujui' ? 'bg-success' : 'bg-light-secondary' }} mb-2">
                                        <i class="ti ti-check f-24"></i>
                                    </div>
                                    <h6 class="mb-1">Disetujui</h6>
                                    <small class="text-muted">
                                        {{ $surat->status === 'Disetujui' && $surat->tanggal_selesai ? $surat->tanggal_selesai->format('d/m/Y H:i') : '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avtar avtar-l {{ $surat->status === 'Disetujui' && $surat->file_surat ? 'bg-success' : 'bg-light-secondary' }} mb-2">
                                        <i class="ti ti-download f-24"></i>
                                    </div>
                                    <h6 class="mb-1">Siap Diunduh</h6>
                                    <small class="text-muted">
                                        {{ $surat->status === 'Disetujui' && $surat->file_surat ? 'Tersedia' : 'Belum' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Informasi Pengajuan -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="180"><strong>Jenis Surat</strong></td>
                                    <td>: <span class="badge bg-light-primary">{{ $surat->jenis_surat }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Keperluan</strong></td>
                                    <td>: {{ $surat->keperluan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Pengajuan</strong></td>
                                    <td>: {{ $surat->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td width="180"><strong>Status</strong></td>
                                    <td>: 
                                        <span class="badge {{ $surat->status_badge }}">
                                            <i class="ti {{ $surat->status_icon }} me-1"></i>
                                            {{ $surat->status }}
                                        </span>
                                    </td>
                                </tr>
                                @if($surat->file_pendukung)
                                    <tr>
                                        <td><strong>File Pendukung</strong></td>
                                        <td>: 
                                            <a href="{{ asset('storage/surat/pendukung/' . $surat->file_pendukung) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-light-primary">
                                                <i class="ti ti-paperclip me-1"></i> Lihat File
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @if($surat->admin)
                                    <tr>
                                        <td><strong>Diproses Oleh</strong></td>
                                        <td>: {{ $surat->admin->name }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Keterangan Tambahan -->
                    @if($surat->keterangan)
                        <div class="mb-4">
                            <h6 class="mb-3">Keterangan Tambahan:</h6>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($surat->keterangan)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Catatan Admin -->
                    @if($surat->catatan_admin)
                        <hr>
                        <div class="alert {{ $surat->status === 'Disetujui' ? 'alert-success' : ($surat->status === 'Ditolak' ? 'alert-danger' : 'alert-info') }}">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="mb-0"><i class="ti ti-message-circle me-2"></i>Catatan dari Admin</h6>
                                @if($surat->tanggal_selesai)
                                    <small class="text-muted">
                                        {{ $surat->tanggal_selesai->format('d F Y, H:i') }}
                                    </small>
                                @endif
                            </div>
                            <div class="p-3 bg-white rounded">
                                {!! nl2br(e($surat->catatan_admin)) !!}
                            </div>
                        </div>
                    @else
                        @if($surat->status === 'Pending')
                            <div class="alert alert-info">
                                <i class="ti ti-clock me-2"></i>
                                Pengajuan surat Anda sedang menunggu untuk diproses oleh admin.
                            </div>
                        @elseif($surat->status === 'Diproses')
                            <div class="alert alert-info">
                                <i class="ti ti-refresh me-2"></i>
                                Surat Anda sedang dalam proses pembuatan. Harap bersabar.
                            </div>
                        @endif
                    @endif

                    <!-- Download Button -->
                    @if($surat->status === 'Disetujui' && $surat->file_surat)
                        <div class="alert alert-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="ti ti-circle-check me-2"></i>
                                    <strong>Surat Anda sudah siap!</strong>
                                    <p class="mb-0 mt-1">Silakan download surat Anda dengan mengklik tombol di samping.</p>
                                </div>
                                <a href="{{ route('user.surat.download', $surat) }}" class="btn btn-success">
                                    <i class="ti ti-download me-1"></i> Download Surat
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Tombol Aksi -->
                    @if($surat->status === 'Pending')
                        <hr>
                        <div class="text-end">
                            <form action="{{ route('user.surat.destroy', $surat) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin membatalkan pengajuan surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash me-1"></i> Batalkan Pengajuan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection