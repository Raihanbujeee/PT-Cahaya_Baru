<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananSetting;

class LayananSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LayananSetting::firstOrCreate([
            'id' => 1
        ], [
            'hero_title' => 'Layanan Lengkap untuk Kebutuhan Bangunan Anda',
            'hero_description' => 'Dari konsultasi hingga instalasi, kami menyediakan solusi terpadu dengan standar kualitas tinggi untuk menjamin kesuksesan proyek Anda.',
            'hero_image' => null,
        ]);
    }
}
