<?php

/**
 * Entry point untuk Vercel Serverless Function.
 *
 * Filesystem deployment Vercel bersifat read-only, hanya /tmp yang bisa
 * ditulis. Karena itu seluruh direktori tulis Laravel (compiled view,
 * session, cache, log) diarahkan ke /tmp sebelum aplikasi di-boot.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Tentukan lokasi storage yang writable
|--------------------------------------------------------------------------
*/

$storagePath = getenv('APP_STORAGE_PATH');

if (! is_string($storagePath) || $storagePath === '') {
    $storagePath = '/tmp/laravel-storage';
}

$storagePath = rtrim($storagePath, '/\\');

$directories = [
    '',
    '/app',
    '/app/private',
    '/app/public',
    '/framework',
    '/framework/cache',
    '/framework/cache/data',
    '/framework/sessions',
    '/framework/testing',
    '/framework/views',
    '/logs',
];

foreach ($directories as $directory) {
    $path = $storagePath.$directory;

    if (! is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

/*
|--------------------------------------------------------------------------
| Pindahkan cache bootstrap & compiled view ke /tmp
|--------------------------------------------------------------------------
|
| Tanpa ini Laravel akan mencoba menulis ke bootstrap/cache dan
| storage/framework/views yang read-only sehingga muncul error
| "The bootstrap/cache directory must be present and writable."
|
*/

$writablePaths = [
    'APP_STORAGE_PATH' => $storagePath,
    'APP_CONFIG_CACHE' => $storagePath.'/framework/cache/config.php',
    'APP_EVENTS_CACHE' => $storagePath.'/framework/cache/events.php',
    'APP_PACKAGES_CACHE' => $storagePath.'/framework/cache/packages.php',
    'APP_ROUTES_CACHE' => $storagePath.'/framework/cache/routes-v7.php',
    'APP_SERVICES_CACHE' => $storagePath.'/framework/cache/services.php',
    'VIEW_COMPILED_PATH' => $storagePath.'/framework/views',
];

foreach ($writablePaths as $key => $value) {
    if (getenv($key) === false || getenv($key) === '') {
        putenv("{$key}={$value}");

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
