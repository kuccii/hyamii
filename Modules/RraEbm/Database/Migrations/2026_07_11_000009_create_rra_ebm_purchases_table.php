<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rra_ebm_purchases')) {
            return;
        }

        Schema::create('rra_ebm_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('supplier_name');
            $table->string('supplier_tin', 20)->nullable();
            $table->string('invoice_number', 50);
            $table->date('purchase_date');
            $table->decimal('total_amount', 16, 2);
            $table->decimal('tax_amount', 16, 2)->default(0);
            $table->text('items_json');
            $table->boolean('submitted')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->unique(['branch_id', 'invoice_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_purchases');
    }
};
