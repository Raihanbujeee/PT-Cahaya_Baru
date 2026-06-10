<?php

namespace App\Filament\Resources\CoreValues;

use App\Filament\Resources\CoreValues\Pages\CreateCoreValues;
use App\Filament\Resources\CoreValues\Pages\EditCoreValues;
use App\Filament\Resources\CoreValues\Pages\ListCoreValues;
use App\Filament\Resources\CoreValues\Schemas\CoreValuesForm;
use App\Filament\Resources\CoreValues\Tables\CoreValuesTable;
use App\Models\CoreValues;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CoreValuesResource extends Resource
{
    // Use string class name to avoid undefined class reference issues during static analysis
    protected static ?string $model = 'App\\Models\\CoreValues';
    public static function getNavigationGroup(): ?string
{
    return 'Tentang Kami';
}
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CoreValuesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoreValuesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoreValues::route('/'),
            'create' => CreateCoreValues::route('/create'),
            'edit' => EditCoreValues::route('/{record}/edit'),
        ];
    }
}
