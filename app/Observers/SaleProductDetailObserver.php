<?php

namespace App\Observers;

use App\Models\SaleProductDetail;
use App\Models\StockLog;

class SaleProductDetailObserver
{
    public function created(SaleProductDetail $detail): void
    {
        $product = $detail->product;
        $product->decrement('current_stock', $detail->quantity);

        StockLog::create([
            'product_id' => $detail->product_id,
            'type' => 'Out',
            'quantity' => $detail->quantity,
            'remaining_stock' => $product->fresh()->current_stock,
            'reference_type' => SaleProductDetail::class,
            'reference_id' => $detail->id,
        ]);

        $this->updateGrandTotal($detail);
    }

    public function updated(SaleProductDetail $detail): void
    {
        if ($detail->wasChanged('quantity')) {
            $diff = $detail->quantity - $detail->getOriginal('quantity');
            $product = $detail->product;
            
            if ($diff > 0) {
                // Quantity sold increased, so stock should decrease
                $product->decrement('current_stock', $diff);
                $type = 'Out';
            } else {
                // Quantity sold decreased, so stock should increase
                $product->increment('current_stock', abs($diff));
                $type = 'Adjustment';
            }

            if ($diff != 0) {
                StockLog::create([
                    'product_id' => $detail->product_id,
                    'type' => $type,
                    'quantity' => abs($diff),
                    'remaining_stock' => $product->fresh()->current_stock,
                    'reference_type' => SaleProductDetail::class,
                    'reference_id' => $detail->id,
                ]);
            }
        }

        $this->updateGrandTotal($detail);
    }

    public function deleted(SaleProductDetail $detail): void
    {
        $product = $detail->product;
        $product->increment('current_stock', $detail->quantity);

        StockLog::create([
            'product_id' => $detail->product_id,
            'type' => 'Adjustment',
            'quantity' => $detail->quantity,
            'remaining_stock' => $product->fresh()->current_stock,
            'reference_type' => SaleProductDetail::class,
            'reference_id' => $detail->id,
        ]);

        $this->updateGrandTotal($detail);
    }

    protected function updateGrandTotal(SaleProductDetail $detail): void
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
