<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'image',
        'purchase_price',
        'selling_price',
        'current_stock',
        'minimum_stock',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'current_stock' => 'integer',
        'minimum_stock' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function stockLogs(): HasMany
    {
        return $this->hasMany(StockLog::class);
    }

    public function saleProductDetails(): HasMany
    {
        return $this->hasMany(SaleProductDetail::class);
    }

    public function inboundDetails(): HasMany
    {
        return $this->hasMany(InboundDetail::class);
    }

    public function isLowStock(): bool
    {
        return $this->current_stock <= $this->minimum_stock;
    }

    /**
     * Jasa pemasangan yang terkait dengan produk ini (1 produk → 1 jasa pemasangan)
     */
    public function installationService(): HasOne
    {
        return $this->hasOne(Service::class)->where('type', 'pemasangan');
    }
}
