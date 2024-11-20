<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('booking_others', function (Blueprint $table) {
            // Add user_id column
            $table->unsignedBigInteger('user_id')->nullable();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('booking_others', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
