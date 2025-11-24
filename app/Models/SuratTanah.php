<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTanah extends Model
{
    use HasFactory;

    protected $table = 'surat_tanah';
    protected $fillable = [
        'surat_id',
        'pemilik_nik',
        'letak_tanah',
        'luas',
        'status_tanah',
        'penggunaan',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'bukti_kepemilikan',
        'keterangan'
    ];

    protected $casts = [
        'luas' => 'float',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(Penduduk::class, 'pemilik_nik', 'nik');
    }
}
