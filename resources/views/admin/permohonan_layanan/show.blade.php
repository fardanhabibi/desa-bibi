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
                            <p><strong>Layanan:</strong> {{ $permohonanLayanan->layananOnline->nama_layanan ?? '-' }}</p>
                            <p><strong>Pemohon:</strong> {{ $permohonanLayanan->pemohon->nama ?? '-' }}</p>
                            <p><strong>Tanggal Pengajuan:</strong> {{ $permohonanLayanan->tanggal_pengajuan?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Status:</strong> <span class="badge {{ $permohonanLayanan->status == 'selesai' ? 'bg-success' : ($permohonanLayanan->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">{{ ucfirst($permohonanLayanan->status) }}</span></p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.permohonan_layanan.edit', $permohonanLayanan->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.permohonan_layanan.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
