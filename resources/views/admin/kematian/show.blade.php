@extends('layouts.app')

@section('title', 'Detail Kematian')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Kematian #{{ $kematian->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Nama Almarhum:</strong> {{ $kematian->nama_almarhum }}</p>
                            <p><strong>Tanggal Meninggal:</strong> {{ $kematian->tanggal_meninggal?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Penyebab Kematian:</strong> {{ $kematian->penyebab_kematian }}</p>
                            <p><strong>Nama Pelapor:</strong> {{ $kematian->nama_pelapor }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kematian.edit', $kematian->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kematian.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
