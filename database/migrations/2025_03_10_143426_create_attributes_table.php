<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id(); // Automatically creates a 'bigint(20) UNSIGNED NOT NULL' column
            $table->unsignedBigInteger('attribute_id'); // Equivalent to 'bigint(20) UNSIGNED NOT NULL'
            $table->unsignedBigInteger('entity_id'); // Equivalent to 'bigint(20) UNSIGNED NOT NULL'
            $table->text('value'); // For storing large text data
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
