<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nik',
        'kk_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_kawin',
        'no_hp',
        'email'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }

    public function migrasi()
    {
        return $this->hasMany(Migrasi::class, 'penduduk_nik', 'nik');
    }

    public function kematian()
    {
        return $this->hasMany(Kematian::class, 'penduduk_nik', 'nik');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'pemohon_nik', 'nik');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pemilik_nik', 'nik');
    }

    public function pesertaProgram()
    {
        return $this->hasMany(PesertaProgram::class, 'peserta_nik', 'nik');
    }

    public function permohonanLayanan()
    {
        return $this->hasMany(PermohonanLayanan::class, 'pemohon_nik', 'nik');
    }

    public function forumDiskusi()
    {
        return $this->hasMany(ForumDiskusi::class, 'pemilik_nik', 'nik');
    }

    public function balasanForum()
    {
        return $this->hasMany(BalasanForum::class, 'pengirim_nik', 'nik');
    }
}
