<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages;
use App\Filament\Resources\PelangganResource\Schemas\PelangganSchema;
use App\Filament\Resources\PelangganResource\Tables\PelangganTable;
use App\Models\Customer;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PelangganResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static string | \UnitEnum | null $navigationGroup = 'Data Utama';
    protected static ?string $slug = 'pelanggan';
    protected static ?string $navigationLabel = 'Pelanggan';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return PelangganSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return PelangganTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
