@extends('layouts.dashboard')
@section('title', 'Kontak Desa')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-phone me-2"></i>Kontak Desa</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($kontak as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $item->nama }}</h6>
                    <div class="mb-2">
                        <span class="text-muted small me-3">
                            <i class="ti ti-briefcase me-1"></i>{{ $item->jabatan ?? '-' }}
                        </span>
                        <span class="text-muted small">
                            <i class="ti ti-calendar me-1"></i>{{ $item->created_at ? $item->created_at->format('d F Y') : '-' }}
                        </span>
                    </div>
                    <p class="mb-2">
                        <i class="ti ti-phone me-2"></i>
                        <a href="tel:{{ $item->no_hp }}">{{ $item->no_hp }}</a>
                    </p>
                    @if ($item->email)
                    <p class="mb-2">
                        <i class="ti ti-mail me-2"></i>
                        <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                    </p>
                    @endif
                    @if ($item->alamat)
                    <p class="text-muted text-sm mb-2">
                        <i class="ti ti-map-pin me-2"></i>{{ $item->alamat }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info">Tidak ada kontak</div>
        </div>
        @endforelse
    </div>
</div>
@endsection
