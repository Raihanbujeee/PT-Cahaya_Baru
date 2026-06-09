<?php

namespace App\Filament\Resources\SupplierResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class SupplierTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->toggleable()->label('Nama Pemasok'),
                Tables\Columns\TextColumn::make('contact_info')->searchable()->toggleable()->label('Kontak'),
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
