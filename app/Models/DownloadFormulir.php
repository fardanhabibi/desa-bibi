<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadFormulir extends Model
{
    use HasFactory;

    protected $table = 'download_formulir';
    protected $fillable = ['nama_formulir', 'file_url', 'tanggal_upload'];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];
}
