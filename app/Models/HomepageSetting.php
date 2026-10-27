<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'founded_year' => 'integer',
        'stat_years' => 'integer',
        'stat_products' => 'integer',
        'stat_suppliers' => 'integer',
        'stat_customers' => 'integer',
    ];

    /**
     * Jumlah tahun beroperasi, dihitung dari tahun berdiri supaya tidak
     * perlu diperbarui manual setiap tahun baru.
     */
    public function getYearsOperatingAttribute(): int
    {
        $founded = $this->founded_year ?: 2010;

        return max(1, (int) now()->year - (int) $founded);
    }
}
