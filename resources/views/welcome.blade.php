

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Coming Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <style>
        .bg-gradient {
            background: linear-gradient(to right, #4f46e5, #9333ea);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ config('app.name') }}</h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Left Column: Coming Soon Text -->
                    <div>
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="bg-gradient px-6 py-8">
                                <h2 class="text-3xl font-extrabold text-white">Our Website is Coming Soon</h2>
                                <p class="mt-4 text-lg text-white opacity-90">We're working hard to bring you an amazing experience. In the meantime, you can book an appointment with us.</p>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Business Hours</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Monday - Saturday</span>
                                        <span>9:00 AM - 8:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium">Sunday</span>
                                        <span>Closed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Booking Form -->
                    <div>
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="bg-gradient px-6 py-4">
                                <h2 class="text-xl font-bold text-white">Book an Appointment</h2>
                                <p class="text-white opacity-90">Fill out the form below to schedule your appointment</p>
                            </div>
                            <div class="p-6">
                                @if (session('success'))
                                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                        <ul class="list-disc pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('appointments.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    <div>
                                        <label for="appointment_date" class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="text" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 datepicker">
                                    </div>

                                    <div>
                                        <label for="appointment_time" class="block text-sm font-medium text-gray-700">Time</label>
                                        <input type="text" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 timepicker">
                                    </div>

                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700">Message (Optional)</label>
                                        <textarea name="message" id="message" rows="3"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('message') }}</textarea>
                                    </div>

                                    <div>
                                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Book Appointment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <p class="text-center text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker - disable Sundays (0) and past dates
            flatpickr('.datepicker', {
                minDate: "today",
                disable: [
                    function(date) {
                        return (date.getDay() === 0); // Disable Sundays
                    }
                ],
                dateFormat: "Y-m-d"
            });

            // Initialize time picker - limit to business hours
            flatpickr('.timepicker', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                minTime: "09:00",
                maxTime: "20:00",
                minuteIncrement: 15
            });
        });
    </script>
</body>
</html>