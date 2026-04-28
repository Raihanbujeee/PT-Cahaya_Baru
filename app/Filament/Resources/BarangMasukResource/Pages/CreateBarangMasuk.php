<?php

namespace App\Filament\Resources\BarangMasukResource\Pages;

use App\Filament\Resources\BarangMasukResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBarangMasuk extends CreateRecord
{
    protected static string $resource = BarangMasukResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Calculate total_cost from repeater items
        $items = $data['inboundDetails'] ?? [];
        $total = 0;
        foreach ($items as $item) {
            $total += ((int) ($item['quantity'] ?? 0)) * ((float) ($item['cost_price'] ?? 0));
        }
        $data['total_cost'] = $total;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
