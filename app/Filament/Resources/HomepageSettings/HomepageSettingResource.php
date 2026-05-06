<?php

namespace App\Filament\Resources\HomepageSettings;

use App\Filament\Resources\HomepageSettings\Pages\ManageHomepageSettings;
use App\Models\HomepageSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomepageSettingResource extends Resource
{
    protected static ?string $model = HomepageSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Pengaturan Beranda';
    protected static ?string $pluralModelLabel = 'Pengaturan Beranda';
    protected static ?string $modelLabel = 'Pengaturan Beranda';

    protected static ?string $recordTitleAttribute = 'hero_title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hero_title')
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('hero_description')
                    ->columnSpanFull(),
                TextInput::make('about_title'),
                \Filament\Forms\Components\RichEditor::make('about_desc_1')
                    ->columnSpanFull(),
                \Filament\Forms\Components\RichEditor::make('about_desc_2')
                    ->columnSpanFull(),
                TextInput::make('stat_years')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('stat_products')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('stat_suppliers')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('stat_customers')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hero_title')
            ->columns([
                TextColumn::make('hero_title')
                    ->searchable(),
                TextColumn::make('about_title')
                    ->searchable(),
                TextColumn::make('stat_years')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stat_products')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stat_suppliers')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stat_customers')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageHomepageSettings::route('/'),
        ];
    }
}
