@extends('layouts.app')
@section('title', 'Edit FAQ')
@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-0">Edit FAQ</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Formulir Edit FAQ</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Pertanyaan</label>
                            <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" rows="3" required>{{ old('pertanyaan', $faq->pertanyaan) }}</textarea>
                            @error('pertanyaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <textarea class="form-control @error('jawaban') is-invalid @enderror" name="jawaban" rows="5" required>{{ old('jawaban', $faq->jawaban) }}</textarea>
                            @error('jawaban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-save"></i> Perbarui
                            </button>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
