<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('qr_code_url')->nullable(); // Add this line
        });
    }
    
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropColumn('qr_code_url');
        });
    }
    
};
