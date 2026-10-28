<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Vercel (dan hosting lain di balik proxy) meneruskan request sebagai
        // HTTP, sehingga asset()/url() perlu dipaksa memakai HTTPS.
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }
}
