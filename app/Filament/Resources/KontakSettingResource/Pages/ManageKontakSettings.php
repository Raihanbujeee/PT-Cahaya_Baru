<?php

namespace App\Filament\Resources\KontakSettingResource\Pages;

use App\Filament\Resources\KontakSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKontakSettings extends ManageRecords
{
    protected static string $resource = KontakSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaturan Kontak'),
        ];
    }
}
