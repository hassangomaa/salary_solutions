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
            $table->integer('attended_days')->default(0);
            $table->integer('extra_hours')->default(0);
            $table->integer('borrow_week_one')->default(0);
            $table->integer('borrow_week_two')->default(0);
            $table->integer('borrow_week_three')->default(0);
            $table->integer('borrow_week_four')->default(0);
            $table->integer('incentives')->default(0)->comment('7wafez');
            $table->integer('deductions')->default(0)->comment('5osomat');
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
