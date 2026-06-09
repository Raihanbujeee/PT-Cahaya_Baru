<?php

namespace App\Filament\Resources\JasaResource\Schemas;

use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;

class JasaSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nama Jasa')
                ->columnSpanFull(),

            Forms\Components\Select::make('type')
                ->label('Tipe Jasa')
                ->options([
                    'pemasangan'  => 'Pemasangan (per Produk)',
                    'pengantaran' => 'Pengantaran (per Jarak)',
                    'lainnya'     => 'Lainnya',
                ])
                ->default('lainnya')
                ->required()
                ->live()
                ->columnSpanFull(),

            // ── Khusus Pemasangan ──
            Forms\Components\Select::make('product_id')
                ->label('Produk Terkait')
                ->options(Product::pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->visible(fn (Forms\Get $get) => $get('type') === 'pemasangan')
                ->required(fn (Forms\Get $get) => $get('type') === 'pemasangan')
                ->helperText('Pilih produk yang membutuhkan jasa pemasangan ini'),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->label(fn (Forms\Get $get) => match ($get('type')) {
                    'pemasangan'  => 'Biaya Pemasangan (per unit produk)',
                    'pengantaran' => 'Biaya Dasar',
                    default       => 'Harga',
                }),

            // ── Khusus Pengantaran ──
            Forms\Components\TextInput::make('price_per_km')
                ->numeric()
                ->prefix('Rp')
                ->label('Tarif per Km')
                ->helperText('Biaya tambahan per kilometer jarak pengiriman')
                ->visible(fn (Forms\Get $get) => $get('type') === 'pengantaran')
                ->required(fn (Forms\Get $get) => $get('type') === 'pengantaran'),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->columnSpanFull(),
        ]);
    }
}
