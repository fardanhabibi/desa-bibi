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
            // Menambahkan kolom foreign key ke tabel jenis_surat sehingga front-end
            // bisa menampilkan daftar jenis surat (seperti pada screenshot).
            $table->foreignId('jenis_surat_id')
                ->nullable()
                ->after('nomor_pengajuan')
                ->constrained('jenis_surat')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_surats', 'jenis_surat_id')) {
                $table->dropForeign(['jenis_surat_id']);
                $table->dropColumn('jenis_surat_id');
            }
        });
    }
};
