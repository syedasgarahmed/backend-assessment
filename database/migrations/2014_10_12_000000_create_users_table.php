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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Automatically creates a 'bigint(20) UNSIGNED NOT NULL' column
            $table->string('first_name', 255); // Equivalent to 'varchar(255) NOT NULL'
            $table->string('last_name', 255); // Equivalent to 'varchar(255) NOT NULL'
            $table->string('email', 255)->unique(); // Equivalent to 'varchar(255) NOT NULL' with uniqueness constraint
            $table->string('password', 255); // Equivalent to 'varchar(255) NOT NULL'
            $table->string('role', 255)->default('user'); // Equivalent to 'varchar(255) NOT NULL DEFAULT 'user''
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
