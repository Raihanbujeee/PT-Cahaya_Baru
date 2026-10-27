<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Route media diletakkan di luar middleware "web" supaya request
            // gambar tidak ikut membuat/menulis session. Di Vercel symlink
            // public/storage tidak tersedia, jadi file dari disk default
            // (public/s3) disajikan lewat route ini.
            Route::get('/storage/{path}', function (string $path) {
                $diskName = config('filesystems.default');

                abort_if($diskName === 'local', 404);

                $disk = Storage::disk($diskName);

                abort_unless($disk->exists($path), 404);

                return $disk->response($path, null, [
                    'Cache-Control' => 'public, max-age=604800',
                ]);
            })->where('path', '.*')->name('storage.show');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
