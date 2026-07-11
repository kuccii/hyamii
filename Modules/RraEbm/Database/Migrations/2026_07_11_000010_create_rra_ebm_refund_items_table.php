<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rra_ebm_refund_items')) {
            return;
        }

        Schema::create('rra_ebm_refund_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refund_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('amount', 16, 2);
            $table->decimal('tax_amount', 16, 2)->default(0);
            $table->string('tax_code', 5)->default('B');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_refund_items');
    }
};
