<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use HasFactory;

    protected $table = 'kematian';
    protected $fillable = ['penduduk_nik', 'tanggal', 'penyebab', 'nama_almarhum', 'tanggal_meninggal', 'penyebab_kematian', 'nama_pelapor'];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_meninggal' => 'date',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_nik', 'nik');
    }
}
