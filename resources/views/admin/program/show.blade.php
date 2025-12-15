@extends('layouts.app')

@section('title', 'Detail Program')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Program #{{ $program->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Nama Program:</strong> {{ $program->nama_program }}</p>
                            <p><strong>Tahun:</strong> {{ $program->tahun }}</p>
                            <p><strong>Anggaran:</strong> Rp {{ number_format($program->anggaran, 0, ',', '.') }}</p>
                            <p><strong>Deskripsi:</strong> {{ $program->deskripsi }}</p>
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
