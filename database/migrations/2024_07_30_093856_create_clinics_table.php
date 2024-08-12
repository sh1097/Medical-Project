<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_clinics_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the clinic
            $table->string('location'); // Location of the clinic
            $table->string('contact_number')->nullable(); // Contact number of the clinic
            $table->text('description')->nullable(); // Description of the clinic
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
