<?php

namespace App\Filament\Resources\TentangSettingResource\Pages;

use App\Filament\Resources\TentangSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTentangSettings extends ManageRecords
{
    protected static string $resource = TentangSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaturan Tentang Kami'),
        ];
    }
}
