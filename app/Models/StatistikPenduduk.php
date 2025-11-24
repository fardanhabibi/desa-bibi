<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    use HasFactory;

    protected $table = 'statistik_penduduk';
    protected $fillable = ['tahun', 'jumlah_penduduk', 'jumlah_laki', 'jumlah_perempuan', 'jumlah_kk'];
}
