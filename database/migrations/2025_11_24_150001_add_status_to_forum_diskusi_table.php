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
        Schema::table('forum_diskusi', function (Blueprint $table) {
            $table->enum('status', ['dibuka', 'ditutup'])->default('dibuka')->after('tanggal_posting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_diskusi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
