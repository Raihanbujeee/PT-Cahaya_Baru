<?php

namespace App\Filament\Resources\CompanyStats\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class CompanyStatsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('label')->label('Nama Statistik')->required()
                        ->label('Nama Statistik (Keterangan)')
                        ->placeholder('Contoh: Tahun Pengalaman')
                        ->required(), // misal: "Tahun Pengalaman"
                Forms\Components\TextInput::make('value')->label('Angka/Nilai')->required()
                ->label('Nilai/Angka')
                        ->placeholder('Contoh: 14+')
                        ->required(),
            ]);
    }
}
