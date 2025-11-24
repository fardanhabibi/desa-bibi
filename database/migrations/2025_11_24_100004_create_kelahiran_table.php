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
        Schema::create('kelahiran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bayi')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('ayah_nik')->nullable();
            $table->string('ibu_nik')->nullable();
            $table->foreignId('kk_id')->nullable()->constrained('kartu_keluarga');
            $table->timestamps();

            $table->foreign('ayah_nik')->references('nik')->on('penduduk');
            $table->foreign('ibu_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelahiran');
    }
};
