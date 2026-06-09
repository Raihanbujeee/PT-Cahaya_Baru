<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KontakSetting;

class KontakSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KontakSetting::firstOrCreate([
            'id' => 1
        ], [
            'hero_title' => 'Kami Siap Membantu Anda',
            'hero_description' => 'Hubungi kami melalui berbagai saluran komunikasi yang tersedia atau kunjungi toko kami langsung di Kota Malang.',
            'hero_image' => null,
            'phone' => '0838-3407-9959',
            'email' => 'info@ptcahayabaru.com',
            'address' => "Jl. Saxophone No.65, Tunggulwulung, Kec. Lowokwaru,\nKota Malang, Jawa Timur 65143",
            'hours_weekday' => '08.00 - 17.00',
            'hours_saturday' => '08.00 - 15.00',
        ]);
    }
}
