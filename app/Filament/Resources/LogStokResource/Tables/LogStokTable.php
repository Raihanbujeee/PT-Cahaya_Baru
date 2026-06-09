<?php

namespace App\Filament\Resources\LogStokResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class LogStokTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable()->label('ID'),
                Tables\Columns\TextColumn::make('product.name')->sortable()->searchable()->toggleable()->label('Produk'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable()
                    ->toggleable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'In' => 'Masuk',
                        'Out' => 'Keluar',
                        'Adjustment' => 'Penyesuaian',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'In' => 'success',
                        'Out' => 'danger',
                        'Adjustment' => 'warning',
                        default => 'gray',
                    })
                    ->label('Tipe'),
                Tables\Columns\TextColumn::make('quantity')->sortable()->toggleable()->label('Jumlah'),
                Tables\Columns\TextColumn::make('remaining_stock')->sortable()->toggleable()->label('Sisa Stok'),
                Tables\Columns\TextColumn::make('reference_type')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'App\\Models\\InboundDetail' => 'Barang Masuk',
                        'App\\Models\\SaleProductDetail' => 'Penjualan',
                        default => $state ?? '-',
                    })
                    ->searchable()
                    ->toggleable()
                    ->label('Referensi'),
                Tables\Columns\TextColumn::make('reference_id')->sortable()->searchable()->toggleable()->label('Ref. ID'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable()->label('Waktu'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'In' => 'Masuk',
                        'Out' => 'Keluar',
                        'Adjustment' => 'Penyesuaian',
                    ])
                    ->label('Tipe'),
                Tables\Filters\SelectFilter::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Produk'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
            ]);
    }
}
