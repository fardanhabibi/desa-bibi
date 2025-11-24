<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained('jenis_surat');
            $table->string('pemohon_nik')->nullable();
            $table->unsignedBigInteger('penandatangan_id')->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['diajukan', 'diproses', 'disetujui', 'ditolak'])->default('diajukan');
            $table->text('keterangan')->nullable();
            $table->string('file_url')->nullable();
            $table->timestamps();

            $table->foreign('pemohon_nik')->references('nik')->on('penduduk');
            $table->foreign('penandatangan_id')->references('id')->on('aparat_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
