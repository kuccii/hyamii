<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRraEbmSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::table('rra_ebm_settings', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('rra_ebm_settings');
            $hasFk = false;
            foreach ($foreignKeys as $fk) {
                if (in_array('branch_id', $fk->getLocalColumns())) {
                    $hasFk = true;
                    break;
                }
            }
            if (!$hasFk) {
                $table->foreign('branch_id')->references('id')->on('branches')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('rra_ebm_settings', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });
    }
}
