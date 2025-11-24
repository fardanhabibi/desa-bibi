@extends('layouts.app')
@section('title', 'Edit Berita')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Edit Berita</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" class="card" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
                                @error('judul')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi <span class="text-danger">*</span></label>
                                <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="6" required>{{ old('isi', $berita->isi) }}</textarea>
                                @error('isi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                @if($berita->gambar_url)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $berita->gambar_url) }}" alt="Gambar" style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" name="gambar_url" class="form-control @error('gambar_url') is-invalid @enderror" accept="image/*">
                                @error('gambar_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis <span class="text-danger">*</span></label>
                                <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $berita->penulis) }}" required>
                                @error('penulis')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Posting <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_posting" class="form-control @error('tanggal_posting') is-invalid @enderror" value="{{ old('tanggal_posting', $berita->tanggal_posting) }}" required>
                                @error('tanggal_posting')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
