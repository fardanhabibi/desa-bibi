<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSurat = [
            ['nama_surat' => 'Surat Keterangan Domisili', 'deskripsi' => 'Surat keterangan tempat tinggal/domisili'],
            ['nama_surat' => 'Surat Keterangan Usaha', 'deskripsi' => 'Surat keterangan kepemilikan usaha'],
            ['nama_surat' => 'Surat Keterangan Tidak Mampu', 'deskripsi' => 'Surat keterangan ekonomi lemah/tidak mampu'],
            ['nama_surat' => 'Surat Keterangan Kelahiran', 'deskripsi' => 'Surat keterangan kelahiran anak'],
            ['nama_surat' => 'Surat Keterangan Kematian', 'deskripsi' => 'Surat keterangan kematian seseorang'],
            ['nama_surat' => 'Surat Pengantar', 'deskripsi' => 'Surat pengantar untuk keperluan tertentu'],
            ['nama_surat' => 'Surat Keterangan Beda Nama', 'deskripsi' => 'Surat keterangan perubahan/perbedaan nama'],
            ['nama_surat' => 'Surat Keterangan Migrasi', 'deskripsi' => 'Surat keterangan migrasi/pindah penduduk'],
            ['nama_surat' => 'Surat Keterangan Lainnya', 'deskripsi' => 'Surat keterangan lainnya sesuai kebutuhan'],
        ];

        foreach ($jenisSurat as $jenis) {
            JenisSurat::firstOrCreate(
                ['nama_surat' => $jenis['nama_surat']],
                ['deskripsi' => $jenis['deskripsi']]
            );
        }
    }
}
