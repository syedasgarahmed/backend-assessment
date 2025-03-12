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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id(); // Automatically creates a 'bigint(20) UNSIGNED NOT NULL' column
            $table->unsignedBigInteger('user_id'); // Equivalent to 'bigint(20) UNSIGNED NOT NULL'
            $table->unsignedBigInteger('project_id'); // Equivalent to 'bigint(20) UNSIGNED NOT NULL'
            $table->string('task_name', 255); // Equivalent to 'varchar(255) NOT NULL'
            $table->date('date'); // Equivalent to 'date NOT NULL'
            $table->integer('hours'); // Equivalent to 'int(11) NOT NULL'
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns
        
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
