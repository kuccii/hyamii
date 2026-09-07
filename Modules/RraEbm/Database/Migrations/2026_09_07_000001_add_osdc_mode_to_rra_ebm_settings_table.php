<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rra_ebm_settings', function (Blueprint $table) {
            $table->string('mode', 20)->default('physical_ebm')->after('enabled');
            $table->string('cmc_key')->nullable()->after('security_key');
        });
    }

    public function down(): void
    {
        Schema::table('rra_ebm_settings', function (Blueprint $table) {
            $table->dropColumn(['mode', 'cmc_key']);
        });
    }
};
