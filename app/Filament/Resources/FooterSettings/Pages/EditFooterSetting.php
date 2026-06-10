<?php

namespace App\Filament\Resources\FooterSettings\Pages;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }


}
