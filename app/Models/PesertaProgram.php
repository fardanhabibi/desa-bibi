<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaProgram extends Model
{
    use HasFactory;

    protected $table = 'peserta_program';
    protected $fillable = ['program_id', 'peserta_nik'];

    public function program()
    {
        return $this->belongsTo(ProgramDesa::class, 'program_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Penduduk::class, 'peserta_nik', 'nik');
    }
}
