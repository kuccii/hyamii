<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRraEbmSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('rra_ebm_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->boolean('enabled')->default(false);
            $table->string('tin_number', 20)->nullable();
            $table->string('branch_id_rra', 20)->nullable();
            $table->string('server_url')->nullable();
            $table->string('app_name')->nullable();
            $table->string('device_serial_no')->nullable();
            $table->string('machine_reference_code')->nullable();
            $table->string('security_key')->nullable();
            $table->boolean('auto_sync_products')->default(true);
            $table->boolean('submit_on_pos_complete')->default(true);
            $table->boolean('submit_on_online_order')->default(false);
            $table->boolean('submit_on_kiosk')->default(false);
            $table->timestamp('last_initialized_at')->nullable();
            $table->timestamps();

            $table->unique('branch_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rra_ebm_settings');
    }
}
