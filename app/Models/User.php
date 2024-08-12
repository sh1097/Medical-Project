<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     public function role()
    {
        return $this->belongsTo(Role::class, 'role_id'); // 'role_id' is the foreign key in the users table
    }
    const ROLE_ADMIN = 'admin';
    const ROLE_PATIENT = 'patient';
    const ROLE_CLINIC = 'clinic';

    // Other user model code...

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPatient()
    {
        return $this->role === self::ROLE_PATIENT;
    }

    public function isClinic()
    {
        return $this->role === self::ROLE_CLINIC;
    }
    public function patients()
    {
        return $this->hasMany(Patient::class, 'clinic_id');
    }

    public function clinic()
{
    return $this->hasOne(Clinic::class);
}
// app/Models/User.php

public function appointments()
{
    return $this->hasMany(Appointment::class);
}

}
