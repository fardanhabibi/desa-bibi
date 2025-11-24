@extends('layouts.app')
@section('title', 'Detail Surat')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Surat #{{ $surat->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Jenis Surat:</strong> {{ $surat->jenisSurat->nama_surat ?? '-' }}</p>
                            <p><strong>Pemohon:</strong> {{ $surat->pemohon->nama ?? '-' }}</p>
                            <p><strong>Status:</strong> <span class="badge {{ $surat->status == 'disetujui' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($surat->status) }}</span></p>
                            <p><strong>Tanggal Pengajuan:</strong> {{ $surat->tanggal_pengajuan?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Tanggal Selesai:</strong> {{ $surat->tanggal_selesai?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Keterangan:</strong> {{ $surat->keterangan ?? '-' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.surat.edit', $surat->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.surat.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
