<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKtp extends Model
{
    use HasFactory;

    protected $table = 'surat_ktp';
    protected $fillable = [
        'surat_id',
        'pemohon_nik',
        'jenis_permohonan',
        'alasan',
        'dokumen_pendukung_url',
        'keterangan'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function pemohon()
    {
        return $this->belongsTo(Penduduk::class, 'pemohon_nik', 'nik');
    }
}
