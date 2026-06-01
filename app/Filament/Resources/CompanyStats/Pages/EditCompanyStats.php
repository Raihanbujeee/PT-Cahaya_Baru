<?php

namespace App\Filament\Resources\CompanyStats\Pages;

use App\Filament\Resources\CompanyStats\CompanyStatsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyStats extends EditRecord
{
    protected static string $resource = CompanyStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
