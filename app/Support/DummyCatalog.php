<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DummyCatalog
{
    public static function products(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Semen Portland 50 kg', 'category' => 'Semen', 'brand' => 'Tiga Roda', 'stock' => 85, 'price' => 72000, 'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=700&q=80', 'description' => 'Semen berkualitas untuk pekerjaan konstruksi dan renovasi.'],
            ['id' => 2, 'name' => 'Cat Tembok Interior 5 kg', 'category' => 'Cat Tembok', 'brand' => 'Nippon Paint', 'stock' => 32, 'price' => 185000, 'image' => 'https://images.unsplash.com/photo-1562259929-b7e181d8d002?w=700&q=80', 'description' => 'Cat interior dengan hasil halus dan pilihan warna menarik.'],
            ['id' => 3, 'name' => 'Besi Beton 10 mm', 'category' => 'Besi', 'brand' => 'KS', 'stock' => 120, 'price' => 68000, 'image' => 'https://images.unsplash.com/photo-1590496734187-57ce3dd3045d?w=700&q=80', 'description' => 'Besi beton kokoh untuk kebutuhan struktur bangunan.'],
            ['id' => 4, 'name' => 'Keramik Lantai 40x40 cm', 'category' => 'Keramik', 'brand' => 'Mulia', 'stock' => 48, 'price' => 78000, 'image' => 'https://images.unsplash.com/photo-1523413363574-c30aa1c2a516?w=700&q=80', 'description' => 'Keramik lantai tahan lama untuk rumah dan ruang usaha.'],
            ['id' => 5, 'name' => 'Pipa PVC 3 inch', 'category' => 'Pipa', 'brand' => 'Rucika', 'stock' => 64, 'price' => 95000, 'image' => 'https://images.unsplash.com/photo-1621252179027-94459d278660?w=700&q=80', 'description' => 'Pipa PVC untuk instalasi air dan saluran bangunan.'],
            ['id' => 6, 'name' => 'Kabel NYM 2x1.5 mm', 'category' => 'Kabel', 'brand' => 'Eterna', 'stock' => 27, 'price' => 125000, 'image' => 'https://images.unsplash.com/photo-1558222218-b7b54eede3f3?w=700&q=80', 'description' => 'Kabel listrik untuk instalasi rumah dan bangunan.'],
            ['id' => 7, 'name' => 'Cat Tembok Eksterior 20 kg', 'category' => 'Cat Tembok', 'brand' => 'Dulux', 'stock' => 18, 'price' => 625000, 'image' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=700&q=80', 'description' => 'Perlindungan eksterior tahan cuaca dengan warna tahan lama.'],
            ['id' => 8, 'name' => 'Semen Instan Perekat Keramik', 'category' => 'Semen', 'brand' => 'Mortar Utama', 'stock' => 40, 'price' => 68000, 'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=700&q=80', 'description' => 'Perekat praktis untuk pemasangan keramik yang kuat.'],
        ])->map(fn ($product) => (object) $product);
    }

    public static function services(): Collection
    {
        return collect([
            (object) ['id' => 1, 'name' => 'Pengantaran Material', 'type' => 'pengantaran', 'price' => 25000, 'price_per_km' => 5000, 'description' => 'Pengantaran material langsung ke lokasi proyek.'],
            (object) ['id' => 2, 'name' => 'Konsultasi Material', 'type' => 'lainnya', 'price' => 0, 'price_per_km' => 0, 'description' => 'Bantuan memilih material yang sesuai dengan kebutuhan proyek Anda.'],
            (object) ['id' => 3, 'name' => 'Jasa Pemasangan Keramik', 'type' => 'pemasangan', 'price' => 85000, 'price_per_km' => 0, 'description' => 'Jasa pemasangan keramik oleh tenaga berpengalaman.'],
        ]);
    }

    public static function paginate(Collection $items, int $perPage = 8): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        return new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }
}
