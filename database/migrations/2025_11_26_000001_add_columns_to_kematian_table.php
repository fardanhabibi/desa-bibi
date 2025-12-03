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
        Schema::table('kematian', function (Blueprint $table) {
            // Add columns if they don't exist
            if (!Schema::hasColumn('kematian', 'nama_almarhum')) {
                $table->string('nama_almarhum')->nullable()->after('penduduk_nik');
            }
            if (!Schema::hasColumn('kematian', 'tanggal_meninggal')) {
                $table->date('tanggal_meninggal')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('kematian', 'penyebab_kematian')) {
                $table->string('penyebab_kematian')->nullable()->after('penyebab');
            }
            if (!Schema::hasColumn('kematian', 'nama_pelapor')) {
                $table->string('nama_pelapor')->nullable()->after('penyebab_kematian');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kematian', function (Blueprint $table) {
            $table->dropColumn(['nama_almarhum', 'tanggal_meninggal', 'penyebab_kematian', 'nama_pelapor']);
        });
    }
};
