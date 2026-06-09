<?php

namespace App\Filament\Resources\FooterSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class FooterSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('address')->label('Alamat')->limit(50),
                \Filament\Tables\Columns\TextColumn::make('phone')->label('Telepon'),
                \Filament\Tables\Columns\TextColumn::make('email')->label('Email')
                ->limit(100)
                ->label('Email')
                ->copyable() 
                ->url(fn ($record): string => 'mailto:' . $record->email),
                \Filament\Tables\Columns\TextColumn::make('hours')->label('Jam Operasional'),
                \Filament\Tables\Columns\TextColumn::make('description')->label('Deskripsi'),
                \Filament\Tables\Columns\TextColumn::make('social_links')
                ->label('Sosmed')
                ->formatStateUsing(fn ($state) => count($state ?? []) . ' link tersimpan'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()->modalHeading('Edit Pengaturan Footer'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
