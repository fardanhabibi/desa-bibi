<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KontakDesa;

class KontakDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kontakData = [
            [
                'nama' => 'Muh. Yusuf, S.E.',
                'jabatan' => 'Kepala Desa',
                'alamat' => 'Balai Desa, Dusun Utama',
                'no_hp' => '0851-0000-0001',
                'email' => 'kepala.desa@example.com',
                'jenis' => 'pemerintah',
            ],
            [
                'nama' => 'Siti Nurhasanah, A.Md.',
                'jabatan' => 'Sekretaris Desa',
                'alamat' => 'Balai Desa, Dusun Utama',
                'no_hp' => '0851-0000-0002',
                'email' => 'sekretaris.desa@example.com',
                'jenis' => 'pemerintah',
            ],
            [
                'nama' => 'Ahmad Hidayatullah, S.P.',
                'jabatan' => 'Bendahara Desa',
                'alamat' => 'Balai Desa, Dusun Utama',
                'no_hp' => '0851-0000-0003',
                'email' => 'bendahara.desa@example.com',
                'jenis' => 'pemerintah',
            ],
            [
                'nama' => 'Hj. Fatimah, S.Pd.',
                'jabatan' => 'Kepala Dusun Utama',
                'alamat' => 'Dusun Utama',
                'no_hp' => '0851-0000-0010',
                'email' => 'dusun.utama@example.com',
                'jenis' => 'pemerintah',
            ],
            [
                'nama' => 'Dudi Sudrajat',
                'jabatan' => 'Bidan Desa',
                'alamat' => 'Puskesmas Desa',
                'no_hp' => '0851-0000-0020',
                'email' => 'bidan.desa@example.com',
                'jenis' => 'kesehatan',
            ],
            [
                'nama' => 'Balai Desa',
                'jabatan' => 'Kantor Pemerintah Desa',
                'alamat' => 'Balai Desa, Dusun Utama',
                'no_hp' => '0823-0000-0001',
                'email' => 'info@desa.example.com',
                'jenis' => 'pemerintah',
            ],
        ];

        foreach ($kontakData as $kontak) {
            KontakDesa::create($kontak);
        }
    }
}
