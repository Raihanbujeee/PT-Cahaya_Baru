<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class Media
{
    /**
     * Nama disk yang dipakai untuk media publik.
     *
     * Mengikuti FILESYSTEM_DISK supaya konsisten dengan upload Filament:
     * di lokal `public`, di produksi bisa `s3` / `r2`.
     */
    public static function disk(): string
    {
        return config('filesystems.default', 'public');
    }

    /**
     * Cek apakah file benar-benar ada di disk.
     *
     * Di Vercel folder storage bersifat sementara, jadi path yang tercatat di
     * database bisa menunjuk file yang sudah hilang setelah redeploy.
     */
    public static function exists(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        try {
            return Storage::disk(self::disk())->exists($path);
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * URL media (foto produk / hero / foto toko).
     *
     * Kalau file tidak ada, dipakai aset statis di `public/images` supaya
     * tidak ada gambar rusak.
     */
    public static function url(?string $path, string $fallback): string
    {
        if (self::exists($path)) {
            return asset('storage/'.$path);
        }

        return asset($fallback);
    }
}
