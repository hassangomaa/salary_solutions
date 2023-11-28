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
        Schema::table('employees', function (Blueprint $table) {
            $table->float('daily_fare', 8, 2)->change(); // Adjust precision and scale as needed
            $table->float('overtime_hour_fare', 8, 2)->change(); // Adjust precision and scale as needed

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->integer('daily_fare')->change();
        });
    }
};
