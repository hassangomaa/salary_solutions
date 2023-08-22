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
            $table->integer('month');
            $table->integer('attended_days');
            $table->integer('extra_hours');
            $table->integer('borrow_week_one');
            $table->integer('borrow_week_two');
            $table->integer('borrow_week_three');
            $table->integer('borrow_week_four');
            $table->integer('incentives')->comment('7wafez');
            $table->integer('deductions')->comment('5osomat');
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
