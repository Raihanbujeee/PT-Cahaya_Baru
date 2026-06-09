<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\InboundDetail;
use App\Models\InboundTransaction;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProductDetail;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@simtb.com'],
            [
                'name' => 'Admin SIM-TB',
                'password' => Hash::make('password'),
            ]
        );

        // Seed Homepage Settings
        $this->call([
            HomepageSettingSeeder::class,
            LayananSettingSeeder::class,
            KontakSettingSeeder::class,
            TentangSettingSeeder::class,
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

            Product::firstOrCreate(
                ['name' => $prod['name']],
                [
                    'category_id' => $cat->id,
                    'brand_id' => $brand->id,
                    'purchase_price' => $prod['purchase_price'],
                    'selling_price' => $prod['selling_price'],
                    'current_stock' => $prod['current_stock'],
                    'minimum_stock' => $prod['minimum_stock'],
                ]
            );
        }

        // Seed Customers
        $customers = [
            ['name' => 'Bapak Budi', 'phone_number' => '081234567890', 'address' => 'Jl. Merdeka No. 1'],
            ['name' => 'Ibu Siti', 'phone_number' => '081298765432', 'address' => 'Jl. Sudirman No. 2'],
            ['name' => 'Proyek Perumahan A', 'phone_number' => '085612341234', 'address' => 'Kawasan Industri B'],
        ];

        foreach ($customers as $cust) {
            Customer::firstOrCreate(
                ['phone_number' => $cust['phone_number']],
                $cust
            );
        }

        // Seed Suppliers
        $suppliers = [
            ['name' => 'PT Semen Indonesia', 'contact_info' => '021-1234567'],
            ['name' => 'CV Baja Perkasa', 'contact_info' => '021-7654321'],
            ['name' => 'Toko Cat Warna Warni', 'contact_info' => '081122334455'],
        ];

        foreach ($suppliers as $supp) {
            Supplier::firstOrCreate(
                ['name' => $supp['name']],
                $supp
            );
        }

        // Seed Inbound Transactions (Data Masuk)
        $supplier1 = Supplier::where('name', 'PT Semen Indonesia')->first();
        $productSemen = Product::where('name', 'Semen Portland 50Kg')->first();

        if ($supplier1 && $productSemen) {
            $inbound = InboundTransaction::firstOrCreate(
                ['supplier_id' => $supplier1->id, 'note' => 'Stok awal semen'],
                [
                    'date' => Carbon::now()->subDays(5),
                    'total_cost' => $productSemen->purchase_price * 50,
                ]
            );

            InboundDetail::firstOrCreate(
                ['inbound_transaction_id' => $inbound->id, 'product_id' => $productSemen->id],
                [
                    'quantity' => 50,
                    'cost_price' => $productSemen->purchase_price,
                ]
            );
        }

        // Seed Sales (Penjualan)
        $customer1 = Customer::first();
        $adminUser = User::first();
        $productCat = Product::where('name', 'Cat Tembok Interior Putih 25Kg')->first();

        if ($customer1 && $adminUser && $productCat) {
            $qty = 2;
            $subtotal = $productCat->selling_price * $qty;
            
            $sale = Sale::firstOrCreate(
                ['customer_id' => $customer1->id, 'user_id' => $adminUser->id, 'grand_total' => $subtotal],
                [
                    'date' => Carbon::now()->subDays(2),
                    'total_product_price' => $subtotal,
                    'total_service_price' => 0,
                    'payment_method' => 'Cash',
                    'payment_status' => 'Paid',
                    'shipping_address' => $customer1->address,
                ]
            );

            SaleProductDetail::firstOrCreate(
                ['sale_id' => $sale->id, 'product_id' => $productCat->id],
                [
                    'quantity' => $qty,
                    'unit_price' => $productCat->selling_price,
                    'subtotal' => $subtotal,
                ]
            );
        }

        // ── Seed Services (Jasa / Layanan) ──

        // Pemasangan (per produk)
        $installationServices = [
            ['product_name' => 'Keramik Lantai 40x40 Putih Polos', 'name' => 'Pemasangan Keramik',  'price' => 30000, 'description' => 'Jasa pemasangan keramik lantai termasuk semen dan nat per meter persegi'],
            ['product_name' => 'Pipa PVC 1/2 Inch AW',             'name' => 'Pemasangan Pipa',     'price' => 15000, 'description' => 'Jasa pemasangan pipa PVC termasuk lem dan fitting per titik sambungan'],
            ['product_name' => 'Kabel Listrik NYM 2x1.5mm 50m',   'name' => 'Pemasangan Kabel',    'price' => 25000, 'description' => 'Jasa instalasi kabel listrik termasuk pemasangan stop kontak per titik'],
            ['product_name' => 'Papan Gypsum 9mm 120x240cm',      'name' => 'Pemasangan Plafon',   'price' => 20000, 'description' => 'Jasa pemasangan plafon gypsum termasuk rangka hollow per lembar'],
            ['product_name' => 'Cat Tembok Interior Putih 25Kg',  'name' => 'Pengecatan Tembok',   'price' => 12000, 'description' => 'Jasa pengecatan tembok interior per meter persegi (2 lapis)'],
            ['product_name' => 'Semen Portland 50Kg',             'name' => 'Jasa Aduk & Pasang Semen', 'price' => 35000, 'description' => 'Jasa tukang untuk mengaduk dan mengaplikasikan semen per sak'],
            ['product_name' => 'Semen Serba Guna 40Kg',           'name' => 'Jasa Aduk & Pasang Semen', 'price' => 30000, 'description' => 'Jasa tukang untuk mengaduk dan mengaplikasikan semen per sak'],
            ['product_name' => 'Besi Beton Polos 10mm SNI',       'name' => 'Perakitan Besi Cor',  'price' => 5000,  'description' => 'Jasa potong dan rakit besi beton dengan kawat bendrat per batang'],
        ];

        foreach ($installationServices as $svc) {
            $linkedProduct = Product::where('name', $svc['product_name'])->first();
            if ($linkedProduct) {
                Service::firstOrCreate(
                    ['name' => $svc['name'], 'type' => 'pemasangan'],
                    [
                        'price'       => $svc['price'],
                        'product_id'  => $linkedProduct->id,
                        'description' => $svc['description'],
                    ]
                );
            }
        }

        // Pengantaran (per jarak)
        $deliveryServices = [
            ['name' => 'Pengantaran Standar',       'price' => 20000, 'price_per_km' => 5000,  'description' => 'Pengantaran menggunakan pickup untuk material ringan dan sedang'],
            ['name' => 'Pengantaran Besar (Truk)',  'price' => 50000, 'price_per_km' => 8000,  'description' => 'Pengantaran menggunakan truk untuk material berat dan dalam jumlah besar'],
        ];

        foreach ($deliveryServices as $svc) {
            Service::firstOrCreate(
                ['name' => $svc['name'], 'type' => 'pengantaran'],
                [
                    'price'        => $svc['price'],
                    'price_per_km' => $svc['price_per_km'],
                    'description'  => $svc['description'],
                ]
            );
        }

        // Lainnya
        Service::firstOrCreate(
            ['name' => 'Konsultasi Bangunan', 'type' => 'lainnya'],
            [
                'price'       => 0,
                'description' => 'Konsultasi kebutuhan material dan estimasi biaya bangunan secara gratis',
            ]
        );
    }
}
