<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelahiran', function (Blueprint $table) {
            $table->dropForeign(['ayah_nik']);
            $table->dropForeign(['ibu_nik']);
        });
    }

    public function down(): void
    {
        Schema::table('kelahiran', function (Blueprint $table) {
            $table->foreign('ayah_nik')->references('nik')->on('penduduk');
            $table->foreign('ibu_nik')->references('nik')->on('penduduk');
        });
    }
};
