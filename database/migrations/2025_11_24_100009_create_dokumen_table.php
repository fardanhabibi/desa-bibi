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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('jenis')->nullable();
            $table->string('file_url')->nullable();
            $table->string('pemilik_nik')->nullable();
            $table->date('tanggal_upload')->nullable();
            $table->timestamps();

            $table->foreign('pemilik_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
