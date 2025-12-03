<div class="form-section form-surat-keterangan-lainnya" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Judul / Perihal <span class="text-danger">*</span></label>
        <input type="text" name="detail[judul]" class="form-control" value="{{ old('detail.judul') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Rincian</label>
        <textarea name="detail[rincian]" class="form-control">{{ old('detail.rincian') }}</textarea>
    </div>
</div>
