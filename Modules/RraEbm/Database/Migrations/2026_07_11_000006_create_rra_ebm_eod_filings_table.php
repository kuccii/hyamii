<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rra_ebm_eod_filings')) {
            return;
        }

        Schema::create('rra_ebm_eod_filings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->date('filing_date');
            $table->integer('total_orders')->default(0);
            $table->decimal('total_sales_amount', 16, 2)->default(0);
            $table->decimal('total_tax_amount', 16, 2)->default(0);
            $table->string('status')->default('pending'); // pending, filed, failed
            $table->text('error_message')->nullable();
            $table->timestamp('filed_at')->nullable();
            $table->boolean('day_closed')->default(false);
            $table->timestamp('closed_at')->nullable();
            $table->json('rra_response')->nullable();
            $table->timestamps();

            $table->unique(['branch_id', 'filing_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_eod_filings');
    }
};
