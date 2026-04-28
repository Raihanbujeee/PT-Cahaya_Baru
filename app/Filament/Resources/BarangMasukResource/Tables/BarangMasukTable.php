<?php

namespace App\Filament\Resources\BarangMasukResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class BarangMasukTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable()->label('ID'),
                Tables\Columns\TextColumn::make('supplier.name')->sortable()->searchable()->toggleable()->label('Supplier'),
                Tables\Columns\TextColumn::make('date')->date()->sortable()->searchable()->toggleable()->label('Tanggal'),
                Tables\Columns\TextColumn::make('total_cost')->money('IDR')->sortable()->toggleable()->label('Total Biaya'),
                Tables\Columns\TextColumn::make('inbound_details_count')
                    ->counts('inboundDetails')
                    ->label('Jumlah Item')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                \Filament\Actions\ViewAction::make(),
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
