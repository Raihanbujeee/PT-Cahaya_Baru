<?php

use App\Support\DummyCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

$products = DummyCatalog::products();
$services = DummyCatalog::services();

View::composer(['welcome', 'produk', 'detail_produk', 'layanan'], function ($view) use ($services) {
    $view->with('servicesList', $services);
    $view->with('allServicesData', $services->map(fn ($service) => [
        'id' => $service->id,
        'name' => $service->name,
        'type' => $service->type,
        'price' => $service->price,
        'price_per_km' => $service->price_per_km,
        'description' => $service->description,
    ]));
});

Route::get('/', fn () => view('welcome', [
    'featuredProducts' => $products->take(4),
    'services' => $services->take(6),
    'homepageSetting' => null,
    'reviews' => collect(),
]));

Route::get('/produk', fn () => view('produk', ['products' => $products]));

Route::get('/produk/{id}', function (int $id) use ($products) {
    $product = $products->firstWhere('id', $id);
    abort_if(! $product, 404);
    return view('detail_produk', compact('product'));
});

Route::get('/layanan', fn () => view('layanan', [
    'services' => DummyCatalog::paginate($services),
    'layananSetting' => null,
]));

Route::view('/tentang-kami', 'tentang');
Route::view('/kontak', 'kontak');

Route::post('/checkout', function (Request $request) use ($products, $services) {
    $data = $request->validate([
        'customer_name' => ['required', 'string', 'max:255'],
        'customer_phone' => ['required', 'string', 'max:30'],
        'customer_address' => ['required', 'string', 'max:1000'],
        'cart' => ['required', 'array', 'min:1'],
        'cart.*.id' => ['required', 'integer'],
        'cart.*.qty' => ['required', 'integer', 'min:1'],
        'services' => ['nullable', 'array'],
        'services.*.id' => ['required_with:services', 'integer'],
        'services.*.qty' => ['required_with:services', 'integer', 'min:1'],
        'services.*.distance' => ['nullable', 'numeric', 'min:0'],
    ]);

    abort_if(count($data['cart']) > 30 || count($data['services'] ?? []) > 20, 422, 'Jumlah item pesanan terlalu banyak.');

    $lines = [];
    $productTotal = 0;
    foreach ($data['cart'] as $item) {
        $product = $products->firstWhere('id', (int) $item['id']);
        abort_if(! $product, 422, 'Produk tidak ditemukan.');
        abort_if($item['qty'] > 999, 422, 'Jumlah produk terlalu banyak.');
        $subtotal = $product->price * $item['qty'];
        $productTotal += $subtotal;
        $lines[] = "- {$product->name} x{$item['qty']}: Rp ".number_format($subtotal, 0, ',', '.');
    }

    $serviceTotal = 0;
    foreach ($data['services'] ?? [] as $item) {
        $service = $services->firstWhere('id', (int) $item['id']);
        abort_if(! $service, 422, 'Layanan tidak ditemukan.');
        $distance = (float) ($item['distance'] ?? 0);
        abort_if($distance > 1000 || $item['qty'] > 999, 422, 'Jumlah layanan atau jarak terlalu besar.');
        $subtotal = $service->type === 'pengantaran'
            ? $service->price + ($service->price_per_km * $distance)
            : $service->price * $item['qty'];
        $serviceTotal += $subtotal;
        $lines[] = "- {$service->name}: Rp ".number_format($subtotal, 0, ',', '.');
    }

    $message = "Halo TB Cahaya Baru, saya ingin memesan:\n\nNama: {$data['customer_name']}\nNo. HP: {$data['customer_phone']}\nAlamat: {$data['customer_address']}\n\n".implode("\n", $lines)."\n\nTotal: Rp ".number_format($productTotal + $serviceTotal, 0, ',', '.');

    return response()->json(['success' => true, 'wa_url' => 'https://wa.me/6283834079959?text='.urlencode($message)]);
});
