@extends('layouts.app')
@section('title', 'Detail Agenda')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">{{ $agenda->nama_acara }}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Lokasi:</strong> {{ $agenda->lokasi ?? '-' }}</p>
                            <p><strong>Tanggal Mulai:</strong> {{ $agenda->tanggal_mulai?->format('d M Y') ?? '-' }}</p>
                            <p><strong>Jam Mulai:</strong> {{ $agenda->tanggal_selesai?->format('H:i') ?? '-' }}</p>
                            <p><strong>Deskripsi:</strong></p>
                            <p>{{ $agenda->deskripsi ?? '-' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.agenda.index') }}" class="btn btn-link">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
