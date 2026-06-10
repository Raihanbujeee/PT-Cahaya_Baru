<?php

namespace App\Filament\Resources\AboutContents\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Schemas\Components\Section;

class AboutContentsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Hero')
                        ->required(),

                    Forms\Components\RichEditor::make('description')
                        ->label('Deskripsi Tentang Kami')
                        ->required()
                        ->columnSpanFull(), // Biar editornya lebar

                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Perusahaan')
                        ->image() // Hanya boleh gambar
                        ->directory('about'), // Disimpan di folder storage/app/public/about

                    Forms\Components\TextInput::make('link')
                        ->label('Link Hubungi Kami (WA)')
                        ->url() // Validasi harus format link/URL
                        ->placeholder('https://wa.me/628...'),
                ])
            ]);
    }
}
