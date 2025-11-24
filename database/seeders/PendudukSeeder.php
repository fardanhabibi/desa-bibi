<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendudukData = [
            [
                'nik' => '3171011234567890',
                'kk_id' => null,
                'nama' => 'Ahmad Hidayatullah',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-15',
                'alamat' => 'Jl. Merdeka No. 123, Dusun Utama',
                'agama' => 'Islam',
                'pendidikan' => 'S1',
                'pekerjaan' => 'Pegawai Negeri Sipil',
                'status_kawin' => 'kawin',
                'no_hp' => '081234567890',
                'email' => 'ahmad@example.com',
            ],
            [
                'nik' => '3171011234567891',
                'kk_id' => null,
                'nama' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-05-20',
                'alamat' => 'Jl. Gatot Subroto No. 45, Dusun Tengah',
                'agama' => 'Islam',
                'pendidikan' => 'SMA',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'status_kawin' => 'kawin',
                'no_hp' => '081234567891',
                'email' => 'siti@example.com',
            ],
            [
                'nik' => '3171011234567892',
                'kk_id' => null,
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1988-03-10',
                'alamat' => 'Jl. Ahmad Yani No. 78, Dusun Utama',
                'agama' => 'Islam',
                'pendidikan' => 'S1',
                'pekerjaan' => 'Wiraswasta',
                'status_kawin' => 'kawin',
                'no_hp' => '081234567892',
                'email' => 'budi@example.com',
            ],
            [
                'nik' => '3171011234567893',
                'kk_id' => null,
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1995-07-25',
                'alamat' => 'Jl. Sudirman No. 56, Dusun Barat',
                'agama' => 'Islam',
                'pendidikan' => 'D3',
                'pekerjaan' => 'Karyawan Swasta',
                'status_kawin' => 'belum_kawin',
                'no_hp' => '081234567893',
                'email' => 'dewi@example.com',
            ],
            [
                'nik' => '3171011234567894',
                'kk_id' => null,
                'nama' => 'Hendra Wijaya',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1985-11-30',
                'alamat' => 'Jl. Diponegoro No. 12, Dusun Timur',
                'agama' => 'Kristen',
                'pendidikan' => 'SMP',
                'pekerjaan' => 'Petani',
                'status_kawin' => 'kawin',
                'no_hp' => '081234567894',
                'email' => 'hendra@example.com',
            ],
        ];

        foreach ($pendudukData as $penduduk) {
            Penduduk::create($penduduk);
        }
    }
}
