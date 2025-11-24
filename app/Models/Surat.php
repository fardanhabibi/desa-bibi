<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $fillable = ['jenis_id', 'pemohon_nik', 'penandatangan_id', 'tanggal_pengajuan', 'tanggal_selesai', 'status', 'keterangan', 'file_url'];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_id');
    }

    public function pemohon()
    {
        return $this->belongsTo(Penduduk::class, 'pemohon_nik', 'nik');
    }

    public function penandatangan()
    {
        return $this->belongsTo(AparatDesa::class, 'penandatangan_id');
    }

    public function suratNikah()
    {
        return $this->hasOne(SuratNikah::class, 'surat_id');
    }

    public function suratTanah()
    {
        return $this->hasOne(SuratTanah::class, 'surat_id');
    }

    public function suratKtp()
    {
        return $this->hasOne(SuratKtp::class, 'surat_id');
    }
}
