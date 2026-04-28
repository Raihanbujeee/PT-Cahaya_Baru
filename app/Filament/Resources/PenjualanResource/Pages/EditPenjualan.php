<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Filament\Resources\PenjualanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenjualan extends EditRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $totalProduct = 0;
        $totalService = 0;

        foreach ($data['saleProductDetails'] ?? [] as $item) {
            $totalProduct += (float) ($item['subtotal'] ?? 0);
        }
        foreach ($data['saleServiceDetails'] ?? [] as $item) {
            $totalService += (float) ($item['subtotal'] ?? 0);
        }

        $data['total_product_price'] = $totalProduct;
        $data['total_service_price'] = $totalService;
        $data['grand_total'] = $totalProduct + $totalService;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
