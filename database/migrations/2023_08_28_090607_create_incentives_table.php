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
//            $table->integer('amount');
            $table->integer('month');
            $table->integer('year')->default(23);
            $table->integer('incentive')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('regularity')->default(0);
            $table->integer('gift')->default(0);
//            $table->enum('reason', ['incentive', 'bonus', 'regularity', 'gift']);
            $table->softDeletes();
            $table->timestamps();
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
