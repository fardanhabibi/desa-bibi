<div class="form-section form-surat-keterangan-migrasi" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Alamat Tujuan Migrasi <span class="text-danger">*</span></label>
        <input type="text" name="detail[alamat_tujuan]" class="form-control" value="{{ old('detail.alamat_tujuan') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Alasan Migrasi</label>
        <textarea name="detail[alasan_migrasi]" class="form-control">{{ old('detail.alasan_migrasi') }}</textarea>
    </div>
</div>
