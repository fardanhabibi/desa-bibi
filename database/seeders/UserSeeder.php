<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // default role user
        DB::table('users')->insert([
            'name' => 'User Satu',
            'email' => 'usersatu@gmail.com',
            'nik' => '3171011234567890',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-15',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Software Engineer',
            'nomor_telpon' => '08123456789',
            'alamat' => 'Jl. Merdeka No. 123',
            'kota' => 'Jakarta Pusat',
            'provinsi' => 'DKI Jakarta',
            'kode_pos' => '12345',
            'password' => Hash::make('password123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Satu',
            'email' => 'admin@gmail.com',
            'nik' => '3171019876543210',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1985-05-20',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Administrator',
            'nomor_telpon' => '08987654321',
            'alamat' => 'Jl. Admin No. 456',
            'kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => '40123',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}
