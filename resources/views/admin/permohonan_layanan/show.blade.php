@extends('layouts.app')

@section('title', 'Detail Permohonan Layanan')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Permohonan Layanan #{{ $permohonanLayanan->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3" style="gap: 0.5rem;">
                                <div class="col-md-6 mb-2">
                                    <strong>Layanan:</strong> {{ $permohonanLayanan->layananOnline->nama_layanan ?? '-' }}
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Pemohon:</strong> {{ $permohonanLayanan->pemohon->nama ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-3" style="gap: 0.5rem;">
                                <div class="col-md-6 mb-2">
                                    <strong>Tanggal Pengajuan:</strong> {{ $permohonanLayanan->tanggal_pengajuan?->format('d M Y') ?? '-' }}
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Status:</strong> <span class="badge {{ $permohonanLayanan->status == 'selesai' ? 'bg-success' : ($permohonanLayanan->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">{{ ucfirst($permohonanLayanan->status) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-primary">Kembali ke Kegiatan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
