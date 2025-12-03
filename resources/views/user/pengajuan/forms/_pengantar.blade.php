<div class="form-section form-surat-pengantar" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Tujuan Pengantar <span class="text-danger">*</span></label>
        <input type="text" name="detail[tujuan]" class="form-control" value="{{ old('detail.tujuan') }}" placeholder="Contoh: Pencairan BPJS">
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan Tambahan</label>
        <textarea name="detail[keterangan_pengantar]" class="form-control">{{ old('detail.keterangan_pengantar') }}</textarea>
    </div>
</div>
