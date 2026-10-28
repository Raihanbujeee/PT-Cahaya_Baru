<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Ulasan pelanggan awal.
     *
     * Sebelumnya halaman beranda memakai daftar ulasan hardcoded di view
     * karena tabel ini kosong, sehingga ulasan tidak bisa dikelola dari
     * panel admin. Data ini dipindahkan ke database supaya bisa diubah
     * atau dihapus lewat menu "Ulasan Pelanggan".
     */
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'Budi Santoso',
                'rating' => 5,
                'comment' => 'Material selalu lengkap dan kualitasnya terjamin. Pengiriman ke lokasi proyek selalu tepat waktu. Sangat membantu operasional kontraktor.',
            ],
            [
                'customer_name' => 'Rina Wijaya',
                'rating' => 5,
                'comment' => 'Pelayanan stafnya luar biasa. Saat saya renovasi rumah, mereka sabar merekomendasikan jenis cat dan keramik yang pas dengan budget. Toko langganan!',
            ],
            [
                'customer_name' => 'Andi Pratama',
                'rating' => 5,
                'comment' => 'Harga sangat bersaing terutama untuk pembelian partai besar. Proses PO jelas dan tagihan selalu rapi. Mitra bisnis yang solid.',
            ],
        ];

        foreach ($reviews as $review) {
            Review::firstOrCreate(
                ['customer_name' => $review['customer_name'], 'comment' => $review['comment']],
                ['rating' => $review['rating']]
            );
        }
    }
}
