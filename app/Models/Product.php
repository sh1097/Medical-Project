<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['medical_shop_id', 'name', 'description', 'price'];

    public function medicalShop()
    {
        return $this->belongsTo(MedicalShop::class);
    }
}

