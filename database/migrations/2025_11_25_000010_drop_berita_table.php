<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Drop the `berita` table if it exists.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('berita')) {
            Schema::dropIfExists('berita');
        }
    }

    /**
     * Reverse the migrations.
     * Recreate a minimal `berita` table so rollback is possible.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('berita')) {
            Schema::create('berita', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('isi');
                $table->string('gambar_url')->nullable();
                $table->date('tanggal_posting')->nullable();
                $table->string('penulis')->nullable();
                $table->timestamps();
            });
        }
    }
};
