<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockLog extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'remaining_stock',
        'reference_type',
        'reference_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'remaining_stock' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
