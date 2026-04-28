<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function saleServiceDetails(): HasMany
    {
        return $this->hasMany(SaleServiceDetail::class);
    }
}
