<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Data awal (admin, produk, ulasan) dibutuhkan oleh sebagian tes.
        $this->seed();
    }

    public function test_halaman_publik(): void
    {
        $product = Product::query()->first();

        $urls = [
            '/',
            '/produk',
            '/produk/'.$product->id,
            '/layanan',
            '/layanan?page=2',
            '/tentang-kami',
            '/kontak',
        ];

        foreach ($urls as $url) {
            $this->get($url)->assertStatus(200);
        }
    }

    public function test_kirim_ulasan(): void
    {
        $this->post('/reviews', [
            'customer_name' => 'Penguji Ulasan',
            'rating' => 4,
            'comment' => 'Ulasan dari smoke test.',
        ])->assertRedirect();

        $this->assertDatabaseHas('reviews', ['customer_name' => 'Penguji Ulasan']);
    }

    public function test_checkout(): void
    {
        $product = Product::query()->where('current_stock', '>', 0)->firstOrFail();

        $response = $this->postJson('/checkout', [
            'customer_name' => 'Pembeli Uji',
            'customer_phone' => '081200000001',
            'customer_address' => 'Jl. Uji No. 1',
            'cart' => [
                ['id' => $product->id, 'qty' => 1],
            ],
        ]);

        $response->assertOk()->assertJson(['success' => true]);
    }

    public function test_halaman_admin(): void
    {
        $user = User::query()->firstOrFail();
        $this->actingAs($user);

        $urls = [
            '/admin',
            '/admin/produk',
            '/admin/produk/create',
            '/admin/produk/'.Product::query()->first()->id.'/edit',
            '/admin/jasa',
            '/admin/jasa/create',
            '/admin/kategoris',
            '/admin/kategoris/create',
            '/admin/merk',
            '/admin/merk/create',
            '/admin/suppliers',
            '/admin/suppliers/create',
            '/admin/pelanggan',
            '/admin/pelanggan/create',
            '/admin/penjualan',
            '/admin/penjualan/create',
            '/admin/barang-masuk',
            '/admin/barang-masuk/create',
            '/admin/log-stok',
            '/admin/ulasan-pelanggans',
            '/admin/beranda-settings',
            '/admin/kontak-settings',
            '/admin/layanan-settings',
            '/admin/tentang-settings',
        ];

        foreach ($urls as $url) {
            $this->get($url)->assertStatus(200);
        }
    }

    public function test_halaman_edit_data_contoh(): void
    {
        $this->actingAs(User::query()->firstOrFail());

        $urls = [
            '/admin/produk/'.Product::query()->value('id').'/edit',
            '/admin/jasa/'.\App\Models\Service::query()->value('id').'/edit',
            '/admin/kategoris/'.\App\Models\Category::query()->value('id').'/edit',
            '/admin/merk/'.\App\Models\Brand::query()->value('id').'/edit',
            '/admin/suppliers/'.\App\Models\Supplier::query()->value('id').'/edit',
            '/admin/pelanggan/'.\App\Models\Customer::query()->value('id').'/edit',
            '/admin/penjualan/'.\App\Models\Sale::query()->value('id').'/edit',
            '/admin/barang-masuk/'.\App\Models\InboundTransaction::query()->value('id').'/edit',
        ];

        foreach ($urls as $url) {
            $this->get($url)->assertStatus(200);
        }
    }
}
