<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'rra_ebm_cancelled')) {
                $table->boolean('rra_ebm_cancelled')->default(false)->after('rra_ebm_queued');
                $table->timestamp('rra_ebm_cancelled_at')->nullable()->after('rra_ebm_cancelled');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'rra_ebm_cancelled')) {
                $table->dropColumn(['rra_ebm_cancelled', 'rra_ebm_cancelled_at']);
            }
        });
    }
};
