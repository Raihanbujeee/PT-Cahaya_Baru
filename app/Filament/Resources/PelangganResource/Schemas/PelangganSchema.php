<?php

namespace App\Filament\Resources\PelangganResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class PelangganSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama'),
            Forms\Components\TextInput::make('phone_number')
                ->required()
                ->tel()
                ->maxLength(20)
                ->label('No. Telepon'),
            Forms\Components\Textarea::make('address')
                ->label('Alamat')
                ->columnSpanFull(),
        ]);
    }
}
