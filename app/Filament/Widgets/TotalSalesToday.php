<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class TotalSalesToday extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $today = Carbon::today();

        $totalSalesToday = Sale::whereDate('date', $today)->sum('grand_total');
        $countSalesToday = Sale::whereDate('date', $today)->count();

        $totalSalesMonth = Sale::whereMonth('date', $today->month)
            ->whereYear('date', $today->year)
            ->sum('grand_total');

        return [
            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format($totalSalesToday, 0, ',', '.'))
                ->description("{$countSalesToday} transaksi")
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format($totalSalesMonth, 0, ',', '.'))
                ->description(Carbon::now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
