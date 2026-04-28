<?php

namespace App\Filament\Resources\ProdukResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class ProdukSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Produk')->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Produk')
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kategori'),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Merk'),
            ])->columns(2),

            Section::make('Harga & Stok')->schema([
                Forms\Components\TextInput::make('purchase_price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Harga Beli'),
                Forms\Components\TextInput::make('selling_price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Harga Jual'),
                Forms\Components\TextInput::make('current_stock')
                    ->numeric()
                    ->default(0)
                    ->label('Stok Saat Ini'),
                Forms\Components\TextInput::make('minimum_stock')
                    ->numeric()
                    ->default(0)
                    ->label('Stok Minimum'),
            ])->columns(2),
        ]);
    }
}
