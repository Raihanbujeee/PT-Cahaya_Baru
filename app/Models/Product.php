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

    /**
     * URL gambar produk.
     *
     * Urutan: file unggahan admin (kalau benar-benar ada) → foto bawaan sesuai
     * nama produk → foto bawaan sesuai kategori → gambar default. Pengecekan
     * keberadaan file penting karena di serverless (Vercel) folder storage
     * bersifat sementara, sehingga path lama bisa menunjuk file yang hilang.
     */
    public function getImageUrlAttribute(): string
    {
        if (\App\Support\Media::exists($this->image)) {
            return asset('storage/'.$this->image);
        }

        return self::fallbackImageFor($this->name, $this->category?->name);
    }

    public static function fallbackImageFor(?string $name = null, ?string $category = null): string
    {
        // Dicocokkan berurutan; aturan paling spesifik harus lebih dulu
        // (mis. "Semen Putih" sebelum "Semen").
        $map = [
            'semen putih' => 'semen-putih',
            'semen' => 'semen',
            'cat kayu' => 'cat-kayu',
            'cat besi' => 'cat-kayu',
            'cat' => 'cat',
            'besi beton' => 'besi',
            'besi siku' => 'besi-profil',
            'besi hollow' => 'besi-profil',
            'besi' => 'besi',
            'keramik dinding' => 'keramik-dinding',
            'keramik kamar mandi' => 'keramik-km',
            'anti slip' => 'keramik-km',
            'keramik' => 'keramik',
            'pipa' => 'pipa',
            'knie' => 'pipa',
            'kabel' => 'kabel',
            'gypsum' => 'gypsum',
            'paku' => 'paku',
            'genteng metal' => 'genteng-metal',
            'genteng' => 'genteng',
            'batako' => 'batako',
            'bata' => 'bata',
            'kayu' => 'kayu',
            'engsel' => 'engsel',
            'saklar' => 'saklar',
        ];

        $haystacks = [
            strtolower($name ?? ''),
            strtolower($category ?? ''),
        ];

        foreach ($haystacks as $haystack) {
            if ($haystack === '') {
                continue;
            }

            foreach ($map as $needle => $file) {
                if (str_contains($haystack, $needle)) {
                    return asset('images/produk/'.$file.'.jpg');
                }
            }
        }

        return asset('images/produk/default.jpg');
    }
}
