@extends('layouts.app')

@section('title', 'Detail Kartu Keluarga')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Kartu Keluarga #{{ $kartu_keluarga->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>No. Kartu Keluarga:</strong> {{ $kartu_keluarga->no_kk }}</p>
                            <p><strong>Kepala Keluarga:</strong> {{ $kartu_keluarga->kepala_keluarga }}</p>
                            <p><strong>Alamat:</strong> {{ $kartu_keluarga->alamat }}</p>
                            <p><strong>RT:</strong> {{ $kartu_keluarga->rt }}</p>
                            <p><strong>RW:</strong> {{ $kartu_keluarga->rw }}</p>
                            <p><strong>Dusun:</strong> {{ $kartu_keluarga->dusun }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kartu_keluarga.edit', $kartu_keluarga) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kartu_keluarga.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
