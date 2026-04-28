<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockProducts extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Produk Stok Rendah';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->whereColumn('current_stock', '<=', 'minimum_stock')
                    ->orderBy('current_stock', 'asc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Produk')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\TextColumn::make('brand.name')->label('Merk'),
                Tables\Columns\TextColumn::make('current_stock')
                    ->label('Stok Saat Ini')
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('minimum_stock')->label('Min. Stok'),
            ])
            ->paginated([5, 10, 25]);
    }
}
