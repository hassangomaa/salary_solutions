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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
//            $table->integer('amount');
            $table->integer('month');
            $table->integer('year')->default(23);
            $table->integer('housing')->default(0);
            $table->integer('penalty')->default(0);
            $table->integer('absence')->default(0);
//            $table->enum('reason', ['housing', 'absence', 'penalty']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_deductions');
    }
};
