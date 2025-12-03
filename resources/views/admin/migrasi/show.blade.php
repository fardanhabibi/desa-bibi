@extends('layouts.app')

@section('title', 'Detail Migrasi')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Migrasi #{{ $migrasi->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Nama Penduduk:</strong> {{ $migrasi->penduduk?->nama ?? ($migrasi->penduduk_nik ?? '-') }}</p>
                            <p><strong>Asal / Tujuan:</strong> {{ $migrasi->asal_tujuan }}</p>
                            <p><strong>Tanggal Migrasi:</strong> {{ $migrasi->tanggal?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Alasan / Jenis:</strong> {{ $migrasi->jenis }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.migrasi.edit', $migrasi->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.migrasi.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
