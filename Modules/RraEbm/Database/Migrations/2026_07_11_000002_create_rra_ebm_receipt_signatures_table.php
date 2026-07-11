<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRraEbmReceiptSignaturesTable extends Migration
{
    public function up(): void
    {
        Schema::create('rra_ebm_receipt_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('receipt_number');
            $table->text('internal_data')->nullable();
            $table->text('receipt_signature');
            $table->string('total_receipt_number')->nullable();
            $table->string('vsdc_receipt_publish_date')->nullable();
            $table->string('sdc_id')->nullable();
            $table->string('mrc_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('receipt_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_receipt_signatures');
    }
}
