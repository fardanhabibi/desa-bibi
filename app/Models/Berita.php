<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $fillable = ['judul', 'isi', 'gambar_url', 'tanggal_posting', 'penulis'];

    protected $casts = [
        'tanggal_posting' => 'date',
    ];
}
