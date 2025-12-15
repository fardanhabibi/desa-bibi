<div class="form-section form-surat-keterangan-tidak-mampu" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Keterangan Kondisi Ekonomi <span class="text-danger">*</span></label>
        <textarea name="detail[kondisi_ekonomi]" class="form-control">{{ old('detail.kondisi_ekonomi') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Tanggungan (opsional)</label>
        <input type="number" name="detail[jumlah_tanggungan]" class="form-control" value="{{ old('detail.jumlah_tanggungan') }}" min="0">
    </div>
</div>
