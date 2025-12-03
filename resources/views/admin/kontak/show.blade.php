@extends('layouts.app')

@section('title', 'Detail Kontak Desa')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Detail Kontak Desa #{{ $kontak->id }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $kontak->nama }}</p>
                            <p><strong>Jabatan:</strong> {{ $kontak->jabatan }}</p>
                            <p><strong>Alamat:</strong> {{ $kontak->alamat }}</p>
                            <p><strong>No. HP:</strong> {{ $kontak->no_hp }}</p>
                            <p><strong>Email:</strong> {{ $kontak->email }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kontak.edit', $kontak->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.kontak.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
