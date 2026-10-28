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
| Sajikan aset statis dari folder public/
|--------------------------------------------------------------------------
|
| Idealnya file di public/ disajikan langsung oleh CDN Vercel (lihat route
| "handle: filesystem" di vercel.json). Kalau karena satu dan lain hal
| request aset tetap sampai ke function ini, file-nya disajikan di sini
| supaya CSS/JS/gambar tidak pernah 404.
|
| Yang dilayani hanya file di dalam public/ dan hanya ekstensi aset yang
| aman. File .php dan dotfile (.htaccess, .env) sengaja diblokir agar
| source code tidak pernah ikut tersaji.
|
*/

$publicPath = realpath(__DIR__.'/../public');
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

if (is_string($requestPath) && $requestPath !== '' && $requestPath !== '/') {
    $requestPath = rawurldecode($requestPath);

    // Jangan pernah melayani front controller / file konfigurasi web mentah.
    if (in_array($requestPath, ['/index.php', '/public/index.php', '/.htaccess'], true)) {
        http_response_code(404);

        exit;
    }

    if ($publicPath !== false && ! str_contains($requestPath, "\0")) {
        $candidate = realpath($publicPath.$requestPath);
        $extension = $candidate === false ? '' : strtolower(pathinfo($candidate, PATHINFO_EXTENSION));

        $allowed = [
            'css' => 'text/css; charset=UTF-8',
            'js' => 'application/javascript; charset=UTF-8',
            'mjs' => 'application/javascript; charset=UTF-8',
            'json' => 'application/json; charset=UTF-8',
            'map' => 'application/json; charset=UTF-8',
            'txt' => 'text/plain; charset=UTF-8',
            'xml' => 'application/xml; charset=UTF-8',
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'ico' => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'otf' => 'font/otf',
            'eot' => 'application/vnd.ms-fontobject',
        ];

        if (
            $candidate !== false
            && isset($allowed[$extension])
            && str_starts_with($candidate, $publicPath.DIRECTORY_SEPARATOR)
            && is_file($candidate)
        ) {
            header('Content-Type: '.$allowed[$extension]);
            header('Content-Length: '.filesize($candidate));
            header('Cache-Control: public, max-age=86400, s-maxage=604800');
            header('X-Content-Type-Options: nosniff');

            readfile($candidate);

            exit;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Normalisasi path info
|--------------------------------------------------------------------------
|
| PHP built-in server (yang dipakai runtime vercel-php) mengisi SCRIPT_NAME
| dengan path request kalau kebetulan ada file dengan nama sama di folder
| project. Akibatnya Laravel menganggap request-nya "/" sehingga URL seperti
| /composer.json menampilkan beranda. Di sini SCRIPT_NAME dikembalikan ke
| front controller supaya path info selalu utuh.
|
*/

$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__.'/../public/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

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

// Di Vercel, log yang ditulis ke file /tmp tidak terlihat di dashboard.
// Kalau LOG_CHANNEL belum diatur, arahkan ke stderr agar error tetap terbaca.
if (getenv('VERCEL') && (getenv('LOG_CHANNEL') === false || getenv('LOG_CHANNEL') === '')) {
    putenv('LOG_CHANNEL=stderr');

    $_ENV['LOG_CHANNEL'] = 'stderr';
    $_SERVER['LOG_CHANNEL'] = 'stderr';
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
