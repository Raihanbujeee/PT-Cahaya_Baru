<?php

namespace App\Filament\Resources\FooterSettings;

use App\Filament\Resources\FooterSettings\Pages\CreateFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\EditFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\ListFooterSettings;
use App\Filament\Resources\FooterSettings\Pages\ViewFooterSetting;
use App\Filament\Resources\FooterSettings\Schemas\FooterSettingForm;
use App\Filament\Resources\FooterSettings\Schemas\FooterSettingInfolist;
use App\Filament\Resources\FooterSettings\Tables\FooterSettingsTable;
use App\Models\FooterSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Tables\Actions\CreateAction;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;
    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationLabel(): string
    {
        return 'Pengaturan Footer';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan Website'; // Ini bakal bikin grup baru di sidebar
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true; // Paksa dia untuk selalu muncul
    }


    public static function getModelLabel(): string
    {
        return 'Pengaturan Footer';
    }


    public static function form(Schema $schema): Schema
    {
        return FooterSettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FooterSettingInfolist::configure($schema);
    }
    

    public static function table(Table $table): Table
    {
        return FooterSettingsTable::configure($table);
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
            'index' => ListFooterSettings::route('/'),
            'create' => CreateFooterSetting::route('/create'),
            'edit' => EditFooterSetting::route('/{record}/edit'),
            'view' => ViewFooterSetting::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
         return FooterSetting::count() === 0;
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->modalHeading('Tambah Pengaturan Footer')
                ->url(static::getResource()::getUrl('create'))
                ->modalSubmitActionLabel('Simpan')
                ->modalWidth('2xl')
                ->visible(FooterSetting::count() === 0),
        ];
    }

    

        // protected function getFooterActions(): array
        // {
        //     return [
        //         \Filament\Actions\EditAction::make(),
        //     ];
        // }
}
