<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    use HasFactory;

    protected $table = 'forum_diskusi';
    protected $fillable = ['topik', 'pemilik_nik', 'tanggal_posting', 'status'];

    protected $casts = [
        'tanggal_posting' => 'date',
    ];

    public function pemilik()
    {
        return $this->belongsTo(Penduduk::class, 'pemilik_nik', 'nik');
    }

    public function balasan()
    {
        return $this->hasMany(BalasanForum::class, 'forum_id');
    }
}
