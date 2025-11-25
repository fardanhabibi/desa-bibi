<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahiran';
    protected $fillable = ['nama_bayi', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'ayah_nik', 'ibu_nik', 'kk_id'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }
}
