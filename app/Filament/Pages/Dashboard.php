<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;


class Dashboard extends BaseDashboard
{
    protected static ?string $routeName = 'custom.dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            AccountWidget::class,
        ];
    }
}
