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
        Schema::table('cars', function (Blueprint $table) {

            // Status for buying
            $table->enum('sale_status', ['available', 'sold'])
                  ->default('available')
                  ->after('buy_price');

            // Status for renting
            $table->enum('rent_status', ['available', 'rented'])
                  ->default('available')
                  ->after('rent_price');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['sale_status', 'rent_status']);
        });
    }
};
