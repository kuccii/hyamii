<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Table;
use App\Models\Area;
use Illuminate\Database\Seeder;

/**
 * Seeds rich demo data (areas, tables, menu items, delivery executives, orders)
 * for every restaurant's first branch — regardless of APP_ENV.
 *
 * Usage:  php artisan db:seed --class=DemoDataSeeder
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::with('branches')->get();

        if ($restaurants->isEmpty()) {
            $this->command->warn('No restaurants found. Run the main DatabaseSeeder first.');
            return;
        }

        foreach ($restaurants as $restaurant) {
            $branch = $restaurant->branches->first();

            if (!$branch) {
                $this->command->warn("Restaurant #{$restaurant->id} ({$restaurant->name}) has no branches — skipping.");
                continue;
            }

            $this->command->info("▸ Seeding demo data for: {$restaurant->name} → Branch: {$branch->name} (ID {$branch->id})");

            // Skip if this branch already has menu items (idempotent guard)
            if (MenuItem::where('branch_id', $branch->id)->count() > 5) {
                $this->command->comment("  ⤷ Branch already has menu items — skipping MenuItemSeeder.");
            } else {
                $this->call(MenuItemSeeder::class, false, ['branch' => $branch]);
                $this->command->info("  ✓ Menu items seeded.");
            }

            // Areas
            if (Area::where('branch_id', $branch->id)->count() === 0) {
                $this->call(AreaSeeder::class, false, ['branch' => $branch]);
                $this->command->info("  ✓ Areas seeded.");
            } else {
                $this->command->comment("  ⤷ Areas already exist — skipping.");
            }

            // Tables
            if (Table::where('branch_id', $branch->id)->count() === 0) {
                $this->call(TableSeeder::class, false, ['branch' => $branch]);
                $this->command->info("  ✓ Tables seeded.");
            } else {
                $this->command->comment("  ⤷ Tables already exist — skipping.");
            }

            // Delivery Executives
            $this->call(DeliveryExecutiveSeeder::class, false, ['branch' => $branch]);
            $this->command->info("  ✓ Delivery executives seeded.");

            // Orders (needs tables + menu items + waiters to exist)
            $this->call(OrderSeeder::class, false, ['branch' => $branch]);
            $this->command->info("  ✓ Orders seeded.");

            // Mark restaurant as paid so full functionality is available
            $restaurant->license_type = 'paid';
            $restaurant->save();
            $this->command->info("  ✓ Restaurant license set to 'paid'.");
        }

        $this->command->newLine();
        $this->command->info('✅ Demo data seeding complete!');
        $this->command->newLine();

        // Print summary
        $this->command->table(
            ['Entity', 'Count'],
            [
                ['Restaurants', Restaurant::count()],
                ['Menu Items', MenuItem::count()],
                ['Areas', Area::count()],
                ['Tables', Table::count()],
                ['Orders', \App\Models\Order::count()],
                ['Customers', \App\Models\Customer::count()],
            ]
        );
    }
}
