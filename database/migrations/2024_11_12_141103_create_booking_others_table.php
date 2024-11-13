<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOthersTable extends Migration
{
    public function up()
    {
        Schema::create('booking_others', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_activity_id')->constrained('tours__activities')->onDelete('cascade'); // Foreign key to rooms table
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('size');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->time('arrival_time');
            $table->string('ticket', 8)->unique(); // 8-digit ticket field
            $table->string('id_image'); // Path to uploaded ID image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_others');
    }
}