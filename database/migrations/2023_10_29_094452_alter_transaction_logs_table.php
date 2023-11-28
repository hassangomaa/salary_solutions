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
             Schema::table('transaction_logs', function (Blueprint $table) {
##############            $table->unsignedBigInteger('company_id')->nullable()->change();
            $table->integer('amount')->nullable()->change();
            $table->string('type_ar')->nullable()->change();
            $table->string('type_en')->nullable()->change();
            $table->string('statement_ar')->nullable()->change();
            $table->string('statement_en')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

    }
};
