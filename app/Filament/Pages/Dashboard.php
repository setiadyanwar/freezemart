<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\IncomeChart;
use App\Filament\Widgets\OrderChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $routeName = 'custom.dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            [OrderChart::class, IncomeChart::class],
            AccountWidget::class,
        ];
    }
}
