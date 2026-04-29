<?php

namespace App\Filament\Pages;
use BackedEnum;
use Filament\Pages\Page;

class AboutUs extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected string $view = 'filament.pages.about-us';
}
