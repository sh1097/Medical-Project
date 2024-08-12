<?php
// app/Models/Patient.php

// app/Models/Patient.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'patients';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'clinic_id', // Add this if your table includes this column
        'location',
        'registration_date_time',
        'first_name',
        'last_name',
        'address',
        'address_line_2',
        'city',
        'phone_number',
        'email',
        'gender',
        'marital_status',
        'province',
        'emergency_contact_first_name',
        'emergency_contact_last_name',
        'emergency_contact_relationship',
        'emergency_contact_phone_number',
        'family_doctor_first_name',
        'family_doctor_last_name',
        'family_doctor_phone_number',
        'reason_for_registration',
    ];

    // Define any relationships (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

 public function clinic()
    {
        return $this->belongsTo(User::class, 'clinic_id');
    }
    
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
  
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
