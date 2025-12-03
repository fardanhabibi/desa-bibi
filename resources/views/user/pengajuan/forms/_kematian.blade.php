<div class="form-section form-surat-keterangan-kematian" style="display: none;">
    <div class="mb-3">
        <label class="form-label">Nama Almarhum / Almarhumah <span class="text-danger">*</span></label>
        <input type="text" name="detail[nama_almarhum]" class="form-control" value="{{ old('detail.nama_almarhum') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Meninggal <span class="text-danger">*</span></label>
        <input type="date" name="detail[tanggal_meninggal]" class="form-control" value="{{ old('detail.tanggal_meninggal') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Sebab Kematian</label>
        <input type="text" name="detail[sebab]" class="form-control" value="{{ old('detail.sebab') }}">
    </div>
</div>
