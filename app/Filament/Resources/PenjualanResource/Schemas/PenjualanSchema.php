<?php

namespace App\Filament\Resources\PenjualanResource\Schemas;

use App\Models\Product;
use App\Models\Service;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class PenjualanSchema
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            // KEPALA: Informasi Pelanggan & Pembayaran
            Section::make('Informasi Penjualan')->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required()->label('Nama'),
                        Forms\Components\TextInput::make('phone_number')->required()->tel()->label('No. Telepon'),
                        Forms\Components\Textarea::make('address')->label('Alamat'),
                    ])
                    ->label('Pelanggan'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now())
                    ->label('Tanggal'),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'Cash' => 'Cash',
                        'Transfer' => 'Transfer',
                        'QRIS' => 'QRIS',
                    ])
                    ->required()
                    ->default('Cash')
                    ->label('Metode Pembayaran'),
                Forms\Components\Select::make('payment_status')
                    ->options([
                        'Paid' => 'Lunas',
                        'Unpaid' => 'Belum Lunas',
                    ])
                    ->required()
                    ->default('Paid')
                    ->label('Status Pembayaran'),
                Forms\Components\Textarea::make('shipping_address')
                    ->label('Alamat Pengiriman')
                    ->columnSpanFull(),
            ])->columns(2)->columnSpanFull(),

            // BAGIAN 1: Daftar Produk
            Section::make('Produk')->schema([
                Forms\Components\Repeater::make('saleProductDetails')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Produk')
                            ->options(Product::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $product = Product::find($state);
                                    if ($product) {
                                        $set('unit_price', $product->selling_price);
                                        $qty = 1;
                                        $set('subtotal', $product->selling_price * $qty);
                                    }
                                }
                            })
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('unit_price');
                                $set('subtotal', $qty * $price);
                            })
                            ->label('Jml')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('unit_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('unit_price');
                                $set('subtotal', $qty * $price);
                            })
                            ->label('Harga')
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->label('Subtotal')
                            ->columnSpan(3),
                    ])
                    ->columns(12)
                    ->defaultItems(1)
                    ->addActionLabel('+ Tambah Produk')
                    ->reorderable(false)
                    ->hiddenLabel(),
            ])->columnSpanFull(),

            // BAGIAN 2: Daftar Jasa
            Section::make('Jasa / Layanan')->schema([
                Forms\Components\Repeater::make('saleServiceDetails')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->label('Jasa')
                            ->options(Service::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $service = Service::find($state);
                                    if ($service) {
                                        $set('unit_price', $service->price);
                                        $set('subtotal', $service->price * 1);
                                    }
                                }
                            })
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('unit_price');
                                $set('subtotal', $qty * $price);
                            })
                            ->label(fn (Get $get) => $get('service_id') == 1 ? 'Jarak (Km)' : ($get('service_id') == 2 ? 'Durasi (Hari)' : 'Qty'))
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('unit_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $qty = (int) $get('quantity');
                                $price = (float) $get('unit_price');
                                $set('subtotal', $qty * $price);
                            })
                            ->label('Harga')
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->label('Subtotal')
                            ->columnSpan(3),
                    ])
                    ->columns(12)
                    ->defaultItems(0)
                    ->addActionLabel('+ Tambah Jasa')
                    ->reorderable(false)
                    ->hiddenLabel(),
            ])->columnSpanFull(),

            // BAWAH: Total Keseluruhan
            Section::make('Ringkasan')->schema([
                Forms\Components\Placeholder::make('total_product_display')
                    ->label('Total Produk')
                    ->content(function (Get $get): string {
                        $items = $get('saleProductDetails') ?? [];
                        $total = 0;
                        foreach ($items as $item) {
                            $total += (float) ($item['subtotal'] ?? 0);
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
                Forms\Components\Placeholder::make('total_service_display')
                    ->label('Total Jasa')
                    ->content(function (Get $get): string {
                        $items = $get('saleServiceDetails') ?? [];
                        $total = 0;
                        foreach ($items as $item) {
                            $total += (float) ($item['subtotal'] ?? 0);
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
                Forms\Components\Placeholder::make('grand_total_display')
                    ->label('TOTAL KESELURUHAN')
                    ->content(function (Get $get): string {
                        $productItems = $get('saleProductDetails') ?? [];
                        $serviceItems = $get('saleServiceDetails') ?? [];
                        $total = 0;
                        foreach ($productItems as $item) {
                            $total += (float) ($item['subtotal'] ?? 0);
                        }
                        foreach ($serviceItems as $item) {
                            $total += (float) ($item['subtotal'] ?? 0);
                        }
                        return 'Rp ' . number_format($total, 0, ',', '.');
                    }),
            ])->columns(3)->columnSpanFull(),
        ]);
    }
}
