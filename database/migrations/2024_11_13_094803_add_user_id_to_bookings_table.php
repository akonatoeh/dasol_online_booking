<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add the user_id column with unsignedBigInteger type
            $table->unsignedBigInteger('user_id')->nullable();

            // Add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }
};
