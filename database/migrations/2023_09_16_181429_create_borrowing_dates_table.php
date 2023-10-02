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
        Schema::create('borrowing_dates', function (Blueprint $table) {
            $table->id();
            // $table->tinyInteger('month');
            // $table->integer('year');
            $table->integer('month')->default(now()->month); // Set the default month to the current month
            $table->integer('year')->default(now()->year);   // Set the default year to the current year
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_dates');
    }
};
