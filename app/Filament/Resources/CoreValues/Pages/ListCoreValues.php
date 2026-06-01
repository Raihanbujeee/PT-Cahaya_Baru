<?php

namespace App\Filament\Resources\CoreValues\Pages;

use App\Filament\Resources\CoreValues\CoreValuesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoreValues extends ListRecords
{
    protected static string $resource = CoreValuesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
