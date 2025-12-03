<div class="form-section form-surat-keterangan-beda-nama" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Nama Lama <span class="text-danger">*</span></label>
        <input type="text" name="detail[nama_lama]" class="form-control" value="{{ old('detail.nama_lama') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Baru <span class="text-danger">*</span></label>
        <input type="text" name="detail[nama_baru]" class="form-control" value="{{ old('detail.nama_baru') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Alasan Perubahan Nama</label>
        <textarea name="detail[alasan_perubahan]" class="form-control">{{ old('detail.alasan_perubahan') }}</textarea>
    </div>
</div>
