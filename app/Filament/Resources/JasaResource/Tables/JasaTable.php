<?php

namespace App\Filament\Resources\JasaResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class JasaTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable()
                    ->label('ID'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Nama Jasa'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pemasangan'  => 'Pemasangan',
                        'pengantaran' => 'Pengantaran',
                        default       => 'Lainnya',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pemasangan'  => 'info',
                        'pengantaran' => 'warning',
                        default       => 'gray',
                    })
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk Terkait')
                    ->placeholder('-')
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable()
                    ->label('Harga / Biaya Awal'),

                Tables\Columns\TextColumn::make('price_per_km')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable()
                    ->label('Tarif / Km')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50)
                    ->toggleable()
                    ->label('Deskripsi'),
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
