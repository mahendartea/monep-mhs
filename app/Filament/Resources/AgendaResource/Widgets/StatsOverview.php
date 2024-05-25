<?php

namespace App\Filament\Resources\AgendaResource\Widgets;

use App\Models\Agenda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Agenda', Agenda::all()->count())->description('Dari semua data')->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Agenda Aktif', Agenda::where('status', true)->count())->description('Agenda yang aktif')->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Jumlah Notifikasi', Agenda::whereHas('notifikasi', fn ($q) => $q->where('status', true))->count())->description('Agenda yang aktif')->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
