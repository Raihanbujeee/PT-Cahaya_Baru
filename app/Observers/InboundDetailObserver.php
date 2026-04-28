<?php

namespace App\Observers;

use App\Models\InboundDetail;
use App\Models\StockLog;

class InboundDetailObserver
{
    public function created(InboundDetail $detail): void
    {
        $product = $detail->product;
        $product->increment('current_stock', $detail->quantity);

        StockLog::create([
            'product_id' => $detail->product_id,
            'type' => 'In',
            'quantity' => $detail->quantity,
            'remaining_stock' => $product->fresh()->current_stock,
            'reference_type' => InboundDetail::class,
            'reference_id' => $detail->id,
        ]);

        $this->updateTotalCost($detail);
    }

    public function updated(InboundDetail $detail): void
    {
        if ($detail->wasChanged('quantity')) {
            $diff = $detail->quantity - $detail->getOriginal('quantity');
            $product = $detail->product;
            
            if ($diff > 0) {
                $product->increment('current_stock', $diff);
                $type = 'In';
            } else {
                $product->decrement('current_stock', abs($diff));
                $type = 'Adjustment';
            }

            if ($diff != 0) {
                StockLog::create([
                    'product_id' => $detail->product_id,
                    'type' => $type,
                    'quantity' => abs($diff),
                    'remaining_stock' => $product->fresh()->current_stock,
                    'reference_type' => InboundDetail::class,
                    'reference_id' => $detail->id,
                ]);
            }
        }
        
        $this->updateTotalCost($detail);
    }

    public function deleted(InboundDetail $detail): void
    {
        $product = $detail->product;
        $product->decrement('current_stock', $detail->quantity);

        StockLog::create([
            'product_id' => $detail->product_id,
            'type' => 'Adjustment',
            'quantity' => $detail->quantity,
            'remaining_stock' => $product->fresh()->current_stock,
            'reference_type' => InboundDetail::class,
            'reference_id' => $detail->id,
        ]);

        $this->updateTotalCost($detail);
    }

    protected function updateTotalCost(InboundDetail $detail): void
    {
        $transaction = $detail->inboundTransaction;
        if ($transaction) {
            $total = \DB::table('inbound_details')
                ->where('inbound_transaction_id', $transaction->id)
                ->sum(\DB::raw('quantity * cost_price'));
            
            // updateQuietly prevents triggering saving events on parent causing infinite loops if parent has child observers
            $transaction->total_cost = $total;
            $transaction->saveQuietly();
        }
    }
}
