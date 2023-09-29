<?php

namespace App\Filament\Widgets;

use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Sewa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah sewa', count(Sewa::all()))
                ->color('success'),
            Stat::make('Jumlah kendaraan', count(Kendaraan::all()))
                ->color('success'),
            Stat::make('Jumlah driver', count(Driver::all()))
                ->color('success'),
        ];
    }
}
