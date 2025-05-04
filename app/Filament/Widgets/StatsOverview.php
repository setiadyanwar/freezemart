<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Total terjual bulan ini
        $totalSoldThisMonth = Order::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('quantity');

        // Total pendapatan hari ini
        $totalIncomeToday = Order::whereDate('created_at', Carbon::today())
            ->get()
            ->sum(fn($order) => $order->price * $order->quantity);

        // Data untuk chart: penjualan per hari bulan ini
        $salesChartData = [];
        $daysInMonth = Carbon::now()->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::now()->startOfMonth()->addDays($day - 1);

            $salesChartData[] = Order::whereDate('created_at', $date)->sum('quantity');
        }

        // Data untuk chart: pendapatan per jam hari ini
        $incomeChartData = [];

        for ($hour = 0; $hour < 24; $hour++) {
            $income = Order::whereDate('created_at', Carbon::today())
                ->whereTime('created_at', '>=', Carbon::createFromTime($hour, 0))
                ->whereTime('created_at', '<', Carbon::createFromTime($hour + 1, 0))
                ->get()
                ->sum(fn($order) => $order->price * $order->quantity);

            $incomeChartData[] = $income;
        }

        return [
            Stat::make('Terjual Bulan Ini', number_format($totalSoldThisMonth, 0, '', '.'))
                ->description('Jumlah produk terjual bulan ini'),

            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($totalIncomeToday, 0, '', '.'))
                ->description('Total pendapatan hari ini'),
        ];
    }
}
