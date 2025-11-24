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
        Schema::create('surat_tanah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id')->unique();
            $table->string('pemilik_nik')->nullable();
            $table->text('letak_tanah')->nullable();
            $table->decimal('luas', 10, 2)->nullable();
            $table->string('status_tanah')->nullable();
            $table->string('penggunaan')->nullable();
            $table->text('batas_utara')->nullable();
            $table->text('batas_selatan')->nullable();
            $table->text('batas_timur')->nullable();
            $table->text('batas_barat')->nullable();
            $table->text('bukti_kepemilikan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat');
            $table->foreign('pemilik_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tanah');
    }
};
