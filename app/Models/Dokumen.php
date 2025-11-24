<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';
    protected $fillable = ['nama_dokumen', 'jenis', 'file_url', 'pemilik_nik', 'tanggal_upload'];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];

    public function pemilik()
    {
        return $this->belongsTo(Penduduk::class, 'pemilik_nik', 'nik');
    }
}
