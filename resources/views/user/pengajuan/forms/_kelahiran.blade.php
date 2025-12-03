<div class="form-section form-surat-keterangan-kelahiran" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Nama Bayi <span class="text-danger">*</span></label>
        <input type="text" name="detail[nama_bayi]" class="form-control" value="{{ old('detail.nama_bayi') }}" placeholder="Nama bayi">
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
        <input type="date" name="detail[tanggal_lahir]" class="form-control" value="{{ old('detail.tanggal_lahir') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="detail[tempat_lahir]" class="form-control" value="{{ old('detail.tempat_lahir') }}">
    </div>
</div>
