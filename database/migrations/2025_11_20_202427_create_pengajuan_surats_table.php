<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pengajuan')->unique();
            $table->enum('jenis_surat', [
                'Surat Keterangan Siswa',
                'Surat Izin',
                'Surat Rekomendasi',
                'Surat Keterangan Lulus',
                'Surat Pindah Sekolah',
                'Surat Keterangan Aktif Kuliah',
                'Lainnya'
            ]);
            $table->string('keperluan');
            $table->text('keterangan')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->enum('status', ['Pending', 'Diproses', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('catatan_admin')->nullable();
            $table->string('file_surat')->nullable();
            $table->timestamp('tanggal_diproses')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};