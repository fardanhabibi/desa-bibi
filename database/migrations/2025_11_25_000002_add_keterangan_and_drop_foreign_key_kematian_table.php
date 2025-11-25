<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kematian', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('penyebab');
        });

        Schema::table('kematian', function (Blueprint $table) {
            $table->dropForeign(['penduduk_nik']);
        });
    }

    public function down(): void
    {
        Schema::table('kematian', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->foreign('penduduk_nik')->references('nik')->on('penduduk');
        });
    }
};
