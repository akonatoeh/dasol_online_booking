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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();  // Ensure 'id' column is defined first
            $table->unsignedBigInteger('user_id')->nullable();  // Add the user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Add foreign key constraint
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->longText('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
