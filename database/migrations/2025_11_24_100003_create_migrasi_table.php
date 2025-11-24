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
        Schema::create('migrasi', function (Blueprint $table) {
            $table->id();
            $table->string('penduduk_nik')->constrained('penduduk');
            $table->string('jenis')->nullable();
            $table->string('asal_tujuan')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();

            $table->foreign('penduduk_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migrasi');
    }
};
