@extends('layouts.app')
@section('title', 'Detail Forum Diskusi')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Detail Topik Forum</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Forum Diskusi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Topik</label>
                        <p class="form-control-plaintext">{{ $forum->topik }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pemilik NIK</label>
                        <p class="form-control-plaintext">{{ $forum->pemilik_nik ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Posting</label>
                        <p class="form-control-plaintext">{{ $forum->tanggal_posting?->format('d F Y') ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="form-control-plaintext">
                            @if($forum->status == 'dibuka')
                                <span class="badge bg-success">Dibuka</span>
                            @else
                                <span class="badge bg-danger">Ditutup</span>
                            @endif
                        </p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.forum.edit', $forum->id) }}" class="btn btn-warning">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.forum.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
