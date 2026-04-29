<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', function () {
    $products = Product::with(['category', 'brand'])->get();
    return view('produk', compact('products'));
});

Route::get('/produk/{id}', function ($id) {
    $product = Product::with(['category', 'brand'])->findOrFail($id);
    return view('detail_produk', compact('product'));
});

Route::get('/tentang-kami', function () {
    return view('tentang');
});


Route::get('/api/services', function () {
    $services = \App\Models\Service::orderBy('name')
        ->get(['id', 'name', 'price', 'description']);
    return response()->json($services);
});

Route::post('/checkout', function (Illuminate\Http\Request $request) {
    $request->validate([
        'customer_name'    => 'required|string|max:255',
        'customer_phone'   => 'required|string|max:20',
        'customer_address' => 'required|string',
        'cart'             => 'required|array|min:1',
        'cart.*.id'        => 'required|integer|exists:products,id',
        'cart.*.qty'       => 'required|integer|min:1',
        'services'         => 'nullable|array',
        'services.*.id'    => 'required_with:services|integer|exists:services,id',
        'services.*.qty'   => 'required_with:services|integer|min:1',
    ]);

    try {
        $result = Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            // 1. Create or Get Customer
            $customer = \App\Models\Customer::firstOrCreate(
                ['phone_number' => $request->customer_phone],
                [
                    'name'    => $request->customer_name,
                    'address' => $request->customer_address,
                ]
            );

            // Get default user (Admin) for POS
            $adminUser = \App\Models\User::first();
            $userId    = $adminUser ? $adminUser->id : 1;

            // 2. Create Sale Record
            $sale = \App\Models\Sale::create([
                'customer_id'         => $customer->id,
                'user_id'             => $userId,
                'date'                => now(),
                'total_product_price' => 0,
                'total_service_price' => 0,
                'grand_total'         => 0,
                'payment_method'      => 'Cash',
                'payment_status'      => 'Unpaid',
                'shipping_address'    => $request->customer_address,
            ]);

            $productTotal = 0;
            $serviceTotal = 0;
            $productText  = "";
            $serviceText  = "";

            // 3. Process Cart (Products)
            foreach ($request->cart as $item) {
                $product = \App\Models\Product::lockForUpdate()->findOrFail($item['id']);
                $qty     = (int) $item['qty'];

                if ($product->current_stock < $qty) {
                    throw new \Exception("Stok untuk produk {$product->name} tidak mencukupi (Sisa: {$product->current_stock}).");
                }

                // Deduct stock
                $product->current_stock -= $qty;
                $product->save();

                $price    = (float) $product->selling_price;
                $subtotal = $price * $qty;

                \App\Models\SaleProductDetail::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'unit_price' => $price,
                    'subtotal'   => $subtotal,
                ]);

                // Log stock out
                if (\Illuminate\Support\Facades\Schema::hasTable('stock_logs')) {
                    \Illuminate\Support\Facades\DB::table('stock_logs')->insert([
                        'product_id'      => $product->id,
                        'type'            => 'Out',
                        'quantity'        => $qty,
                        'remaining_stock' => $product->current_stock,
                        'reference_type'  => 'App\Models\Sale',
                        'reference_id'    => $sale->id,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ]);
                }

                $productTotal += $subtotal;
                $productText  .= "  - {$product->name} ({$qty} pcs) = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
            }

            // 4. Process Services
            foreach ($request->services ?? [] as $item) {
                $service  = \App\Models\Service::findOrFail($item['id']);
                $qty      = (int) $item['qty'];
                $price    = (float) $service->price;
                $subtotal = $price * $qty;

                \App\Models\SaleServiceDetail::create([
                    'sale_id'    => $sale->id,
                    'service_id' => $service->id,
                    'quantity'   => $qty,
                    'unit_price' => $price,
                    'subtotal'   => $subtotal,
                ]);

                $serviceTotal += $subtotal;
                $serviceText  .= "  - {$service->name} (x{$qty}) = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
            }

            // 5. Update Sale totals
            $grandTotal = $productTotal + $serviceTotal;
            $sale->total_product_price = $productTotal;
            $sale->total_service_price = $serviceTotal;
            $sale->grand_total         = $grandTotal;
            $sale->save();

            // 6. Generate WA Message
            $waNumber = '6283834079959';
            $message  = "Halo PT Cahaya Baru, saya ingin memproses pesanan saya:\n\n";
            $message .= "*Data Pemesan:*\n";
            $message .= "Nama: {$customer->name}\n";
            $message .= "No. HP: {$customer->phone_number}\n";
            $message .= "Alamat: {$request->customer_address}\n\n";

            $message .= "*Produk yang Dipesan:*\n";
            $message .= $productText ?: "  (tidak ada)\n";

            if ($serviceText) {
                $message .= "\n*Jasa yang Digunakan:*\n";
                $message .= $serviceText;
            }

            $message .= "\n*Rincian Biaya:*\n";
            $message .= "  Total Produk : Rp " . number_format($productTotal, 0, ',', '.') . "\n";
            if ($serviceTotal > 0) {
                $message .= "  Total Jasa   : Rp " . number_format($serviceTotal, 0, ',', '.') . "\n";
            }
            $message .= "  *Grand Total : Rp " . number_format($grandTotal, 0, ',', '.') . "*\n\n";
            $message .= "Mohon informasi untuk pembayaran dan pengirimannya. Terima kasih.";

            $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

            return [
                'success' => true,
                'wa_url'  => $waUrl,
                'sale_id' => $sale->id,
            ];
        });

        return response()->json($result);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 422);
    }
});
