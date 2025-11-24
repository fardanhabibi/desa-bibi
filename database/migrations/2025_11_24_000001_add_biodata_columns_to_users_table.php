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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->nullable()->comment('Nomor Induk Kependudukan');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('status_perkawinan')->nullable()->comment('Belum Kawin/Kawin/Cerai Hidup/Cerai Mati');
            $table->string('nomor_telpon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'status_perkawinan',
                'nomor_telpon',
                'alamat',
                'kota',
                'provinsi',
                'kode_pos',
            ]);
        });
    }
};
