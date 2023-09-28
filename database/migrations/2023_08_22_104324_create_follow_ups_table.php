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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('month')->default(now()->month); // Set the default month to the current month
            $table->integer('year')->default(now()->year);   // Set the default year to the current year
            $table->integer('attended_days')->default(0);
            $table->integer('daily_wages_earned')->default(0);
            $table->integer('extra_hours')->default(0);
            $table->integer('total_extras')->default(0);
            $table->integer('borrows')->default(0);
            $table->integer('incentives')->default(0)->comment('bouns+ on salary');
            $table->integer('deductions')->default(0)->comment('minus- on salary');
            $table->integer('total_salary')->default(0);
            $table->integer('net_salary')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
