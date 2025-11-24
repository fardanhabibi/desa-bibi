@extends('layouts.app')
@section('title', 'Detail Kegiatan')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">{{ $kegiatan->nama_kegiatan }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi ?? '-' }}</p>
                            <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Penanggung Jawab:</strong> {{ $kegiatan->penanggungJawab->nama ?? '-' }}</p>
                            <p><strong>Deskripsi:</strong></p>
                            <p>{{ $kegiatan->deskripsi ?? '-' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
