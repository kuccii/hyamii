<?php

namespace App\Console\Commands;

use App\Models\Branch;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Console\Command;

class RenameDelicatoTables extends Command
{
    protected $signature = 'hyamii:rename-delicato-tables';
    protected $description = 'Rename DELICATO tables from short codes (TB-1) to full display names (Terrasse Bar 1).';

    // old_code => full_name
    private array $renameMap = [
        // Terrasse Bar
        'TB-1' => 'Terrasse Bar 1',
        'TB-2' => 'Terrasse Bar 2',
        'TB-3' => 'Terrasse Bar 3',
        'TB-4' => 'Terrasse Bar 4',
        // Terrasse Rooftop
        'TR-1' => 'Terrasse Rooftop 1',
        'TR-2' => 'Terrasse Rooftop 2',
        'TR-3' => 'Terrasse Rooftop 3',
        'TR-4' => 'Terrasse Rooftop 4',
        // Garden
        'GD-1' => 'Garden 1',
        'GD-2' => 'Garden 2',
        'GD-3' => 'Garden 3',
        'GD-4' => 'Garden 4',
        'GD-5' => 'Garden 5',
        'GD-6' => 'Garden 6',
        // Restaurant
        'R-1' => 'Restaurant 1',
        'R-2' => 'Restaurant 2',
        'R-3' => 'Restaurant 3',
        'R-4' => 'Restaurant 4',
        'R-5' => 'Restaurant 5',
        'VIP-1' => 'Restaurant VIP',
        // Cigar Room
        'CR-1' => 'Cigar Room',
        // Rooms
        'Room 1' => 'Bedroom 1',
        'Room 2' => 'Bedroom 2',
        'Room 3' => 'Bedroom 3',
        'VIP Room' => 'VIP Bedroom',
    ];

    public function handle(): int
    {
        $restaurant = Restaurant::where('name', 'DELICATO')->first();
        if (!$restaurant) {
            $this->error('DELICATO restaurant not found.');
            return self::FAILURE;
        }

        $branchIds = Branch::where('restaurant_id', $restaurant->id)->pluck('id')->toArray();

        $renamed = 0;
        $missing = [];

        foreach ($this->renameMap as $oldCode => $newName) {
            $tables = Table::whereIn('branch_id', $branchIds)->where('table_code', $oldCode)->get();

            if ($tables->isEmpty()) {
                $missing[] = $oldCode;
                continue;
            }

            foreach ($tables as $table) {
                $table->table_code = $newName;
                $table->saveQuietly(); // hash + QR PNG stay valid — QR links use the hash
                $renamed++;
            }
        }

        $this->info("Renamed {$renamed} tables to full display names.");

        if (!empty($missing)) {
            $this->warn('Codes not found (already renamed or missing): ' . implode(', ', $missing));
        }

        // Show the final state
        $this->table(
            ['Area', 'Table Name', 'Seats', 'QR link'],
            Table::whereIn('branch_id', $branchIds)
                ->with('area')
                ->orderBy('area_id')
                ->get()
                ->map(fn ($t) => [
                    $t->area->area_name ?? '-',
                    $t->table_code,
                    $t->seating_capacity,
                    'https://hyamii.com/restaurant/table/' . $t->hash,
                ])
                ->toArray()
        );

        return self::SUCCESS;
    }
}
