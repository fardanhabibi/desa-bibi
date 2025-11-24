@extends('layouts.app')
@section('title', 'Detail Berita')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">{{ $berita->judul }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if($berita->gambar_url)
                            <div class="card-img-top">
                                <img src="{{ asset('storage/' . $berita->gambar_url) }}" alt="Gambar" class="img-fluid">
                            </div>
                        @endif
                        <div class="card-body">
                            <p><strong>Penulis:</strong> {{ $berita->penulis }}</p>
                            <p><strong>Tanggal Posting:</strong> {{ $berita->tanggal_posting?->format('d M Y') ?? '-' }}</p>
                            <hr>
                            <p>{{ $berita->isi }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
