<?php

namespace App\Filament\Resources\AboutContents;

use App\Filament\Resources\AboutContents\Pages\CreateAboutContents;
use App\Filament\Resources\AboutContents\Pages\EditAboutContents;
use App\Filament\Resources\AboutContents\Pages\ListAboutContents;
use App\Filament\Resources\AboutContents\Schemas\AboutContentsForm;
use App\Filament\Resources\AboutContents\Tables\AboutContentsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutContentsResource extends Resource
{
    protected static ?string $model = 'App\Models\AboutContents';
    public static function getNavigationGroup(): ?string
{
    return 'Tentang Kami';
}

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AboutContentsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutContentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            ];
    }
    
    public static function canCreate(): bool
    {
        return \App\Models\AboutContents::count() === 0;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutContents::route('/'),
            'create' => CreateAboutContents::route('/create'),
            'edit' => EditAboutContents::route('/{record}/edit'),
            ];
    }
}

