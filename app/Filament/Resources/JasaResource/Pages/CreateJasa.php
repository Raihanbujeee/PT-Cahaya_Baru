<?php
namespace App\Filament\Resources\JasaResource\Pages;
use App\Filament\Resources\JasaResource;
use Filament\Resources\Pages\CreateRecord;
class CreateJasa extends CreateRecord
{
    protected static string $resource = JasaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
