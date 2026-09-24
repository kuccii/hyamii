<?php

namespace App\Console\Commands;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Console\Command;

class SeedDelicatoAreas extends Command
{
    protected $signature = 'hyamii:seed-delicato-areas {--force : wipe existing areas/tables first}';
    protected $description = 'Create areas + QR-coded tables for the DELICATO restaurant (terrace, rooftop, garden, restaurant, cigar room, rooms).';

    // area_name => [ [code, seats], ... ]
    private array $layout = [
        'Terrasse Bar' => [
            ['TB-1', 2], ['TB-2', 2], ['TB-3', 4], ['TB-4', 4],
        ],
        'Terrasse Rooftop' => [
            ['TR-1', 4], ['TR-2', 4], ['TR-3', 4], ['TR-4', 6],
        ],
        'Garden' => [
            ['GD-1', 4], ['GD-2', 4], ['GD-3', 4], ['GD-4', 6], ['GD-5', 6], ['GD-6', 8],
        ],
        'Restaurant' => [
            ['R-1', 4], ['R-2', 4], ['R-3', 4], ['R-4', 4], ['R-5', 6], ['VIP-1', 8],
        ],
        'Cigar Room' => [
            ['CR-1', 4],
        ],
        'Rooms' => [
            ['Room 1', 2], ['Room 2', 2], ['Room 3', 2], ['VIP Room', 2],
        ],
    ];

    public function handle(): int
    {
        $restaurant = Restaurant::where('name', 'DELICATO')->first();
        if (!$restaurant) {
            $this->error('DELICATO restaurant not found. Run hyamii:seed-delicato first.');
            return self::FAILURE;
        }

        $branch = Branch::where('restaurant_id', $restaurant->id)->first();
        if (!$branch) {
            $this->error('DELICATO has no branch.');
            return self::FAILURE;
        }

        if ($this->option('force')) {
            $this->warn('Force mode: clearing existing areas/tables for DELICATO...');
            Table::where('branch_id', $branch->id)->delete();
            Area::where('branch_id', $branch->id)->delete();
        }

        $existing = Table::where('branch_id', $branch->id)->count();
        if ($existing > 0) {
            $this->info("DELICATO already has {$existing} tables. Use --force to replace.");
            return self::SUCCESS;
        }

        $totalTables = 0;

        foreach ($this->layout as $areaName => $tables) {
            $area = Area::create(['area_name' => $areaName, 'branch_id' => $branch->id]);

            foreach ($tables as [$code, $seats]) {
                $table = Table::create([
                    'table_code' => $code,
                    'area_id' => $area->id,
                    'seating_capacity' => $seats,
                    'hash' => md5(microtime() . rand(1, 99999999)),
                    'branch_id' => $branch->id,
                ]);
                $table->generateQrCode();
                $totalTables++;
            }

            $this->line('  ✓ ' . $areaName . ': ' . count($tables) . ' tables (QR generated)');
        }

        $this->newLine();
        $this->info("✅ DELICATO areas ready: " . count($this->layout) . " areas, {$totalTables} QR-coded tables.");
        return self::SUCCESS;
    }
}
