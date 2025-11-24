<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migrasi extends Model
{
    use HasFactory;

    protected $table = 'migrasi';
    protected $fillable = ['penduduk_nik', 'jenis', 'asal_tujuan', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_nik', 'nik');
    }
}
