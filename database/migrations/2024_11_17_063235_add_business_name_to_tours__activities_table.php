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
        Schema::table('tours__activities', function (Blueprint $table) {
            $table->string('business_name')->nullable();  // Add the business_name column
            $table->foreign('business_name')              // Add foreign key constraint
                  ->references('business_name')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours__activities', function (Blueprint $table) {
            $table->dropForeign(['business_name']);  // Drop foreign key
            $table->dropColumn('business_name');     // Drop the column
        });
    }
};
