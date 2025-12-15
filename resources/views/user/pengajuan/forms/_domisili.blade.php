<div class="form-section form-surat-keterangan-domisili" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Alamat Domisili <span class="text-danger">*</span></label>
        <input type="text" name="detail[alamat]" class="form-control" value="{{ old('detail.alamat') }}" placeholder="Isi alamat domisili">
    </div>
    <div class="mb-3">
        <label class="form-label">Lama Tinggal (tahun)</label>
        <input type="number" name="detail[lama_tinggal]" class="form-control" value="{{ old('detail.lama_tinggal') }}" min="0">
    </div>
</div>
