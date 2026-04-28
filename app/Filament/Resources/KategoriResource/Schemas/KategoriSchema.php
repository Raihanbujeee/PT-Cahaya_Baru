<?php

namespace App\Filament\Resources\KategoriResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class KategoriSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Kategori'),
        ]);
    }
}
