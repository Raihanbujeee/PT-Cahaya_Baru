<?php

namespace App\Filament\Resources\UlasanPelangganResource\Pages;

use App\Filament\Resources\UlasanPelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUlasanPelanggan extends ManageRecords
{
    protected static string $resource = UlasanPelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Ulasan Manual'),
        ];
    }
}
