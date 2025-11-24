<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqData = [
            [
                'pertanyaan' => 'Bagaimana cara membuat surat pengantar?',
                'jawaban' => 'Anda dapat membuat surat pengantar melalui aplikasi ini. Silakan login, pilih menu Pengajuan Surat, kemudian isi formulir dengan data yang diperlukan. Surat akan diproses oleh admin desa dalam 1-3 hari kerja.',
            ],
            [
                'pertanyaan' => 'Berapa lama waktu pemrosesan surat?',
                'jawaban' => 'Proses pembuatan surat biasanya memakan waktu 1-3 hari kerja. Untuk kasus khusus atau mendesak, Anda dapat menghubungi kantor desa langsung.',
            ],
            [
                'pertanyaan' => 'Apakah ada biaya untuk membuat surat?',
                'jawaban' => 'Pembuatan surat di desa kami gratis untuk semua warga. Kami berkomitmen memberikan layanan terbaik tanpa biaya.',
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengadukan masalah di desa?',
                'jawaban' => 'Anda dapat menggunakan fitur Pengaduan di aplikasi ini. Isi formulir dengan detail masalah Anda, dan tim kami akan menindaklanjuti dengan segera.',
            ],
            [
                'pertanyaan' => 'Bagaimana cara melihat status pengajuan saya?',
                'jawaban' => 'Setelah login, Anda dapat melihat status pengajuan di menu Dashboard atau Riwayat Pengajuan. Status akan diperbarui secara real-time.',
            ],
            [
                'pertanyaan' => 'Siapa yang bisa membuat akun?',
                'jawaban' => 'Semua warga desa yang berusia 17 tahun atau lebih dapat membuat akun. Silakan gunakan email yang valid untuk proses registrasi.',
            ],
        ];

        foreach ($faqData as $faq) {
            Faq::create($faq);
        }
    }
}
