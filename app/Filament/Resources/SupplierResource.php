<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\Schemas\SupplierSchema;
use App\Filament\Resources\SupplierResource\Tables\SupplierTable;
use App\Models\Supplier;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-truck';
    protected static string | \UnitEnum | null $navigationGroup = 'Data Utama';
    protected static ?string $navigationLabel = 'Pemasok';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return SupplierSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return SupplierTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
