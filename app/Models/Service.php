<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'type', 'price', 'price_per_km', 'product_id', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
        'price_per_km' => 'decimal:2',
    ];

    /**
     * Relasi ke produk (hanya untuk type = pemasangan)
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function saleServiceDetails(): HasMany
    {
        return $this->hasMany(SaleServiceDetail::class);
    }

    /**
     * Hitung biaya jasa
     * - Pemasangan: price × qty
     * - Pengantaran: price (base fee) + (price_per_km × jarak)
     * - Lainnya: price × qty
     */
    public function calculateCost(int $qty = 1, ?float $distanceKm = null): float
    {
        if ($this->type === 'pengantaran' && $distanceKm !== null) {
            return (float) $this->price + ((float) $this->price_per_km * $distanceKm);
        }

        return (float) $this->price * $qty;
    }
}
