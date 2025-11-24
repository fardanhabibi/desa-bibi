<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasanForum extends Model
{
    use HasFactory;

    protected $table = 'balasan_forum';
    protected $fillable = ['forum_id', 'pengirim_nik', 'isi', 'tanggal_posting'];

    protected $casts = [
        'tanggal_posting' => 'date',
    ];

    public function forum()
    {
        return $this->belongsTo(ForumDiskusi::class, 'forum_id');
    }

    public function pengirim()
    {
        return $this->belongsTo(Penduduk::class, 'pengirim_nik', 'nik');
    }
}
