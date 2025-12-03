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
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Menambahkan kolom detail untuk menyimpan data spesifik setiap jenis surat (JSON)
            $table->json('detail')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_surats', 'detail')) {
                $table->dropColumn('detail');
            }
        });
    }
};
