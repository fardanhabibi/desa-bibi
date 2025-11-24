@extends('layouts.app')

@section('title', 'Detail Kartu Keluarga')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Kartu Keluarga #{{ $kartuKeluarga->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>No. Kartu Keluarga:</strong> {{ $kartuKeluarga->no_kartu_keluarga }}</p>
                            <p><strong>Alamat Lengkap:</strong> {{ $kartuKeluarga->alamat_lengkap }}</p>
                            <p><strong>Kepala Keluarga:</strong> {{ $kartuKeluarga->kepala_keluarga }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kartu_keluarga.edit', $kartuKeluarga->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kartu_keluarga.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
