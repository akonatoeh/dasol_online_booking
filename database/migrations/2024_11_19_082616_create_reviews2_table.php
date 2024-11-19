<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviews2Table extends Migration
{
    public function up()
{
    Schema::create('reviewsOther', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->unsignedBigInteger('booking_other_id'); // Define user_id
        $table->unsignedBigInteger('service_id'); // Define room_id
        $table->integer('rating'); // Rating column
        $table->text('comment')->nullable(); // Optional comment column
        $table->timestamps(); // Timestamps for created_at and updated_at

        // Add foreign key constraints
        $table->foreign('booking_other_id')->references('id')->on('booking_others')->onDelete('cascade'); // Foreign key to users table
        $table->foreign('service_id')->references('id')->on('tours__activities')->onDelete('cascade'); // Foreign key to rooms table
    });
}

    public function down()
    {
        Schema::dropIfExists('reviewsOther');
    }
}