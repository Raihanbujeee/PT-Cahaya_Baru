<?php

namespace App\Models;

use App\Observers\InboundDetailObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(InboundDetailObserver::class)]
class InboundDetail extends Model
{
    protected $fillable = ['inbound_transaction_id', 'product_id', 'quantity', 'cost_price'];

    protected $casts = [
        'quantity' => 'integer',
        'cost_price' => 'decimal:2',
    ];

    public function inboundTransaction(): BelongsTo
    {
        return $this->belongsTo(InboundTransaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
