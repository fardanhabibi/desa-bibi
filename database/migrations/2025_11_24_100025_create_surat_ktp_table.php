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
        Schema::create('surat_ktp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id')->unique();
            $table->string('pemohon_nik')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->text('alasan')->nullable();
            $table->string('dokumen_pendukung_url')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat');
            $table->foreign('pemohon_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_ktp');
    }
};
