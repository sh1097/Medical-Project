<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('medical_shop_id') // Foreign key column
                  ->constrained('medical_shops') // References the 'medical_shops' table
                  ->onDelete('cascade'); // Action on delete

            $table->string('name'); // Name of the product
            $table->text('description')->nullable(); // Description of the product
            $table->decimal('price', 8, 2); // Price of the product with precision and scale
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

