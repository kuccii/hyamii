<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->string('currency_code', 10);
            $table->decimal('monthly_price', 16, 2)->nullable();
            $table->decimal('annual_price', 16, 2)->nullable();
            $table->timestamps();

            $table->unique(['package_id', 'currency_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_prices');
    }
};
