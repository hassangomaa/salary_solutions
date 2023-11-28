<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AlterTransactionLogsTable  extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set a temporary column to store the original data
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->decimal('amount_temp', 10, 2)->nullable()->default(0);
        });

        // Copy the data from the existing column to the temporary column, handling NULL values
        \Illuminate\Support\Facades\DB::statement('UPDATE transaction_logs SET amount_temp = IFNULL(amount, 0)');

        // Drop the existing column
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->dropColumn('amount');
        });

        // Recreate the column with the correct data type
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->default(0);
        });

        // Copy the data back to the new column
        \Illuminate\Support\Facades\DB::statement('UPDATE transaction_logs SET amount = amount_temp');

        // Drop the temporary column
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->dropColumn('amount_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is just a basic reversal, you might need to adjust it based on your needs
        Schema::table('transaction_logs', function (Blueprint $table) {
            $table->integer('amount')->default(0)->change();

            // Drop 'amount_temp' column if it exists
            if (Schema::hasColumn('transaction_logs', 'amount_temp')) {
                Schema::table('transaction_logs', function (Blueprint $table) {
                    $table->dropColumn('amount_temp');
                });
            }
        });
    }
}
