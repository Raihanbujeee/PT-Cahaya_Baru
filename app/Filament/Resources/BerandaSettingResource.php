<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerandaSettingResource\Pages\ManageBerandaSettings;
use App\Models\HomepageSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BerandaSettingResource extends Resource
{
    protected static ?string $model = HomepageSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-home';
    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan Halaman';
    protected static ?string $navigationLabel = 'Beranda';
    protected static ?string $pluralModelLabel = 'Pengaturan Beranda';
    protected static ?string $modelLabel = 'Pengaturan Beranda';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Hero Section')
                    ->description('Bagian atas halaman beranda.')
                    ->schema([
                        TextInput::make('hero_title')->required(),
                        RichEditor::make('hero_description')->columnSpanFull(),
                        FileUpload::make('hero_image')->image()->directory('settings')->label('Gambar Latar (Hero Image)'),
                    ]),
                Section::make('Tentang & Statistik')
                    ->schema([
                        TextInput::make('about_title'),
                        RichEditor::make('about_desc_1')->columnSpanFull(),
                        RichEditor::make('about_desc_2')->columnSpanFull(),
                        TextInput::make('stat_years')->numeric()->default(0)->label('Tahun Beroperasi'),
                        TextInput::make('stat_products')->numeric()->default(0)->label('Produk Tersedia'),
                        TextInput::make('stat_suppliers')->numeric()->default(0)->label('Mitra Supplier'),
                        TextInput::make('stat_customers')->numeric()->default(0)->label('Pelanggan Puas'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')->label('Gambar'),
                TextColumn::make('hero_title')->searchable()->label('Judul Hero'),
                TextColumn::make('about_title')->searchable()->label('Judul Tentang'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBerandaSettings::route('/'),
        ];
    }
}
