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
        Schema::table('kelahiran', function (Blueprint $table) {
            $table->string('ibu_nama')->nullable()->after('ibu_nik');
            $table->string('ayah_nama')->nullable()->after('ibu_nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelahiran', function (Blueprint $table) {
            $table->dropColumn(['ibu_nama', 'ayah_nama']);
        });
    }
};
