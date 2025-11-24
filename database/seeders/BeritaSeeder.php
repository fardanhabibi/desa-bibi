<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritaData = [
            [
                'judul' => 'Pengumuman Perbaikan Jalan Desa',
                'isi' => 'Pemerintah Desa akan melakukan perbaikan jalan desa selama 2 minggu. Harap masyarakat berpartisipasi dan menjaga keselamatan.',
                'gambar_url' => null,
                'tanggal_posting' => now()->subDays(5),
                'penulis' => 'Admin',
            ],
            [
                'judul' => 'Program Vaksinasi Gratis untuk Semua Warga',
                'isi' => 'Pemerintah Desa mengadakan program vaksinasi gratis bagi semua warga. Silakan datang ke balai desa pada hari Sabtu.',
                'gambar_url' => null,
                'tanggal_posting' => now()->subDays(10),
                'penulis' => 'Sekretaris Desa',
            ],
            [
                'judul' => 'Keputusan Pemerintah Tentang PNPM Mandiri',
                'isi' => 'Pembukaan pendaftaran PNPM Mandiri untuk tahun ini. Silakan hubungi kantor desa untuk informasi lebih lanjut.',
                'gambar_url' => null,
                'tanggal_posting' => now()->subDays(15),
                'penulis' => 'Admin',
            ],
            [
                'judul' => 'Wisata ke Kawasan Konservasi Alam Desa',
                'isi' => 'Desa kami memiliki kawasan konservasi alam yang indah. Silakan kunjungi untuk berwisata dan menikmati keindahan alam.',
                'gambar_url' => null,
                'tanggal_posting' => now()->subDays(20),
                'penulis' => 'Kepala Desa',
            ],
        ];

        foreach ($beritaData as $berita) {
            Berita::create($berita);
        }
    }
}
