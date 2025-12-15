<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LayananOnline;

class LayananOnlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layananData = [
            [
                'nama_layanan' => 'Surat Pengantar',
                'kategori' => 'Administrasi',
                'deskripsi' => 'Surat pengantar untuk berbagai keperluan (melamar kerja, sekolah, dll)',
                'status' => 'aktif',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Penghasilan',
                'kategori' => 'Administrasi',
                'deskripsi' => 'Surat keterangan penghasilan untuk keperluan bantuan sosial atau kredit',
                'status' => 'aktif',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Kelahiran',
                'kategori' => 'Catatan Sipil',
                'deskripsi' => 'Surat keterangan kelahiran sementara sebelum membuat akta kelahiran di kantor pencatat sipil',
                'status' => 'aktif',
            ],
            [
                'nama_layanan' => 'Surat Pindah Domisili',
                'kategori' => 'Administrasi',
                'deskripsi' => 'Surat pindah domisili untuk keperluan administratif',
                'status' => 'aktif',
            ],
            [
                'nama_layanan' => 'Konsultasi Pembangunan Desa',
                'kategori' => 'Konsultasi',
                'deskripsi' => 'Layanan konsultasi pembangunan desa dan perencanaan program',
                'status' => 'aktif',
            ],
        ];

        foreach ($layananData as $layanan) {
            LayananOnline::create($layanan);
        }
    }
}
