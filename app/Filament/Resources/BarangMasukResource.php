<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangMasukResource\Pages;
use App\Filament\Resources\BarangMasukResource\Schemas\BarangMasukSchema;
use App\Filament\Resources\BarangMasukResource\Tables\BarangMasukTable;
use App\Models\InboundTransaction;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class BarangMasukResource extends Resource
{
    protected static ?string $model = InboundTransaction::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static string | \UnitEnum | null $navigationGroup = 'Transaksi';
    protected static ?string $slug = 'barang-masuk';
    protected static ?string $navigationLabel = 'Barang Masuk';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return BarangMasukSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return BarangMasukTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangMasuks::route('/'),
            'create' => Pages\CreateBarangMasuk::route('/create'),
            'edit' => Pages\EditBarangMasuk::route('/{record}/edit'),
        ];
    }
}
