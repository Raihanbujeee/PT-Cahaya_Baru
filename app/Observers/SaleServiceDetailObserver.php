<?php

namespace App\Observers;

use App\Models\SaleServiceDetail;

class SaleServiceDetailObserver
{
    public function created(SaleServiceDetail $detail): void
    {
        $this->updateGrandTotal($detail);
    }

    public function updated(SaleServiceDetail $detail): void
    {
        $this->updateGrandTotal($detail);
    }

    public function deleted(SaleServiceDetail $detail): void
    {
        $this->updateGrandTotal($detail);
    }

    protected function updateGrandTotal(SaleServiceDetail $detail): void
    {
        $sale = $detail->sale;
        if ($sale) {
            $productTotal = \DB::table('sale_product_details')
                ->where('sale_id', $sale->id)
                ->sum('subtotal');
            $serviceTotal = \DB::table('sale_service_details')
                ->where('sale_id', $sale->id)
                ->sum('subtotal');
            
            $sale->total_product_price = $productTotal;
            $sale->total_service_price = $serviceTotal;
            $sale->grand_total = $productTotal + $serviceTotal;
            $sale->saveQuietly();
        }
    }
}
