<?php

namespace App\Filament\Resources\ProdukResource\Tables;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;

class ProdukTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->label('Gambar')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Nama Produk'),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('brand.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Merk'),
                Tables\Columns\TextColumn::make('purchase_price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable()
                    ->label('Harga Beli'),
                Tables\Columns\TextColumn::make('selling_price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable()
                    ->label('Harga Jual'),
                Tables\Columns\TextColumn::make('current_stock')
                    ->sortable()
                    ->toggleable()
                    ->label('Stok')
                    ->badge()
                    ->color(fn (Product $record): string =>
                        $record->current_stock <= $record->minimum_stock ? 'danger' : 'success'
                    ),
                Tables\Columns\TextColumn::make('minimum_stock')
                    ->sortable()
                    ->label('Min. Stok')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori')
                    ->preload(),
                Tables\Filters\SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Merk')
                    ->preload(),
                Tables\Filters\TernaryFilter::make('low_stock')
                    ->label('Stok Rendah')
                    ->queries(
                        true: fn ($query) => $query->whereColumn('current_stock', '<=', 'minimum_stock'),
                        false: fn ($query) => $query->whereColumn('current_stock', '>', 'minimum_stock'),
                    ),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
