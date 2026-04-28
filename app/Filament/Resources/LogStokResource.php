<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogStokResource\Pages;
use App\Filament\Resources\LogStokResource\Tables\LogStokTable;
use App\Models\StockLog;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class LogStokResource extends Resource
{
    protected static ?string $model = StockLog::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string | \UnitEnum | null $navigationGroup = 'Inventori';
    protected static ?string $slug = 'log-stok';
    protected static ?string $navigationLabel = 'Log Stok';
    protected static ?int $navigationSort = 2;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return LogStokTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogStoks::route('/'),
        ];
    }
}
