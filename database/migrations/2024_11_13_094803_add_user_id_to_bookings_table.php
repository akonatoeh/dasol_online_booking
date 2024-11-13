<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// Example of the migration file: add_user_id_to_bookings_table.php
public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        // Add user_id column
        $table->unsignedBigInteger('user_id')->nullable();

        // Add foreign key constraint
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        // Drop the foreign key and column
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};