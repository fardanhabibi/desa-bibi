<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_pengaduan',
        'judul',
        'kategori',
        'isi_pengaduan',
        'file_lampiran',
        'status',
        'tanggapan',
        'tanggal_tanggapan',
        'admin_id'
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Generate nomor pengaduan otomatis
    public static function generateNomorPengaduan()
    {
        $date = date('Ymd');
        $lastPengaduan = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();
        
        $number = $lastPengaduan ? intval(substr($lastPengaduan->nomor_pengaduan, -4)) + 1 : 1;
        
        return 'PGD-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Badge color untuk status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Pending' => 'bg-warning',
            'Diproses' => 'bg-info',
            'Selesai' => 'bg-success',
            'Ditolak' => 'bg-danger',
            default => 'bg-secondary'
        };
    }
}