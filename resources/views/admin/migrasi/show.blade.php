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
                            <p><strong>Nama Penduduk:</strong> {{ $migrasi->penduduk_nik ?? '-' }}</p>
                            <p><strong>Jenis Migrasi:</strong> {{ $migrasi->jenis ?? '-' }}</p>
                            <p><strong>Asal/Tujuan Daerah:</strong> {{ $migrasi->asal_tujuan ?? '-' }}</p>
                            <p><strong>Tanggal Migrasi:</strong> {{ $migrasi->tanggal ? $migrasi->tanggal->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.migrasi.edit', $migrasi) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.migrasi.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
