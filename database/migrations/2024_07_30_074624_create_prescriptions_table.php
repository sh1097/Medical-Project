<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_prescriptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id(); // Primary key

            // Create patient_id column and set it up as a foreign key
            $table->foreignId('patient_id')
                  ->constrained('patients') // References the patients table
                  ->onDelete('cascade'); // If a patient is deleted, delete associated prescriptions

            // Other columns
            $table->string('patient_name'); // Optional if you want to store the patient name
            $table->text('medication');
            $table->text('dosage_instructions');
            $table->string('file_path');
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}

