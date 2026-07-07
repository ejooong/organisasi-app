<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix: wilayah.id uses dot-notation codes (e.g. 65.02.03.2003)
     * Original lengths were too short.
     */
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            // ktp_kota_code: was 4, needs at least 5 (e.g. "65.02")
            $table->string('ktp_kota_code', 10)->change();
            // ktp_kecamatan_code: was 7, needs at least 8 (e.g. "65.02.03")
            $table->string('ktp_kecamatan_code', 15)->change();
            // ktp_kelurahan_code: was 10, needs at least 13 (e.g. "65.02.03.2003")
            $table->string('ktp_kelurahan_code', 20)->change();

            // Same for domisili
            $table->string('domisili_kota_code', 10)->change();
            $table->string('domisili_kecamatan_code', 15)->change();
            $table->string('domisili_kelurahan_code', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('ktp_kota_code', 4)->change();
            $table->string('ktp_kecamatan_code', 7)->change();
            $table->string('ktp_kelurahan_code', 10)->change();

            $table->string('domisili_kota_code', 4)->change();
            $table->string('domisili_kecamatan_code', 7)->change();
            $table->string('domisili_kelurahan_code', 10)->change();
        });
    }
};
