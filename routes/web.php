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
