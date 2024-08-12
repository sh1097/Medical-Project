<?php

// app/Models/TimeSlot.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'date',
        'start_time',
        'end_time',
        'available'
    ];

    // Define relationship with Clinic
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    // Define relationship with Appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
