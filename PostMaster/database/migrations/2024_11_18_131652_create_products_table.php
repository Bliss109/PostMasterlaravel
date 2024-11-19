<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This is an anonymous migration class that manages the 'products' table in the database.
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is executed when the migration is run. 
     * It defines the structure of the 'products' table.
     */
    public function up(): void
    {
        // Creating the 'products' table with its columns.
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key column (auto-incrementing).
            $table->string('title'); // Column for the product title, stored as a string.
            $table->string('price'); // Column for the product price, stored as a string.
            $table->string('product_code'); // Column for a unique product code, stored as a string.
            $table->string('description'); // Column for a brief description of the product, stored as a string.
            $table->timestamps(); // Automatically adds 'created_at' and 'updated_at' columns.
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is executed when the migration is rolled back. 
     * It removes the 'products' table.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Deletes the 'products' table if it exists.
    }
};

