<?php

namespace App\Filament\Resources\SupplierResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class SupplierSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Pemasok'),
            Forms\Components\TextInput::make('contact_info')
                ->maxLength(255)
                ->label('Kontak'),
        ]);
    }
}
