<?php

namespace App\Filament\Resources\LayananSettingResource\Pages;

use App\Filament\Resources\LayananSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLayananSettings extends ManageRecords
{
    protected static string $resource = LayananSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaturan Layanan'),
        ];
    }
}
