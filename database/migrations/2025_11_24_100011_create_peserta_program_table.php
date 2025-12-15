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
        Schema::create('peserta_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('program_desa');
            $table->string('peserta_nik')->nullable();
            $table->timestamps();

            $table->foreign('peserta_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_program');
    }
};
