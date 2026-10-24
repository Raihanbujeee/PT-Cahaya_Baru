<?php

return [
    App\Providers\AppServiceProvider::class,
    ...(filter_var(env('VERCEL', false), FILTER_VALIDATE_BOOL) || filter_var(env('DEMO_MODE', false), FILTER_VALIDATE_BOOL) ? [] : [App\Providers\Filament\AdminPanelProvider::class]),
];
