<?php

// app/Models/Clinic.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'clinic_id',
    ];

    // Define any relationships if necessary
    // For example, if a clinic has many time slots:
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // If a clinic has many appointments:
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function getQrCodeUrlAttribute()
    {
        return QrCode::size(250)->generate(route('clinic.register', ['clinicId' => $this->id]));
    }
}
