<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalShop extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'location'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
