<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahiran';
    protected $fillable = ['nama_bayi', 'tanggal_lahir', 'jenis_kelamin', 'ayah_nik', 'ibu_nik', 'kk_id', 'ibu_nama', 'ayah_nama', 'tempat_lahir'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function ayah()
    {
        return $this->belongsTo(Penduduk::class, 'ayah_nik', 'nik');
    }

    public function ibu()
    {
        return $this->belongsTo(Penduduk::class, 'ibu_nik', 'nik');
    }

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }
}
