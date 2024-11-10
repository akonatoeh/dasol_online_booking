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
        if (!Schema::hasTable('tours__activities')) { // Check if the table already exists
            Schema::create('tours__activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Add user_id column
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('price')->nullable();
            $table->string('type')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
            // Optional: If needed, add an index explicitly
            $table->index('user_id');
            
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours__activities');
    }
};
