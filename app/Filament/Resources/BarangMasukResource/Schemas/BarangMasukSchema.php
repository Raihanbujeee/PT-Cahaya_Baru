<?php

namespace App\Filament\Resources\BarangMasukResource\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class BarangMasukSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Barang Masuk')->schema([
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pemasok'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now())
                    ->label('Tanggal'),
                Forms\Components\Textarea::make('note')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ])->columns(2)->columnSpanFull(),

            Section::make('Detail Produk')->schema([
                Forms\Components\Repeater::make('inboundDetails')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Produk')
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('cost_price');
                                $set('line_total', $qty * $price);
                            })
                            ->label('Jumlah')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('cost_price')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('cost_price');
                                $set('line_total', $qty * $price);
                            })
                            ->label('Harga Satuan')
                            ->columnSpan(3),
                        Forms\Components\Placeholder::make('line_total')
                            ->label('Subtotal')
                            ->content(function (Get $get): string {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('cost_price');
                                return 'Rp ' . number_format($qty * $price, 0, ',', '.');
                            })
                            ->columnSpan(3),
                    ])
                    ->columns(12)
                    ->defaultItems(1)
                    ->addActionLabel('+ Tambah Produk')
                    ->reorderable(false)
                    ->hiddenLabel(),
            ])->columnSpanFull(),

            Section::make()->schema([
                Forms\Components\Placeholder::make('total_cost_display')
                    ->label('Total Biaya')
                    ->content(function (Get $get): string {
                        $items = $get('inboundDetails') ?? [];
                        $total = 0;
                        foreach ($items as $item) {
                            $total += ((int) ($item['quantity'] ?? 0)) * ((float) ($item['cost_price'] ?? 0));
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
            ])->columnSpanFull(),
        ]);
    }
}
