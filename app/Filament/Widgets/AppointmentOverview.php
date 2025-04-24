<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();

        return [
            Stat::make('Tomorrow\'s Appointments', Appointment::whereDate('appointment_datetime', $tomorrow)->count())
                ->description('Appointments scheduled for tomorrow')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success'),
            Stat::make('This Week\'s Appointments', Appointment::whereBetween('appointment_datetime', [$thisWeekStart, $thisWeekEnd])->count())
                ->description('Appointments scheduled this week')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),
        ];
    }
}
