<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    protected $fillable = [
        'patient_id',
        'patient_name',
        'medication',
        'dosage_instructions',
        'file_path',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
