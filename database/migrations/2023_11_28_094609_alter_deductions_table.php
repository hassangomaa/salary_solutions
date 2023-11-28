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
        Schema::table('deductions', function (Blueprint $table) {
            $table->decimal('housing', 8, 2)->default(0)->change(); // Adjust precision and scale as needed
            $table->decimal('penalty', 8, 2)->default(0)->change(); // Adjust precision and scale as needed
            $table->decimal('absence', 8, 2)->default(0)->change(); // Adjust precision and scale as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->integer('housing')->default(0)->change();
            $table->integer('penalty')->default(0)->change();
            $table->integer('absence')->default(0)->change();
        });
    }
};
