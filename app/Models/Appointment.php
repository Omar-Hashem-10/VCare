<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'start_time',
        'end_time',
        'doctor_id',
        'user_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
