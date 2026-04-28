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
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->toggleable()->label('Nama Jasa'),
                Tables\Columns\TextColumn::make('price')->money('IDR')->sortable()->toggleable()->label('Harga'),
                Tables\Columns\TextColumn::make('description')->searchable()->limit(50)->toggleable()->label('Deskripsi'),
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
