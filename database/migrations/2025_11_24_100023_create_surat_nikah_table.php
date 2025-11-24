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
        Schema::create('surat_nikah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id')->unique();
            $table->string('calon_suami_nik')->nullable();
            $table->string('calon_istri_nik')->nullable();
            $table->string('wali_nik')->nullable();
            $table->string('saksi_1_nik')->nullable();
            $table->string('saksi_2_nik')->nullable();
            $table->string('tempat_nikah')->nullable();
            $table->date('tanggal_nikah')->nullable();
            $table->string('mas_kawin')->nullable();
            $table->enum('status_pernikahan_sebelumnya', ['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati'])->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat');
            $table->foreign('calon_suami_nik')->references('nik')->on('penduduk');
            $table->foreign('calon_istri_nik')->references('nik')->on('penduduk');
            $table->foreign('wali_nik')->references('nik')->on('penduduk');
            $table->foreign('saksi_1_nik')->references('nik')->on('penduduk');
            $table->foreign('saksi_2_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_nikah');
    }
};
