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
        Schema::create('tours__activities_availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tours_activities_id');
            $table->date('available_date');
            $table->timestamps();


            // Foreign key to the rooms table
        $table->foreign('tours_activities_id')->references('id')->on('tours__activities')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours__activities_availabilities');
    }
};








