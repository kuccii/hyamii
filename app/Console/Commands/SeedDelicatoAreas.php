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

    // area_name => [ [full table name, seats], ... ]
    private array $layout = [
        'Terrasse Bar' => [
            ['Terrasse Bar 1', 2], ['Terrasse Bar 2', 2], ['Terrasse Bar 3', 4], ['Terrasse Bar 4', 4],
        ],
        'Terrasse Rooftop' => [
            ['Terrasse Rooftop 1', 4], ['Terrasse Rooftop 2', 4], ['Terrasse Rooftop 3', 4], ['Terrasse Rooftop 4', 6],
        ],
        'Garden' => [
            ['Garden 1', 4], ['Garden 2', 4], ['Garden 3', 4], ['Garden 4', 6], ['Garden 5', 6], ['Garden 6', 8],
        ],
        'Restaurant' => [
            ['Restaurant 1', 4], ['Restaurant 2', 4], ['Restaurant 3', 4], ['Restaurant 4', 4], ['Restaurant 5', 6], ['Restaurant VIP', 8],
        ],
        'Cigar Room' => [
            ['Cigar Room', 4],
        ],
        'Rooms' => [
            ['Bedroom 1', 2], ['Bedroom 2', 2], ['Bedroom 3', 2], ['VIP Bedroom', 2],
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
