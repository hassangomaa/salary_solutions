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
        Schema::table('incentives', function (Blueprint $table) {
            $table->decimal('incentive', 8, 2)->default(0)->change(); // Adjust precision and scale as needed
            $table->decimal('bonus', 8, 2)->default(0)->change();
            $table->decimal('regularity', 8, 2)->default(0)->change();
            $table->decimal('gift', 8, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incentives', function (Blueprint $table) {
            $table->integer('incentive')->default(0)->change();
            $table->integer('bonus')->default(0)->change();
            $table->integer('regularity')->default(0)->change();
            $table->integer('gift')->default(0)->change();
        });
    }
};
