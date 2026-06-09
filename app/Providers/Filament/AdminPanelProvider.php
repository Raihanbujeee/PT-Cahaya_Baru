<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\View;
use App\Models\FooterSetting;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

    
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('TB Cahaya Baru')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                ValidateCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->renderHook(
            'panels::head.end',
            fn (): string => '
                <style>
                    @import url(\'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap\');

                    .fi-sidebar {
                        width: 220px !important;
                    }

                    .fi-simple-layout {
                        background: linear-gradient(135deg, #11241B 0%, #162E21 40%, #2E2F1A 100%) !important;
                        min-height: 100vh !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                    }

                    .fi-simple-main-ctn {
                        background: transparent !important;
                    }

                    .fi-simple-main {
                        background: rgba(17, 36, 27, 0.85) !important;
                        backdrop-filter: blur(16px) !important;
                        -webkit-backdrop-filter: blur(16px) !important;
                        border: 1px solid rgba(255, 255, 255, 0.08) !important;
                        border-radius: 24px !important;
                        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4), 0 0 25px rgba(228, 214, 169, 0.15) !important;
                        padding: 30px !important;
                        max-width: 460px !important;
                        width: 100% !important;
                    }

                    .fi-simple-header-heading {
                        color: #FFFFFF !important;
                        font-family: \'Space Grotesk\', sans-serif !important;
                        font-weight: 700 !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.5px !important;
                        font-size: 24px !important;
                    }

                    .fi-simple-header p {
                        color: #A3AE98 !important;
                        font-size: 14px !important;
                    }

                    .fi-input-wrp {
                        background-color: rgba(255, 255, 255, 0.05) !important;
                        border: 1px solid rgba(255, 255, 255, 0.08) !important;
                        border-radius: 8px !important;
                        transition: all 0.3s ease !important;
                        box-shadow: none !important;
                    }

                    .fi-input-wrp:focus-within {
                        border-color: #995F2F !important;
                        box-shadow: 0 0 15px rgba(153, 95, 47, 0.4) !important;
                        background-color: rgba(255, 255, 255, 0.08) !important;
                    }

                    .fi-input {
                        color: #FFFFFF !important;
                        font-family: \'Space Grotesk\', sans-serif !important;
                    }

                    .fi-fo-field-label-content {
                        color: #E5EAD8 !important;
                        font-family: \'Space Mono\', monospace !important;
                        font-weight: 700 !important;
                        text-transform: uppercase !important;
                        font-size: 11px !important;
                        letter-spacing: 0.5px !important;
                    }

                    .fi-simple-layout button[type="submit"],
                    .fi-simple-layout .fi-btn {
                        background-color: #995F2F !important;
                        color: #FFFFFF !important;
                        border-radius: 30px !important;
                        padding: 12px 24px !important;
                        font-family: \'Space Mono\', monospace !important;
                        font-weight: 700 !important;
                        text-transform: uppercase !important;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        border: none !important;
                        width: 100% !important;
                    }

                    .fi-simple-layout button[type="submit"]:hover,
                    .fi-simple-layout .fi-btn:hover {
                        background-color: #804F26 !important;
                        transform: translateY(-2px) !important;
                        box-shadow: 0 0 20px rgba(153, 95, 47, 0.45) !important;
                    }

                    .fi-simple-layout a {
                        color: #978F66 !important;
                        font-family: \'Space Mono\', monospace !important;
                        font-size: 12px !important;
                        transition: color 0.3s ease !important;
                    }

                    .fi-simple-layout a:hover {
                        color: #E4D6A9 !important;
                        text-decoration: none !important;
                    }

                    .fi-simple-layout label span {
                        color: #E5EAD8 !important;
                        font-family: \'Space Grotesk\', sans-serif !important;
                        font-size: 13px !important;
                    }
                </style>
            '
             )

            ->authMiddleware([
                Authenticate::class,
            ]);
    }


}
