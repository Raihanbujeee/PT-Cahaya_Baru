<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontakSettingResource\Pages\ManageKontakSettings;
use App\Models\KontakSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KontakSettingResource extends Resource
{
    protected static ?string $model = KontakSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-phone';
    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan Halaman';
    protected static ?string $navigationLabel = 'Kontak';
    protected static ?string $pluralModelLabel = 'Pengaturan Kontak';
    protected static ?string $modelLabel = 'Pengaturan Kontak';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Bagian Hero')
                    ->schema([
                        TextInput::make('hero_title')->required(),
                        Textarea::make('hero_description')->columnSpanFull(),
                        FileUpload::make('hero_image')->image()->directory('settings')->label('Gambar Latar (Hero Image)'),
                    ]),
                Section::make('Informasi Kontak')
                    ->schema([
                        TextInput::make('phone')->label('Nomor Telepon/WA')->required(),
                        TextInput::make('email')->email()->required(),
                        Textarea::make('address')->label('Alamat Lengkap')->columnSpanFull()->required(),
                    ])->columns(2),
                Section::make('Jam Operasional')
                    ->schema([
                        TextInput::make('hours_weekday')->label('Senin - Jumat')->required(),
                        TextInput::make('hours_saturday')->label('Sabtu')->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')->label('Gambar'),
                TextColumn::make('hero_title')->searchable()->label('Judul Hero'),
                TextColumn::make('phone')->label('Telepon'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->label('Diperbarui'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKontakSettings::route('/'),
        ];
    }
}
