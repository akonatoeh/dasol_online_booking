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
            $table->string('children_price')->nullable()->after('price'); // Add the column after 'price'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours__activities', function (Blueprint $table) {
            $table->dropColumn('children_price'); // Remove the column if the migration is rolled back
        });
    }
};