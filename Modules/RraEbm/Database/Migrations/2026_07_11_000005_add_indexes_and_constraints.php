<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rra_ebm_receipt_signatures', function (Blueprint $table) {
            if (!Schema::hasIndex('rra_ebm_receipt_signatures', 'rra_ebm_receipt_signatures_order_id_unique')) {
                $table->unique('order_id');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasIndex('orders', 'orders_rra_ebm_submitted_branch_idx')) {
                $table->index(['rra_ebm_submitted', 'branch_id'], 'orders_rra_ebm_submitted_branch_idx');
            }
        });
    }

    public function down(): void
    {
        Schema::table('rra_ebm_receipt_signatures', function (Blueprint $table) {
            $table->dropUnique('rra_ebm_receipt_signatures_order_id_unique');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_rra_ebm_submitted_branch_idx');
        });
    }
};
