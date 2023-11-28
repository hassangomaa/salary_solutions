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
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->decimal('attended_days', 8, 2)->default(0)->change(); // Adjust precision and scale as needed
            $table->decimal('daily_wages_earned', 8, 2)->default(0)->change();
            $table->decimal('extra_hours', 8, 2)->default(0)->change();
            $table->decimal('total_extras', 8, 2)->default(0)->change();
            $table->decimal('borrows', 8, 2)->default(0)->change();
            $table->decimal('incentives', 8, 2)->default(0)->change();
            $table->decimal('deductions', 8, 2)->default(0)->change();
            $table->decimal('total_salary', 8, 2)->default(0)->change();
            $table->decimal('net_salary', 8, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->integer('attended_days')->default(0)->change();
            $table->integer('daily_wages_earned')->default(0)->change();
            $table->integer('extra_hours')->default(0)->change();
            $table->integer('total_extras')->default(0)->change();
            $table->integer('borrows')->default(0)->change();
            $table->integer('incentives')->default(0)->change();
            $table->integer('deductions')->default(0)->change();
            $table->integer('total_salary')->default(0)->change();
            $table->integer('net_salary')->default(0)->change();
        });
    }
};
