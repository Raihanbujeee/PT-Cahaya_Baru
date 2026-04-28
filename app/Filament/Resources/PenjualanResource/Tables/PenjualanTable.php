<?php

namespace App\Filament\Resources\PenjualanResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class PenjualanTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->toggleable()->label('ID'),
                Tables\Columns\TextColumn::make('customer.name')->sortable()->searchable()->toggleable()->label('Pelanggan'),
                Tables\Columns\TextColumn::make('date')->date()->sortable()->searchable()->toggleable()->label('Tanggal'),
                Tables\Columns\TextColumn::make('grand_total')->money('IDR')->sortable()->toggleable()->label('Grand Total'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->searchable()
                    ->toggleable()
                    ->color(fn (string $state): string => match ($state) {
                        'Cash' => 'success',
                        'Transfer' => 'info',
                        'QRIS' => 'warning',
                        default => 'gray',
                    })
                    ->label('Pembayaran'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->searchable()
                    ->toggleable()
                    ->color(fn (string $state): string => match ($state) {
                        'Paid' => 'success',
                        'Unpaid' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->toggleable()->label('Kasir'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'Cash' => 'Cash',
                        'Transfer' => 'Transfer',
                        'QRIS' => 'QRIS',
                    ])
                    ->label('Metode Pembayaran'),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'Paid' => 'Lunas',
                        'Unpaid' => 'Belum Lunas',
                    ])
                    ->label('Status'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
