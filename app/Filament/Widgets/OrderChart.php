<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Order Perhari';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $orders = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->all();

        // Bikin array bulan dari Januari - Desember 2025
        $months = collect(range(1, 12))->map(function ($month) {
            return '2025-' . str_pad($month, 2, '0', STR_PAD_LEFT);
        })->toArray();

        // Samain semua bulan supaya kalau ga ada order, tetap 0
        $orderData = array_map(function ($month) use ($orders) {
            return $orders[$month] ?? 0;
        }, $months);

        return [
            'datasets' => [
                [
                    'label' => 'order',
                    'data' => $orderData,
                    'borderColor' => '#3b82f6', // biru
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
