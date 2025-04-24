<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\BusinessHour;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the base data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'appointment_date' => 'required|date|date_format:Y-m-d',
            'appointment_time' => 'required|date_format:H:i',
            'message' => 'nullable|string|max:500',
        ]);

        // Create a Carbon instance of the appointment datetime
        $appointmentDate = Carbon::parse($validatedData['appointment_date']);
        $appointmentTime = Carbon::parse($validatedData['appointment_time']);
        $appointmentDateTime = Carbon::create(
            $appointmentDate->year,
            $appointmentDate->month,
            $appointmentDate->day,
            $appointmentTime->hour,
            $appointmentTime->minute,
            0
        );

        // Check if date is in the past
        if ($appointmentDateTime->isPast()) {
            throw ValidationException::withMessages([
                'appointment_date' => 'You cannot book appointments in the past.',
            ]);
        }

        // Check if the business is open on that day of the week
        $dayOfWeek = $appointmentDateTime->dayOfWeek;
        $businessHour = BusinessHour::where('day_of_week', $dayOfWeek)->first();

        if (!$businessHour || $businessHour->is_closed) {
            throw ValidationException::withMessages([
                'appointment_date' => 'We are closed on the selected day.',
            ]);
        }

        // Check if the time is within business hours
        $openTime = Carbon::parse($businessHour->open_time);
        $closeTime = Carbon::parse($businessHour->close_time);
        $appointmentTimeOnly = Carbon::parse($validatedData['appointment_time']);

        if ($appointmentTimeOnly->lt($openTime) || $appointmentTimeOnly->gt($closeTime)) {
            throw ValidationException::withMessages([
                'appointment_time' => 'The selected time is outside our business hours.',
            ]);
        }

        // Create the appointment
        Appointment::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'appointment_datetime' => $appointmentDateTime,
            'message' => $validatedData['message'],
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Your appointment has been booked successfully! We will contact you shortly to confirm.');
    }
}
