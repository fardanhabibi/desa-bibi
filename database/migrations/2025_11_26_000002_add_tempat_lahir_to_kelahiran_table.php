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
        if (Schema::hasTable('kelahiran') && !Schema::hasColumn('kelahiran', 'tempat_lahir')) {
            Schema::table('kelahiran', function (Blueprint $table) {
                $table->string('tempat_lahir')->nullable()->after('tanggal_lahir');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kelahiran') && Schema::hasColumn('kelahiran', 'tempat_lahir')) {
            Schema::table('kelahiran', function (Blueprint $table) {
                $table->dropColumn('tempat_lahir');
            });
        }
    }
};
