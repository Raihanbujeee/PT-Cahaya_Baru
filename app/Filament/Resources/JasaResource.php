<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JasaResource\Pages;
use App\Filament\Resources\JasaResource\Schemas\JasaSchema;
use App\Filament\Resources\JasaResource\Tables\JasaTable;
use App\Models\Service;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class JasaResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $slug = 'jasa';
    protected static ?string $navigationLabel = 'Jasa / Layanan';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return JasaSchema::form($schema);
    }

    public static function table(Table $table): Table
    {
        return JasaTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJasas::route('/'),
            'create' => Pages\CreateJasa::route('/create'),
            'edit' => Pages\EditJasa::route('/{record}/edit'),
        ];
    }
}
