@extends('layouts.app')
@section('title', 'Detail FAQ')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Detail FAQ</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi FAQ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pertanyaan</label>
                        <p class="form-control-plaintext">{{ $faq->pertanyaan }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jawaban</label>
                        <p class="form-control-plaintext">{{ $faq->jawaban }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Dibuat Pada</label>
                        <p class="form-control-plaintext">{{ $faq->created_at->format('d F Y H:i:s') }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-warning">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
