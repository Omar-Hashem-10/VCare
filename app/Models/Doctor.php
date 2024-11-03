<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'bio',
        'experience_years',
        'examination_price',
        'major_id',
        'user_id',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
