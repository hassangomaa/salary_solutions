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
        Schema::table('reports', function (Blueprint $table) {
            $table->decimal('total_borrows', 8, 2)->change(); // Adjust precision and scale as needed
            $table->decimal('incentives', 8, 2)->change();
            $table->decimal('deductions', 8, 2)->change();
            $table->decimal('total_extras', 8, 2)->change();
            $table->decimal('total_salary', 8, 2)->change();
            $table->decimal('net_salary', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->integer('total_borrows')->change();
            $table->integer('incentives')->change();
            $table->integer('deductions')->change();
            $table->integer('total_extras')->change();
            $table->integer('total_salary')->change();
            $table->integer('net_salary')->change();
        });
    }
};
