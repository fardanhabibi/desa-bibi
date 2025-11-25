@extends('layouts.app')
@section('title', 'Edit Surat')
@section('content')
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header">
            <div class="col">
                <h2 class="page-title">Edit Surat</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.surat.update', $surat) }}" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Surat</option>
                                    @foreach($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id }}" {{ old('jenis_id', $surat->jenis_id) == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_surat }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pemohon <span class="text-danger">*</span></label>
                                <select name="pemohon_nik" class="form-select @error('pemohon_nik') is-invalid @enderror" required>
                                    <option value="">Pilih Pemohon</option>
                                    @foreach($penduduk as $p)
                                        <option value="{{ $p->nik }}" {{ old('pemohon_nik', $surat->pemohon_nik) == $p->nik ? 'selected' : '' }}>{{ $p->nama }} ({{ $p->nik }})</option>
                                    @endforeach
                                </select>
                                @error('pemohon_nik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengajuan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan', $surat->tanggal_pengajuan) }}" required>
                                @error('tanggal_pengajuan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $surat->tanggal_selesai) }}">
                                @error('tanggal_selesai')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="diajukan" {{ old('status', $surat->status) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                    <option value="diproses" {{ old('status', $surat->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="disetujui" {{ old('status', $surat->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ old('status', $surat->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $surat->keterangan) }}</textarea>
                                @error('keterangan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.surat.index') }}" class="btn btn-link">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
