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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Automatically creates a 'bigint(20) UNSIGNED NOT NULL' column
            $table->string('name', 255); // Equivalent to 'varchar(255) NOT NULL'
            $table->string('status', 50); // Equivalent to 'varchar(50) NOT NULL'
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
