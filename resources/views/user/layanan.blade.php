@extends('layouts.dashboard')
@section('title', 'Download Formulir')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-download me-2"></i>Download Formulir</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($formulir as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{ $item->nama_formulir }}</h6>
                    <p class="text-muted text-sm">{{ $item->deskripsi }}</p>
                    <div class="mb-2">
                        <span class="badge badge-info">{{ $item->kategori }}</span>
                    </div>
                    @if ($item->file_url)
                    <a href="{{ Storage::disk('public')->url($item->file_url) }}" class="btn btn-sm btn-primary" download>
                        <i class="ti ti-download me-1"></i>Download
                    </a>
                    @else
                    <span class="text-muted">File tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info">Tidak ada formulir</div>
        </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $formulir->links() }}
        </div>
    </div>
</div>
@endsection
