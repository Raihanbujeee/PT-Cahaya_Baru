<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tahun berdiri dipakai untuk menghitung "Tahun Beroperasi" secara
     * otomatis, supaya angka statistik tidak perlu diperbarui manual
     * setiap tahun.
     */
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->unsignedSmallInteger('founded_year')->default(2010)->after('hero_image');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn('founded_year');
        });
    }
};
