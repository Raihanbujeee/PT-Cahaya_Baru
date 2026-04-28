<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'date',
        'total_product_price',
        'total_service_price',
        'grand_total',
        'payment_method',
        'payment_status',
        'shipping_address',
    ];

    protected $casts = [
        'date' => 'date',
        'total_product_price' => 'decimal:2',
        'total_service_price' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function saleProductDetails(): HasMany
    {
        return $this->hasMany(SaleProductDetail::class);
    }

    public function saleServiceDetails(): HasMany
    {
        return $this->hasMany(SaleServiceDetail::class);
    }
}
