@extends('layouts.app')

@section('title', 'Detail Kelahiran')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Kelahiran #{{ $kelahiran->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Nama Bayi:</strong> {{ $kelahiran->nama_bayi ?? '-' }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ $kelahiran->tanggal_lahir ? $kelahiran->tanggal_lahir->format('d M Y') : '-' }}</p>
                            <p><strong>Tempat Lahir:</strong> {{ $kelahiran->tempat_lahir ?? '-' }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $kelahiran->jenis_kelamin ?? '-' }}</p>
                            <p><strong>Nama Ibu:</strong> {{ $kelahiran->ibu_nik ?? '-' }}</p>
                            <p><strong>Nama Ayah:</strong> {{ $kelahiran->ayah_nik ?? '-' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kelahiran.edit', $kelahiran->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kelahiran.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
