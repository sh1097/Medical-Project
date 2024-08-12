<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_medical_shops_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalShopsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_shops', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the medical shop
            $table->string('description')->nullable(); // Description, nullable
            $table->string('location'); // Location of the medical shop
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_shops');
    }
}

