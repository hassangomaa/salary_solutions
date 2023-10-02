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
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('month')->default(now()->month); // Set the default month to the current month
            $table->integer('year')->default(now()->year);   // Set the default year to the current year
            $table->integer('incentive')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('regularity')->default(0);
            $table->integer('gift')->default(0);
            $table->softDeletes();
            $table->timestamps();
//            $table->integer('amount');
//            $table->enum('reason', ['incentive', 'bonus', 'regularity', 'gift']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incentives');
    }
};
