<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedViewsInventory extends Command
{
    protected $signature = 'hyamii:seed-views-inventory {--force : delete existing items first}';
    protected $description = 'Seed the VIEWS restaurant (branch_id=8) inventory with bar stock from the stock control sheet.';

    private int $branchId = 8;
    private array $unitIds = [];
    private array $catIds = [];

    public function handle(): int
    {
        if (!class_exists(\Modules\Inventory\Entities\InventoryItem::class)) {
            $this->error('Inventory module not available.');
            return self::FAILURE;
        }

        if (!function_exists('module_enabled') || !module_enabled('Inventory')) {
            $this->error('Inventory module is not enabled.');
            return self::FAILURE;
        }

        if ($this->option('force')) {
            $this->warn('Force mode: clearing existing inventory for VIEWS (branch 8)...');
            \Modules\Inventory\Entities\InventoryItem::where('branch_id', $this->branchId)->delete();
            \Modules\Inventory\Entities\InventoryStock::where('branch_id', $this->branchId)->delete();
            \Modules\Inventory\Entities\InventoryItemCategory::where('branch_id', $this->branchId)->delete();
            \Modules\Inventory\Entities\Unit::where('branch_id', $this->branchId)->delete();
        }

        $existing = \Modules\Inventory\Entities\InventoryItem::where('branch_id', $this->branchId)->count();
        if ($existing > 0) {
            $this->info("VIEWS already has {$existing} inventory items. Use --force to replace.");
            return self::SUCCESS;
        }

        $this->seedUnits();
        $this->seedCategories();
        $this->seedItems();

        $count = \Modules\Inventory\Entities\InventoryItem::where('branch_id', $this->branchId)->count();
        $this->newLine();
        $this->info("✅ Seeded {$count} inventory items for VIEWS (branch {$this->branchId}).");
        return self::SUCCESS;
    }

    private function seedUnits(): void
    {
        $units = [
            ['Bottle', 'btl'],
            ['Piece', 'pc'],
            ['Can', 'can'],
            ['Litre', 'L'],
        ];

        foreach ($units as [$name, $symbol]) {
            $this->unitIds[$symbol] = \Modules\Inventory\Entities\Unit::create([
                'branch_id' => $this->branchId,
                'name' => $name,
                'symbol' => $symbol,
            ])->id;
        }
        $this->line('  ✓ Units created (' . count($units) . ')');
    }

    private function seedCategories(): void
    {
        $categories = [
            'Soft Drinks',
            'Beers & Malt',
            'Spirits & Liqueurs',
            'Wines & Champagnes',
        ];

        foreach ($categories as $name) {
            $this->catIds[$name] = \Modules\Inventory\Entities\InventoryItemCategory::create([
                'branch_id' => $this->branchId,
                'name' => $name,
            ])->id;
        }
        $this->line('  ✓ Categories created (' . count($categories) . ')');
    }

    private function seedItems(): void
    {
        // ─── Soft Drinks ────────────────────────────────────────────────
        $softDrinks = [
            ['COCA COLA', 12],
            ['FANTA CITRON', 15],
            ['FANTA ORANGE', 12],
            ['FANTA PINEAPPLE', 18],
            ['SPRITE', 12],
            ['TONIC', 6],
            ['VITALO', 0],
            ['PANACHE', 0],
            ['COKE ZERO', 0],
            ['SPARKLING WATER', 16],
            ['STILL WATER', 0],
            ['INYANGE WATER', 26],
        ];

        // ─── Beers & Malt ───────────────────────────────────────────────
        $beers = [
            ['MUTZIG 33CL', 65],
            ['HEINEKEN 33CL', 0],
            ['SKOL LAGER 33CL', 3],
            ['SKOL GOLD 33CL', 0],
            ['SKOL MIST 33CL', 22],
            ['SKOL SILVER 33CL', 0],
            ['HEINEKEN', 0],
            ['AMSTEL MALT', 65],
            ['LEFFE', 0],
        ];

        // ─── Spirits & Liqueurs ─────────────────────────────────────────
        $spirits = [
            ['GUINESS', 21],
            ['VIRUNGA MIST', 0],
            ['VIRUNGA SILVER', 0],
            ['VIRUNGA GOLD', 0],
            ['SMIRNOFF GUARANA', 22],
            ['SAVANA', 17],
            ['SMIRNOFF BLACK ICE', 22],
            ['DESPERADOS', 0],
            ['CORONNA', 18],
            ['HENNESSY VSOP', 0.10],
            ['HENNESSY VS', 0],
            ['MARTELL VS', 0.25],
            ['MARTELL VSOP', 0],
            ['ST. REMY VSOP', 0.25],
            ['COINTREAU', 0.33],
            ['JAGERMEISTER', 0.25],
            ['APEROL', 0.50],
            ['MALIBU', 0.50],
            ['AMARULA', 0.33],
            ['HENDRICKS', 0.25],
            ['BEEFEATER', 0.33],
            ['GORDON\'S GIN', 0.50],
            ['OLMECA SILVER', 0],
            ['OLMECA GOLD', 0.05],
            ['DON JULIO REPOSADO', 0.33],
            ['PATRON SILVER', 0.33],
            ['ABSOLUTE VODKA', 0.33],
            ['GREY GOOSE', 0.33],
            ['CAPTAIN MORGAN GOLD', 0.33],
            ['ABERLOUR', 0.33],
            ['JACQUE DANIEL\'S', 0.33],
            ['J.W BLACK LABEL', 0.33],
            ['REMY MARTIN VSOP', 0.50],
            ['MARTINI BIANCO', 0.33],
            ['CAMPARI', 0.50],
        ];

        // ─── Wines & Champagnes ─────────────────────────────────────────
        $wines = [
            ['CELLAR ROAD CHARDONNAY', 0],
            ['SWARTLAND CHENIN BLANC', 2],
            ['BERICANTO PINOT GRIGIO', 2],
            ['FREYE PARELLADA & MUSCAT', 1],
            ['LA VINA DE LA FAUNA WHITE', 2],
            ['VEUVE CLIQUOTS', 0],
            ['MOET & CHAMDON', 0],
            ['LAURENT PERRIER', 0],
            ['VOUVRAY', 1],
            ['TOURAINE', 0],
            ['MASIA LA SALA', 6],
            ['CANTELLI', 0],
            ['MAESTRO PRIMITIVO', 0.50],
            ['CULTIVARE TINTO', 2],
            ['LA VINA DE LA FAUNA RED', 2],
            ['BERICANTO CAB. SAUVIGNON', 0],
            ['FREYE SYRAH TEMPRANILLO', 1],
            ['LE BAS DE LA RUE EN ROSE', 0],
            ['VOUVRAY WHITE WINE', 3],
        ];

        $catMap = [
            'Soft Drinks' => $softDrinks,
            'Beers & Malt' => $beers,
            'Spirits & Liqueurs' => $spirits,
            'Wines & Champagnes' => $wines,
        ];

        $total = 0;

        foreach ($catMap as $catName => $items) {
            $catId = $this->catIds[$catName];
            $unitSymbol = in_array($catName, ['Soft Drinks', 'Beers & Malt']) ? 'pc' : 'btl';
            $unitId = $this->unitIds[$unitSymbol];

            foreach ($items as [$name, $qty]) {
                $threshold = max(1, (int) ceil($qty * 0.15)); // 15% as low-stock threshold

                $item = \Modules\Inventory\Entities\InventoryItem::create([
                    'branch_id' => $this->branchId,
                    'name' => $name,
                    'inventory_item_category_id' => $catId,
                    'unit_id' => $unitId,
                    'threshold_quantity' => $threshold,
                ]);

                \Modules\Inventory\Entities\InventoryStock::create([
                    'branch_id' => $this->branchId,
                    'inventory_item_id' => $item->id,
                    'quantity' => $qty,
                ]);

                $total++;
            }

            $this->line("  ✓ {$catName}: " . count($items) . " items");
        }

        $this->line("  ── Total: {$total} items");
    }
}
