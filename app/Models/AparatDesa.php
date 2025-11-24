<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AparatDesa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'aparat_desa';
    protected $fillable = ['nama', 'jabatan', 'no_hp', 'alamat', 'username', 'password', 'role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'penandatangan_id');
    }

    public function kegiatanDesa()
    {
        return $this->hasMany(KegiatanDesa::class, 'penanggung_jawab');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'aparat_id');
    }
}
