<?php

namespace App\Filament\Resources\MerkResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class MerkSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Merk'),
        ]);
    }
}
