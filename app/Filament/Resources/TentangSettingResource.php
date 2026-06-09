<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TentangSettingResource\Pages\ManageTentangSettings;
use App\Models\TentangSetting;
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

class TentangSettingResource extends Resource
{
    protected static ?string $model = TentangSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-information-circle';
    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan Halaman';
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $pluralModelLabel = 'Pengaturan Tentang Kami';
    protected static ?string $modelLabel = 'Pengaturan Tentang Kami';

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
                Section::make('Bagian Tentang Kami')
                    ->schema([
                        TextInput::make('about_title')->label('Judul Bagian Tentang'),
                        RichEditor::make('about_description')->label('Deskripsi Lengkap')->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')->label('Gambar'),
                TextColumn::make('hero_title')->searchable()->label('Judul Hero'),
                TextColumn::make('about_title')->searchable()->label('Judul Tentang'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)->label('Diperbarui'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTentangSettings::route('/'),
        ];
    }
}
