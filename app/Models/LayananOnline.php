<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananOnline extends Model
{
    use HasFactory;

    protected $table = 'layanan_online';
    protected $fillable = ['nama_layanan', 'kategori', 'deskripsi', 'status'];

    public function permohonan()
    {
        return $this->hasMany(PermohonanLayanan::class, 'layanan_id');
    }
}
