@extends('layouts.dashboard')
@section('title', 'Berita Desa')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10"><i class="ti ti-newspaper me-2"></i>Berita Desa</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($berita as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                @if ($item->gambar_url)
                <img src="{{ Storage::disk('public')->url($item->gambar_url) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h6 class="card-title">{{ $item->judul }}</h6>
                    <p class="card-text text-muted text-sm">{{ Str::limit($item->isi, 100) }}</p>
                    <small class="text-muted"><i class="ti ti-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info">Tidak ada berita</div>
        </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $berita->links() }}
        </div>
    </div>
</div>
@endsection
