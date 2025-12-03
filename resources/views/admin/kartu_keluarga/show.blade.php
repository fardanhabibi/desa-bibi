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
                            <p><strong>Alamat Lengkap:</strong> {{ $kartu_keluarga->alamat }}</p>
                            <p><strong>Kepala Keluarga:</strong> {{ $kartu_keluarga->kepala_keluarga }}</p>
                            @if(!empty($kartu_keluarga->rt) || !empty($kartu_keluarga->rw) || !empty($kartu_keluarga->dusun))
                                <p><strong>RT/RW/Dusun:</strong>
                                    {{ $kartu_keluarga->rt }} / {{ $kartu_keluarga->rw }} - {{ $kartu_keluarga->dusun }}</p>
                            @endif
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kartu_keluarga.edit', $kartu_keluarga->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kartu_keluarga.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
