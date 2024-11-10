<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours__activities_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tours_activities_id');
            $table->string('image_path');
            $table->timestamps();

            // Foreign key constraint referencing the `rooms` table
            $table->foreign('tours_activities_id')->references('id')->on('tours__activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tours__activities_images');
    }
};
