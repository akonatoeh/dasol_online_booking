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
        if (!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // Ensure 'user_id' matches 'users.id'
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('room_title')->nullable();
                $table->string('room_image')->nullable();
                $table->longText('description')->nullable();
                $table->string('price')->nullable();
                $table->string('wifi')->default('yes');
                $table->string('room_type')->nullable();
                $table->index('user_id'); // Optional index
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
