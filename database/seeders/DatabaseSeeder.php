<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin SIM-TB',
            'email' => 'admin@simtb.com',
            'password' => Hash::make('password'),
        ]);

        // Seed Categories
        $categories = [
            'Cat Tembok',
            'Semen',
            'Keramik',
            'Besi',
            'Paku',
            'Kayu',
            'Pipa',
            'Kabel',
            'Genteng',
            'Batu Bata',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        // Seed Brands
        $brands = [
            'Avian',
            'Dulux',
            'Tiga Roda',
            'Holcim',
            'Roman',
            'Arwana',
            'Plavon',
            'Wavin',
            'Supreme',
            'Krakatau Steel',
        ];

        foreach ($brands as $name) {
            Brand::create(['name' => $name]);
        }
    }
}
