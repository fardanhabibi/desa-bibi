<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Change column to text to allow storing JSON of multiple filenames
            if (Schema::hasColumn('pengaduans', 'file_lampiran')) {
                $table->text('file_lampiran')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'file_lampiran')) {
                $table->string('file_lampiran')->nullable()->change();
            }
        });
    }
};
