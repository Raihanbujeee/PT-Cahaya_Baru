<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Kami Siap Membantu Anda');
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('phone')->default('0838-3407-9959');
            $table->string('email')->default('info@ptcahayabaru.com');
            $table->text('address')->nullable();
            $table->string('hours_weekday')->default('08.00 - 17.00');
            $table->string('hours_saturday')->default('08.00 - 15.00');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_settings');
    }
};
