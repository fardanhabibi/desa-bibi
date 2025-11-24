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
        Schema::create('balasan_forum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_id')->constrained('forum_diskusi');
            $table->string('pengirim_nik')->nullable();
            $table->text('isi')->nullable();
            $table->date('tanggal_posting')->nullable();
            $table->timestamps();

            $table->foreign('pengirim_nik')->references('nik')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balasan_forum');
    }
};
