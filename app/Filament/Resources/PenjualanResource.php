<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\Schemas\PenjualanSchema;
use App\Filament\Resources\PenjualanResource\Tables\PenjualanTable;
use App\Models\Sale;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PenjualanResource extends Resource
{
    protected static ?string $model = Sale::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-cart';
    protected static string | \UnitEnum | null $navigationGroup = 'Transaksi';
    protected static ?string $slug = 'penjualan';
    protected static ?string $navigationLabel = 'Penjualan (POS)';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PenjualanSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualanTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
