@extends('layouts.dashboard')
@section('title', 'Layanan Online')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-checkup-list me-2"></i>Layanan Online Desa</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($layanan as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $item->nama_layanan }}</h6>
                    <p class="text-muted text-sm">{{ Str::limit($item->deskripsi, 100) }}</p>
                    <div class="mb-2">
                        @if ($item->biaya > 0)
                        <span class="badge badge-warning">Rp {{ number_format($item->biaya, 0, ',', '.') }}</span>
                        @else
                        <span class="badge badge-success">Gratis</span>
                        @endif
                    </div>
                    @if ($item->waktu_proses)
                    <p class="text-muted text-xs"><i class="ti ti-clock me-1"></i>{{ $item->waktu_proses }}</p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info">Tidak ada layanan</div>
        </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $layanan->links() }}
        </div>
    </div>
</div>
@endsection
