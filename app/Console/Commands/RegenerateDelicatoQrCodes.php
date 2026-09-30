<?php

namespace App\Console\Commands;

use App\Models\Branch;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Console\Command;

class RegenerateDelicatoQrCodes extends Command
{
    protected $signature = 'hyamii:regen-delicato-qrs {--new-hash : rotate hashes too (invalidates previously printed links)}';
    protected $description = 'Regenerate QR PNGs for DELICATO tables with current table names, keeping hashes (links) stable by default.';

    public function handle(): int
    {
        $restaurant = Restaurant::where('name', 'DELICATO')->first();
        if (!$restaurant) {
            $this->error('DELICATO restaurant not found.');
            return self::FAILURE;
        }

        $branchIds = Branch::where('restaurant_id', $restaurant->id)->pluck('id')->toArray();
        $tables = Table::whereIn('branch_id', $branchIds)->orderBy('area_id')->orderBy('id')->get();

        if ($tables->isEmpty()) {
            $this->error('No tables found for DELICATO.');
            return self::FAILURE;
        }

        $rotated = $this->option('new-hash') ? true : false;
        $done = 0;
        $failed = [];

        foreach ($tables as $table) {
            $oldHash = $table->hash;

            try {
                if ($rotated) {
                    // Standard path: rotates the hash (invalidates old printed links).
                    $table->generateQrCode();
                } else {
                    // Keep the existing hash — QR links already in circulation stay valid.
                    $table->createQrCode(
                        route('table_order', [$table->hash]),
                        __('modules.table.table') . ' ' . str()->slug($table->table_code, '-', 'en')
                    );
                }
            } catch (\Throwable $e) {
                $failed[] = $table->table_code . ': ' . $e->getMessage();
                continue;
            }

            $done++;

            $this->line(sprintf(
                '  ✓ %-20s hash %s | file %s',
                $table->table_code,
                $table->hash === $oldHash ? 'kept' : 'ROTATED',
                $table->getQrCodeFileName()
            ));
        }

        $this->newLine();
        $this->info("Regenerated {$done}/{$tables->count()} QR codes (hashes " . ($rotated ? 'rotated' : 'preserved') . ').');

        if (!empty($failed)) {
            $this->error('Failed: ' . implode(' | ', $failed));
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
