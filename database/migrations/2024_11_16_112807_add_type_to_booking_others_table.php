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
        Schema::table('booking_others', function (Blueprint $table) {
            // Add 'type' column
            $table->string('type'); // Ensure matching data type with 'tours__activities.type'
            
            // Add foreign key constraint
            $table->foreign('type')->references('type')->on('tours__activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_others', function (Blueprint $table) {
            $table->dropForeign(['type']);
            $table->dropColumn('type');
        });
    }
};
