@extends('layouts.app')

@section('title', 'Detail Penduduk')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Detail Penduduk</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ $penduduk->nama }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>NIK:</strong> <span class="font-monospace">{{ $penduduk->nik }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Jenis Kelamin:</strong> {{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Tempat Lahir:</strong> {{ $penduduk->tempat_lahir ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tanggal Lahir:</strong> {{ $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('d F Y') : '-' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Status Kawin:</strong> {{ $penduduk->status_kawin ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Agama:</strong> {{ $penduduk->agama ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Pendidikan:</strong> {{ $penduduk->pendidikan ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Pekerjaan:</strong> {{ $penduduk->pekerjaan ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>No. HP:</strong> {{ $penduduk->no_hp ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $penduduk->email ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <p><strong>Alamat:</strong></p>
                                <p>{{ $penduduk->alamat ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.penduduk.edit', $penduduk->nik) }}" class="btn btn-primary">
                                <i class="ti ti-pencil me-2"></i>Edit
                            </a>
                            <a href="{{ route('admin.penduduk.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
