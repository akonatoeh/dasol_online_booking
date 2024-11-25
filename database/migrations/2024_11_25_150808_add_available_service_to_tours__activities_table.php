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
            $table->string('available_service')->nullable()->after('offers'); // Replace 'column_name' with the column after which you want to add this field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours__activities', function (Blueprint $table) {
            $table->dropColumn('available_service');
        });
    }
};
