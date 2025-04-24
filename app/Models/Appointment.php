<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'appointment_datetime',
        'message',
        'status',
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
    ];
}
