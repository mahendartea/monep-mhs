<?php

namespace App\Filament\Resources\MonevResource\Widgets;

use App\Models\Monev;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonevOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Monev', Monev::all()->count())
                ->description('Dari semua data')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Monev Aktif', Monev::where('status', true)->count())
                ->description('Dari semua data')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Monev Tidak Aktif', Monev::where('status', false)->count())
        ];
    }
}
