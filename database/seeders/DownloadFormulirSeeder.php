<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DownloadFormulir;

class DownloadFormulirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formulirData = [
            [
                'nama_formulir' => 'Formulir Permohonan Surat Pengantar',
                'file_url' => '/formulir/surat-pengantar.pdf',
                'tanggal_upload' => now()->toDateString(),
            ],
            [
                'nama_formulir' => 'Formulir Permohonan Surat Keterangan Penghasilan',
                'file_url' => '/formulir/surat-penghasilan.pdf',
                'tanggal_upload' => now()->toDateString(),
            ],
            [
                'nama_formulir' => 'Formulir Data Penduduk',
                'file_url' => '/formulir/data-penduduk.pdf',
                'tanggal_upload' => now()->toDateString(),
            ],
            [
                'nama_formulir' => 'Formulir Permohonan Bantuan Sosial',
                'file_url' => '/formulir/bantuan-sosial.pdf',
                'tanggal_upload' => now()->toDateString(),
            ],
            [
                'nama_formulir' => 'Formulir Laporan Perbaikan Infrastruktur',
                'file_url' => '/formulir/infrastruktur.pdf',
                'tanggal_upload' => now()->toDateString(),
            ],
        ];

        foreach ($formulirData as $formulir) {
            DownloadFormulir::create($formulir);
        }
    }
}
