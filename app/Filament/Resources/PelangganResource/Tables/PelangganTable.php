<?php

namespace App\Filament\Resources\PelangganResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class PelangganTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->toggleable()->label('Nama'),
                Tables\Columns\TextColumn::make('phone_number')->searchable()->sortable()->toggleable()->label('No. Telepon'),
                Tables\Columns\TextColumn::make('address')->searchable()->limit(40)->toggleable()->label('Alamat'),
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
