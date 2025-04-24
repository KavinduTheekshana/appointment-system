<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Appointments by Day';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = $this->getAppointmentsPerDay();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $data['counts'],
                    'backgroundColor' => [
                        'rgba(79, 70, 229, 0.2)',
                    ],
                    'borderColor' => [
                        'rgb(79, 70, 229)',
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $data['dates'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getAppointmentsPerDay(): array
    {
        $startDate = Carbon::now()->startOfWeek()->subWeek();
        $endDate = Carbon::now()->endOfWeek();

        $appointments = Appointment::select([
            DB::raw('DATE(appointment_datetime) as date'),
            DB::raw('COUNT(*) as count')
        ])
            ->whereBetween('appointment_datetime', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = [];
        $counts = [];

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $appointmentForDate = $appointments->firstWhere('date', $formattedDate);

            $dates[] = $currentDate->format('M d');
            $counts[] = $appointmentForDate ? $appointmentForDate->count : 0;

            $currentDate->addDay();
        }

        return [
            'dates' => $dates,
            'counts' => $counts,
        ];
    }
}
