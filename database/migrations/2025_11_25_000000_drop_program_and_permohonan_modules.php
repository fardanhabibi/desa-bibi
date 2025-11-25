<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - drop archived modules.
     * This migration removes tables for Program Desa and Permohonan Layanan modules
     * which have been archived and removed from admin interface.
     */
    public function up(): void
    {
        // Drop permohonan_layanan table first
        if (Schema::hasTable('permohonan_layanan')) {
            Schema::dropIfExists('permohonan_layanan');
        }

        // Drop peserta_program table (which has FK to program_desa)
        if (Schema::hasTable('peserta_program')) {
            Schema::dropIfExists('peserta_program');
        }

        // Drop program_desa table
        if (Schema::hasTable('program_desa')) {
            Schema::dropIfExists('program_desa');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a destructive operation and cannot be safely reversed
        // Use rollback before this migration if needed
    }
};
