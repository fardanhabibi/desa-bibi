<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratNikah extends Model
{
    use HasFactory;

    protected $table = 'surat_nikah';
    protected $fillable = [
        'surat_id',
        'calon_suami_nik',
        'calon_istri_nik',
        'wali_nik',
        'saksi_1_nik',
        'saksi_2_nik',
        'tempat_nikah',
        'tanggal_nikah',
        'mas_kawin',
        'status_pernikahan_sebelumnya',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_nikah' => 'date',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function calonSuami()
    {
        return $this->belongsTo(Penduduk::class, 'calon_suami_nik', 'nik');
    }

    public function calonIstri()
    {
        return $this->belongsTo(Penduduk::class, 'calon_istri_nik', 'nik');
    }

    public function wali()
    {
        return $this->belongsTo(Penduduk::class, 'wali_nik', 'nik');
    }

    public function saksi1()
    {
        return $this->belongsTo(Penduduk::class, 'saksi_1_nik', 'nik');
    }

    public function saksi2()
    {
        return $this->belongsTo(Penduduk::class, 'saksi_2_nik', 'nik');
    }
}
