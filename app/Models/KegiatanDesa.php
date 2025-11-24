<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanDesa extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_desa';
    protected $fillable = ['nama_kegiatan', 'lokasi', 'tanggal', 'penanggung_jawab', 'deskripsi'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(AparatDesa::class, 'penanggung_jawab');
    }
}
