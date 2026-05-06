<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananSettingResource\Pages\ManageLayananSettings;
use App\Models\LayananSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LayananSettingResource extends Resource
{
    protected static ?string $model = LayananSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan Halaman';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?string $pluralModelLabel = 'Pengaturan Layanan';
    protected static ?string $modelLabel = 'Pengaturan Layanan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Hero Section')
                    ->schema([
                        TextInput::make('hero_title')->required(),
                        Textarea::make('hero_description')->columnSpanFull(),
                        FileUpload::make('hero_image')->image()->directory('settings')->label('Gambar Latar (Hero Image)'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')->label('Gambar'),
                TextColumn::make('hero_title')->searchable()->label('Judul Hero'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLayananSettings::route('/'),
        ];
    }
}
