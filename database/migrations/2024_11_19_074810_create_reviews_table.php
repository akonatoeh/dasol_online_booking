<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->unsignedBigInteger('booking_id'); // Define user_id
        $table->unsignedBigInteger('room_id'); // Define room_id
        $table->integer('rating'); // Rating column
        $table->text('comment')->nullable(); // Optional comment column
        $table->timestamps(); // Timestamps for created_at and updated_at

        // Add foreign key constraints
        $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade'); // Foreign key to users table
        $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade'); // Foreign key to rooms table
    });
}

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

