<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDesa extends Model
{
    use HasFactory;

    protected $table = 'program_desa';
    protected $fillable = ['nama_program', 'tahun', 'anggaran'];

    public function pesertaProgram()
    {
        return $this->hasMany(PesertaProgram::class, 'program_id');
    }
}
