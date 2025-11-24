<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agendaData = [
            [
                'nama_acara' => 'Rapat Desa Rutin Bulan November',
                'tanggal_mulai' => now()->addDays(5)->toDateString(),
                'tanggal_selesai' => now()->addDays(5)->toDateString(),
                'lokasi' => 'Balai Desa',
                'deskripsi' => 'Rapat rutin pembahasan pembangunan desa dan aspirasi masyarakat.',
            ],
            [
                'nama_acara' => 'Pemeriksaan Kesehatan Gratis',
                'tanggal_mulai' => now()->addDays(10)->toDateString(),
                'tanggal_selesai' => now()->addDays(10)->toDateString(),
                'lokasi' => 'Puskesmas Desa',
                'deskripsi' => 'Program pemeriksaan kesehatan gratis untuk seluruh warga desa.',
            ],
            [
                'nama_acara' => 'Pelatihan Keterampilan Membuat Kerajinan',
                'tanggal_mulai' => now()->addDays(15)->toDateString(),
                'tanggal_selesai' => now()->addDays(17)->toDateString(),
                'lokasi' => 'Aula Desa',
                'deskripsi' => 'Pelatihan keterampilan pembuatan kerajinan tangan untuk menambah penghasilan.',
            ],
            [
                'nama_acara' => 'Acara Perpisahan Kepala Desa Lama',
                'tanggal_mulai' => now()->addDays(25)->toDateString(),
                'tanggal_selesai' => now()->addDays(25)->toDateString(),
                'lokasi' => 'Lapangan Desa',
                'deskripsi' => 'Acara perpisahan kepala desa lama dan sambutan kepala desa baru.',
            ],
        ];

        foreach ($agendaData as $agenda) {
            Agenda::create($agenda);
        }
    }
}
