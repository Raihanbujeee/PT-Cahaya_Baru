<?php

namespace App\Filament\Resources\BerandaSettingResource\Pages;

use App\Filament\Resources\BerandaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBerandaSettings extends ManageRecords
{
    protected static string $resource = BerandaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaturan Beranda'),
        ];
    }
}
