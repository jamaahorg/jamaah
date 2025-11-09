<?php

namespace App\Filament\Jamaah\Pages;

use App\Filament\Jamaah\Widgets\TransactionsChart;
use Filament\Pages\Dashboard as FilamentDashboard;

class Dashboard extends FilamentDashboard
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home';
    protected string $view = 'filament.jamaah.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            TransactionsChart::class
        ];
    }
}
