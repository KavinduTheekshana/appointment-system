<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessHoursSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing business hours
        BusinessHour::truncate();

        // Define business hours
        $businessHours = [
            [
                'day_of_week' => 0, // Sunday
                'open_time' => null,
                'close_time' => null,
                'is_closed' => true,
            ],
            [
                'day_of_week' => 1, // Monday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
            [
                'day_of_week' => 2, // Tuesday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
            [
                'day_of_week' => 3, // Wednesday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
            [
                'day_of_week' => 4, // Thursday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
            [
                'day_of_week' => 5, // Friday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
            [
                'day_of_week' => 6, // Saturday
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_closed' => false,
            ],
        ];

        // Insert business hours
        foreach ($businessHours as $hours) {
            BusinessHour::create($hours);
        }
    }
}
