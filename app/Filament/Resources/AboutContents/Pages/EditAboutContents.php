<?php

namespace App\Filament\Resources\AboutContents\Pages;

use App\Filament\Resources\AboutContents\AboutContentsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAboutContents extends EditRecord
{
    protected static string $resource = AboutContentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
