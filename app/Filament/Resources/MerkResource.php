<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MerkResource\Pages;
use App\Filament\Resources\MerkResource\Schemas\MerkSchema;
use App\Filament\Resources\MerkResource\Tables\MerkTable;
use App\Models\Brand;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class MerkResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-storefront';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $slug = 'merk';
    protected static ?string $navigationLabel = 'Merk';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MerkSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return MerkTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMerks::route('/'),
            'create' => Pages\CreateMerk::route('/create'),
            'edit' => Pages\EditMerk::route('/{record}/edit'),
        ];
    }
}
