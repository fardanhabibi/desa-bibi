@extends('layouts.dashboard')
@section('title', 'Agenda')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-calendar me-2"></i>Agenda Kegiatan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @forelse ($agenda as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="card-title">{{ $item->nama_acara }}</h6>
                            <p class="text-muted mb-2"><i class="ti ti-map-pin me-1"></i>{{ $item->lokasi }}</p>
                            <p class="text-muted">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="badge badge-info p-2">
                                <i class="ti ti-calendar me-1"></i>
                                {{ $item->tanggal_mulai->format('d M Y') }}
                                @if ($item->tanggal_selesai != $item->tanggal_mulai)
                                s/d {{ $item->tanggal_selesai->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">Tidak ada agenda</div>
            @endforelse
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $agenda->links() }}
        </div>
    </div>
</div>
@endsection
