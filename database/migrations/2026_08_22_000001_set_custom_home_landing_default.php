<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('global_settings')->update(['landing_type' => 'custom_home']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('global_settings')->update(['landing_type' => 'dynamic']);
    }
};
