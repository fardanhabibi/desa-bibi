<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';
    protected $fillable = ['nama_acara', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'deskripsi'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date', // This is now stored as time but cast as date for compatibility
    ];
}
