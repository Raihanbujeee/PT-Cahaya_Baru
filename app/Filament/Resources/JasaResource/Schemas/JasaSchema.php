<?php

namespace App\Filament\Resources\JasaResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class JasaSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Jasa'),
            Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->label('Harga'),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->columnSpanFull(),
        ]);
    }
}
