<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('type')->default('lainnya')->after('name'); // pemasangan, pengantaran, lainnya
            $table->decimal('price_per_km', 15, 2)->nullable()->after('price');
            $table->foreignId('product_id')->nullable()->after('price_per_km')
                  ->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn(['type', 'price_per_km', 'product_id']);
        });
    }
};
