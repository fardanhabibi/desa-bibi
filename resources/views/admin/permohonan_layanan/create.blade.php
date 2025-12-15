@extends('layouts.app')

@section('title', 'Tambah Permohonan Layanan')

@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Tambah Permohonan Layanan</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.kegiatan.index') }}" class="card">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Layanan <span class="text-danger">*</span></label>
                                <select name="layanan_id" class="form-select @error('layanan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach($layananOnline as $layanan)
                                        <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>{{ $layanan->nama_layanan }}</option>
                                    @endforeach
                                </select>
                                @error('layanan_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pemohon NIK <span class="text-danger">*</span></label>
                                <select name="pemohon_nik" class="form-select @error('pemohon_nik') is-invalid @enderror" required>
                                    <option value="">Pilih Pemohon</option>
                                    @foreach($penduduk as $p)
                                        <option value="{{ $p->nik }}" {{ old('pemohon_nik') == $p->nik ? 'selected' : '' }}>{{ $p->nama }} ({{ $p->nik }})</option>
                                    @endforeach
                                </select>
                                @error('pemohon_nik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan') }}" required>
                                @error('tanggal_pengajuan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                    <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
