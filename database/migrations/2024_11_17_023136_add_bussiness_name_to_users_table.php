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
        Schema::table('users', function (Blueprint $table) {
            $table->string('business_name')->nullable()->after('name'); // Add the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the column only if it exists
        if (Schema::hasColumn('users', 'business_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('business_name');
            });
        }
    }
};
