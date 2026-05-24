<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSetting;

class HomepageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomepageSetting::firstOrCreate([
            'id' => 1
        ], [
            'hero_title' => 'Solusi Bahan Bangunan Terpercaya untuk Semua Kebutuhan Anda',
            'hero_description' => 'Menyediakan material konstruksi berkualitas tinggi dengan pelayanan profesional sejak 2004. Bangun impian Anda bersama kami.',
            'about_title' => 'Mengenal TB Cahaya Baru',
            'about_desc_1' => 'Berdiri sejak 2010, TB Cahaya Baru telah menjadi mitra terpercaya bagi ribuan proyek pembangunan di Indonesia. Kami berkomitmen untuk selalu menyediakan produk material bahan bangunan berkualitas tinggi dengan standar SNI dan harga yang bersaing.',
            'about_desc_2' => 'Dengan pengalaman lebih dari satu dekade, kami memahami betul kebutuhan pelanggan dari skala perumahan hingga proyek komersial besar. Tim kami siap memberikan pelayanan prima dan solusi terbaik untuk setiap kebutuhan konstruksi Anda.',
            'stat_years' => 14,
            'stat_products' => 5000,
            'stat_suppliers' => 50,
            'stat_customers' => 10,
        ]);
    }
}
