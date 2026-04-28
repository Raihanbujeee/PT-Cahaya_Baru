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
Route::get('/kontak', function () {
    return view('kontak');
});