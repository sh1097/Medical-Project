// database/migrations/xxxx_xx_xx_xxxxxx_create_patients_table.php

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->dateTime('registration_date_time');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('phone_number', 20);
            $table->string('email')->unique();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('province');
            $table->string('emergency_contact_first_name')->nullable();
            $table->string('emergency_contact_last_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone_number', 20)->nullable();
            $table->string('family_doctor_first_name')->nullable();
            $table->string('family_doctor_last_name')->nullable();
            $table->string('family_doctor_phone_number', 20)->nullable();
            $table->text('reason_for_registration')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('clinic_id')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
