<?php

namespace App\Filament\Resources\CoreValues\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class CoreValuesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
            ->label('Nama Nilai')
            ->required()
            ->maxLength(255),
                Textarea::make('description')
            ->label('Deskripsi')
            ->required(),
        
    
            ]);
    }
}
