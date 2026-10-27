<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Seeder lama memakai Category::create() sehingga setiap kali
     * `db:seed` dijalankan muncul baris baru dengan nama yang sama
     * (72 baris untuk 12 kategori). Migrasi ini menggabungkan duplikat
     * lalu menambahkan unique index supaya tidak terulang.
     */
    public function up(): void
    {
        $duplicates = DB::table('categories')
            ->select('name', DB::raw('MIN(id) as keep_id'))
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            $ids = DB::table('categories')
                ->where('name', $duplicate->name)
                ->pluck('id');

            $removed = $ids->reject(fn ($id) => (int) $id === (int) $duplicate->keep_id)->values();

            if ($removed->isEmpty()) {
                continue;
            }

            DB::table('products')
                ->whereIn('category_id', $removed->all())
                ->update(['category_id' => $duplicate->keep_id]);

            DB::table('categories')->whereIn('id', $removed->all())->delete();
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
    }
};
