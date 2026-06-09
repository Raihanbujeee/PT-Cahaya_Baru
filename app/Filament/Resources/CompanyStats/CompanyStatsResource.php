<?php

namespace App\Filament\Resources\CompanyStats;

use App\Filament\Resources\CompanyStats\Pages\CreateCompanyStats;
use App\Filament\Resources\CompanyStats\Pages\EditCompanyStats;
use App\Filament\Resources\CompanyStats\Pages\ListCompanyStats;
use App\Filament\Resources\CompanyStats\Schemas\CompanyStatsForm;
use App\Filament\Resources\CompanyStats\Tables\CompanyStatsTable;
use App\Models\CompanyStats;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyStatsResource extends Resource
{
    // Use a string reference to avoid static analysis errors when the model class
    // might not be autoloadable in this context.
    protected static ?string $model = 'App\\Models\\CompanyStats';
    public static function getNavigationGroup(): ?string
{
    return 'Tentang Kami';
}
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CompanyStatsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyStatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
         return CompanyStats::count() === 0;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanyStats::route('/'),
            'create' => CreateCompanyStats::route('/create'),
            'edit' => EditCompanyStats::route('/{record}/edit'),
        ];
    }
}
