<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
            Brand::firstOrCreate(['name' => $name]);
        }

        // Seed Products
        $products = [
            [
                'name' => 'Semen Portland 50Kg',
                'category' => 'Semen',
                'brand' => 'Tiga Roda',
                'purchase_price' => 55000,
                'selling_price' => 65000,
                'current_stock' => 150,
                'minimum_stock' => 20,
            ],
            [
                'name' => 'Cat Tembok Interior Putih 25Kg',
                'category' => 'Cat Tembok',
                'brand' => 'Dulux',
                'purchase_price' => 150000,
                'selling_price' => 185000,
                'current_stock' => 45,
                'minimum_stock' => 10,
            ],
            [
                'name' => 'Besi Beton Polos 10mm SNI',
                'category' => 'Besi',
                'brand' => 'Krakatau Steel',
                'purchase_price' => 65000,
                'selling_price' => 75000,
                'current_stock' => 300,
                'minimum_stock' => 50,
            ],
            [
                'name' => 'Keramik Lantai 40x40 Putih Polos',
                'category' => 'Keramik',
                'brand' => 'Roman',
                'purchase_price' => 45000,
                'selling_price' => 55000,
                'current_stock' => 0,
                'minimum_stock' => 20,
            ],
            [
                'name' => 'Semen Serba Guna 40Kg',
                'category' => 'Semen',
                'brand' => 'Holcim',
                'purchase_price' => 45000,
                'selling_price' => 52000,
                'current_stock' => 200,
                'minimum_stock' => 20,
            ],
            [
                'name' => 'Pipa PVC 1/2 Inch AW',
                'category' => 'Pipa',
                'brand' => 'Wavin',
                'purchase_price' => 20000,
                'selling_price' => 25000,
                'current_stock' => 120,
                'minimum_stock' => 30,
            ],
            [
                'name' => 'Kabel Listrik NYM 2x1.5mm 50m',
                'category' => 'Kabel',
                'brand' => 'Supreme',
                'purchase_price' => 300000,
                'selling_price' => 350000,
                'current_stock' => 25,
                'minimum_stock' => 5,
            ],
            [
                'name' => 'Papan Gypsum 9mm 120x240cm',
                'category' => 'Kayu', // Using Kayu/Papan category
                'brand' => 'Plavon',
                'purchase_price' => 55000,
                'selling_price' => 65000,
                'current_stock' => 80,
                'minimum_stock' => 15,
            ],
        ];

        foreach ($products as $prod) {
            $cat = Category::firstOrCreate(['name' => $prod['category']]);
            $brand = Brand::firstOrCreate(['name' => $prod['brand']]);

            Product::create([
                'category_id' => $cat->id,
                'brand_id' => $brand->id,
                'name' => $prod['name'],
                'purchase_price' => $prod['purchase_price'],
                'selling_price' => $prod['selling_price'],
                'current_stock' => $prod['current_stock'],
                'minimum_stock' => $prod['minimum_stock'],
            ]);
        }
    }
}
