<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddRraEbmFieldsToOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'rra_ebm_submitted')) {
                $table->boolean('rra_ebm_submitted')->default(false)->after('amount_paid');
                $table->timestamp('rra_ebm_submitted_at')->nullable()->after('rra_ebm_submitted');
                $table->integer('rra_ebm_attempts')->default(0)->after('rra_ebm_submitted_at');
                $table->text('rra_ebm_error')->nullable()->after('rra_ebm_attempts');
                $table->boolean('rra_ebm_queued')->default(false)->after('rra_ebm_error');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = ['rra_ebm_submitted', 'rra_ebm_submitted_at', 'rra_ebm_attempts', 'rra_ebm_error', 'rra_ebm_queued'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
