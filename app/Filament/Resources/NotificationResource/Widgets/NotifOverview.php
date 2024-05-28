<?php

namespace App\Filament\Resources\NotificationResource\Widgets;

use App\Models\Notification;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NotifOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Notifikasi', Notification::all()->count())
                ->description('Dari semua data')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Notifikasi Aktif', Notification::where('status', true)->count())
                ->description('Dari semua data')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Notifikasi Tidak Aktif', Notification::where('status', false)->count())
        ];
    }
}
