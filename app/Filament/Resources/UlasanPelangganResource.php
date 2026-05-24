<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UlasanPelangganResource\Pages\ManageUlasanPelanggan;
use App\Models\Review;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UlasanPelangganResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-star';
    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan Halaman';
    protected static ?string $navigationLabel = 'Ulasan Pelanggan';
    protected static ?string $pluralModelLabel = 'Ulasan Pelanggan';
    protected static ?string $modelLabel = 'Ulasan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->maxLength(255),
                Select::make('rating')
                    ->label('Rating (Bintang)')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ])
                    ->required(),
                Textarea::make('comment')
                    ->label('Ulasan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '5' => 'success',
                        '4' => 'info',
                        '3' => 'warning',
                        '2', '1' => 'danger',
                        default => 'primary',
                    }),
                TextColumn::make('comment')
                    ->label('Ulasan')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUlasanPelanggan::route('/'),
        ];
    }
}
