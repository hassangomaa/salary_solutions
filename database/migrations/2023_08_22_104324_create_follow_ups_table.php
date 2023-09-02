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
            $table->integer('month')->default(8);
            $table->integer('year')->default(23);
            $table->integer('attended_days')->default(10);
            $table->integer('daily_wages_earned')->default(0);
            $table->integer('extra_hours')->default(5);
            $table->integer('total_extras')->default(0);
            $table->integer('borrows')->default(0);
            $table->integer('incentives')->default(0)->comment('7wafez');
            $table->integer('deductions')->default(0)->comment('5osomat');
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
