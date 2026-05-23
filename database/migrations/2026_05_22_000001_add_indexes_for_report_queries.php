<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Indexes for customer/revenue report queries (branch + date range + customer).
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!$this->hasIndex('orders', 'idx_orders_branch_date_customer')) {
                $table->index(['branch_id', 'date_time', 'customer_id'], 'idx_orders_branch_date_customer');
            }

            if (!$this->hasIndex('orders', 'idx_orders_branch_date_status')) {
                $table->index(['branch_id', 'date_time', 'status'], 'idx_orders_branch_date_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_branch_date_status');
            $table->dropIndex('idx_orders_branch_date_customer');
        });
    }

    private function hasIndex(string $table, string $index): bool
    {
        try {
            $connection = Schema::getConnection();
            $database = $connection->getDatabaseName();

            $result = $connection->select(
                "SELECT COUNT(*) as count FROM information_schema.statistics
                 WHERE table_schema = ? AND table_name = ? AND index_name = ?",
                [$database, $table, $index]
            );

            return isset($result[0]) && $result[0]->count > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
};
