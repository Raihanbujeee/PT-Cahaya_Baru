<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TentangSetting;

class TentangSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TentangSetting::firstOrCreate([
            'id' => 1
        ], [
            'hero_title' => "Mitra Terpercaya Untuk Setiap\nProyek Bangunan Anda",
            'hero_description' => 'Kami hadir memberikan solusi terbaik untuk kebutuhan bangunan Anda.',
            'hero_image' => null,
            'about_title' => 'TB Cahaya Baru — Solusi Bahan Bangunan Sejak 2010',
            'about_description' => "Berawal dari sebuah toko kecil, TB Cahaya Baru didirikan dengan satu tujuan sederhana: menyediakan bahan bangunan berkualitas dengan harga yang jujur. Kami berkembang melayani kontraktor, pemborong hingga pemilik rumah perorangan.\n\nKami percaya bahwa fondasi bangunan yang kuat dimulai dari material yang tepat dan hubungan jangka panjang yang didasari rasa saling percaya. Tim kami selalu siap memberikan konsultasi profesional untuk memastikan setiap proyek Anda berjalan lancar tanpa kendala suplai material.",
        ]);
    }
}
