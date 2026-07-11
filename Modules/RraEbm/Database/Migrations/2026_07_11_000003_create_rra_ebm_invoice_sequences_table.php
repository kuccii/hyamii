<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRraEbmInvoiceSequencesTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rra_ebm_invoice_sequences')) {
            return;
        }

        Schema::create('rra_ebm_invoice_sequences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('last_number')->default(0);
            $table->timestamps();

            $table->unique('branch_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_invoice_sequences');
    }
}
