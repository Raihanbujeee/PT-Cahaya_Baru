<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Filament\Resources\PenjualanResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        // Calculate totals
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
