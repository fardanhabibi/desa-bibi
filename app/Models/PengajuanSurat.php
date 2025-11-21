<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSurat extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_pengajuan',
        'jenis_surat',
        'keperluan',
        'keterangan',
        'file_pendukung',
        'status',
        'catatan_admin',
        'file_surat',
        'tanggal_diproses',
        'tanggal_selesai',
        'admin_id'
    ];

    protected $casts = [
        'tanggal_diproses' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Generate nomor pengajuan otomatis
    public static function generateNomorPengajuan()
    {
        $date = date('Ymd');
        $lastPengajuan = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();
        
        $number = $lastPengajuan ? intval(substr($lastPengajuan->nomor_pengajuan, -4)) + 1 : 1;
        
        return 'SRT-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Badge color untuk status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Pending' => 'bg-warning',
            'Diproses' => 'bg-info',
            'Disetujui' => 'bg-success',
            'Ditolak' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    // Icon untuk status
    public function getStatusIconAttribute()
    {
        return match($this->status) {
            'Pending' => 'ti-clock',
            'Diproses' => 'ti-refresh',
            'Disetujui' => 'ti-check',
            'Ditolak' => 'ti-x',
            default => 'ti-help'
        };
    }
}