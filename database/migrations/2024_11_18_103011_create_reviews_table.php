<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('bookings')->onDelete('cascade'); // Foreign key
            $table->foreignId('user_id')->constrained('bookings')->onDelete('cascade'); // Foreign key
            $table->integer('rating'); // Rating (1-5)
            $table->text('comment')->nullable(); // Optional comment
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
