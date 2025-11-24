<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanLayanan extends Model
{
    use HasFactory;

    protected $table = 'permohonan_layanan';
    protected $fillable = ['layanan_id', 'pemohon_nik', 'tanggal_pengajuan', 'status', 'dokumen_pendukung_url', 'keterangan'];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    public function layanan()
    {
        return $this->belongsTo(LayananOnline::class, 'layanan_id');
    }

    public function pemohon()
    {
        return $this->belongsTo(Penduduk::class, 'pemohon_nik', 'nik');
    }
}
