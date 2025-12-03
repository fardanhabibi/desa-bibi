<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pengajuan',
        'jenis_surat',
        'jenis_surat_id',
        'keperluan',
        'keterangan',
        'status',
        'catatan_admin',
        'file_surat',
        'file_lampiran',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
    ];

    /**
     * Relasi dengan user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan jenis surat (tabel jenis_surat)
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    /**
     * Accessor untuk badge status
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Pending' => 'bg-light-warning text-warning',
            'Diproses' => 'bg-light-info text-info',
            'Disetujui' => 'bg-light-success text-success',
            'Ditolak' => 'bg-light-danger text-danger',
        ];

        return $badges[$this->status] ?? 'bg-light-secondary text-secondary';
    }

    /**
     * Accessor untuk icon status
     */
    public function getStatusIconAttribute()
    {
        $icons = [
            'Pending' => 'ti-clock',
            'Diproses' => 'ti-refresh',
            'Disetujui' => 'ti-check',
            'Ditolak' => 'ti-x',
        ];

        return $icons[$this->status] ?? 'ti-help';
    }
}