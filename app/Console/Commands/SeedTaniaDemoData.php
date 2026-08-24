<?php

namespace App\Console\Commands;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Kot;
use App\Models\KotItem;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTax;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class SeedTaniaDemoData extends Command
{
    protected $signature = 'hyamii:seed-tania-demo {--force : wipe and re-create demo data for TANIA}';
    protected $description = 'Additively fill the existing TANIA restaurant with Rwanda-themed demo data (areas, tables, customers, orders, reservations, inventory).';

    private Restaurant $restaurant;
    private Branch $branch;
    private array $areas = [];
    private array $tables = [];
    private array $customers = [];
    private array $waiters = [];
    private $menuItems;
    private $taxes;
    private array $orderTypeIds = [];

    public function handle(): int
    {
        $this->restaurant = Restaurant::where('name', 'TANIA')->first();

        if (!$this->restaurant) {
            $this->error('TANIA restaurant not found. Run `php artisan hyamii:seed-tania` first.');
            return self::FAILURE;
        }

        $this->branch = Branch::where('restaurant_id', $this->restaurant->id)->first();

        if (!$this->branch) {
            $this->error('TANIA has no branch.');
            return self::FAILURE;
        }

        $this->info("Filling demo data for TANIA (branch: {$this->branch->name})");

        if ($this->option('force')) {
            $this->warn('Force mode: clearing existing demo data for this branch...');
            $this->clearExisting();
        }

        $this->menuItems = MenuItem::where('branch_id', $this->branch->id)->get(['id', 'price']);
        $this->taxes = Tax::withoutGlobalScopes()->where('branch_id', $this->branch->id)->get(['id', 'tax_percent']);
        $this->waiters = User::where('branch_id', $this->branch->id)->pluck('id')->all();
        foreach (['dine_in' => 'dine_in', 'delivery' => 'delivery', 'pickup' => 'pickup'] as $slug) {
            $ot = \App\Models\OrderType::where('branch_id', $this->branch->id)->where('slug', $slug)->first();
            if ($ot) {
                $this->orderTypeIds[$slug] = $ot->id;
            }
        }

        if ($this->menuItems->isEmpty()) {
            $this->error('TANIA has no menu items. Run `php artisan hyamii:seed-tania` first.');
            return self::FAILURE;
        }

        $this->seedAreas();
        $this->seedTables();
        $this->seedCustomers();
        $this->seedOrders();
        $this->seedReservations();
        $this->seedInventory();

        $this->newLine();
        $this->info('✅ TANIA demo data ready!');
        $this->table(
            ['Entity', 'Count'],
            [
                ['Areas', Area::where('branch_id', $this->branch->id)->count()],
                ['Tables', Table::where('branch_id', $this->branch->id)->count()],
                ['Customers', Customer::where('restaurant_id', $this->restaurant->id)->where('email', 'like', '%@tania-demo.rw')->count()],
                ['Orders', Order::where('branch_id', $this->branch->id)->count()],
                ['Reservations', Reservation::where('table_id', '>', 0)->whereIn('customer_id', $this->customers)->count()],
                ['Inventory items', $this->inventoryCount()],
            ]
        );

        return self::SUCCESS;
    }

    private function clearExisting(): void
    {
        $branchId = $this->branch->id;
        $restaurantId = $this->restaurant->id;

        Reservation::query()->whereIn('table_id', Table::where('branch_id', $branchId)->pluck('id')->all())->delete();
        Order::where('branch_id', $branchId)->delete();
        Table::where('branch_id', $branchId)->delete();
        Area::where('branch_id', $branchId)->delete();
        Customer::where('restaurant_id', $restaurantId)->where('email', 'like', '%@tania-demo.rw')->delete();

        if (class_exists(\Modules\Inventory\Entities\InventoryItem::class)) {
            \Modules\Inventory\Entities\InventoryItem::where('branch_id', $branchId)->delete();
            \Modules\Inventory\Entities\InventoryStock::where('branch_id', $branchId)->delete();
            \Modules\Inventory\Entities\InventoryItemCategory::where('branch_id', $branchId)->delete();
            \Modules\Inventory\Entities\Unit::where('branch_id', $branchId)->delete();
        }
    }

    private function seedAreas(): void
    {
        if (Area::where('branch_id', $this->branch->id)->count() > 0) {
            $this->comment('Areas already exist — skipping.');
            $this->areas = Area::where('branch_id', $this->branch->id)->get()->all();
            return;
        }

        $names = ['Terrace', 'Indoor Hall', 'VIP Lounge'];
        foreach ($names as $name) {
            $this->areas[] = Area::create(['area_name' => $name, 'branch_id' => $this->branch->id]);
        }
        $this->line('  ✓ Areas created (' . count($this->areas) . ')');
    }

    private function seedTables(): void
    {
        if (Table::where('branch_id', $this->branch->id)->count() > 0) {
            $this->comment('Tables already exist — skipping.');
            $this->tables = Table::where('branch_id', $this->branch->id)->pluck('id')->all();
            return;
        }

        $layout = [
            'Terrace' => ['T1' => 2, 'T2' => 2, 'T3' => 4, 'T4' => 4, 'T5' => 6, 'T6' => 4],
            'Indoor Hall' => ['A1' => 2, 'A2' => 2, 'A3' => 4, 'A4' => 4, 'A5' => 6, 'A6' => 4, 'A7' => 8, 'A8' => 6],
            'VIP Lounge' => ['V1' => 6, 'V2' => 8, 'V3' => 10],
        ];

        foreach ($layout as $areaName => $tables) {
            $area = collect($this->areas)->firstWhere('area_name', $areaName);
            if (!$area) {
                continue;
            }
            foreach ($tables as $code => $seats) {
                $table = Table::create([
                    'table_code' => $code,
                    'area_id' => $area->id,
                    'seating_capacity' => $seats,
                    'hash' => md5(microtime() . rand(1, 99999999)),
                    'branch_id' => $this->branch->id,
                ]);
                $table->generateQrCode();
                $this->tables[] = $table->id;
            }
        }
        $this->line('  ✓ Tables created (' . count($this->tables) . ')');
    }

    private function seedCustomers(): void
    {
        if (Customer::where('restaurant_id', $this->restaurant->id)->where('email', 'like', '%@tania-demo.rw')->count() > 0) {
            $this->comment('Demo customers already exist — skipping.');
            $this->customers = Customer::where('restaurant_id', $this->restaurant->id)
                ->where('email', 'like', '%@tania-demo.rw')->pluck('id')->all();
            return;
        }

        $people = [
            ['Alice Uwase', '788123456', 'Nyamirambo'],
            ['Jean Bosco', '722334455', 'Kimihurura'],
            ['Claude Niyonsenga', '733445566', 'Remera'],
            ['Peace Uwimana', '755667788', 'Kacyiru'],
            ['Eric Mugabo', '766778899', 'Gisozi'],
            ['Diane Mukamana', '799001122', 'Kicukiro'],
            ['Patrick Nshimiyimana', '712233445', 'Nyarugenge'],
            ['Sarah Kaitesi', '744556677', 'Kimironko'],
            ['Olivier Habimana', '755889900', 'Remera'],
            ['Josiane Uwase', '722110033', 'Nyamirambo'],
            ['Fred Mugisha', '733221144', 'Kacyiru'],
            ['Grace Ingabire', '766554433', 'Gisozi'],
        ];

        foreach ($people as [$name, $phone, $district]) {
            $slug = strtolower(preg_replace('/[^a-z]+/', '.', $name));
            $customer = Customer::create([
                'restaurant_id' => $this->restaurant->id,
                'name' => $name,
                'email' => $slug . '@tania-demo.rw',
                'phone_code' => '250',
                'phone' => $phone,
                'delivery_address' => $district . ', Kigali, Rwanda',
            ]);
            $this->customers[] = $customer->id;
        }
        $this->line('  ✓ Customers created (' . count($this->customers) . ')');
    }

    private function seedOrders(): void
    {
        if (Order::where('branch_id', $this->branch->id)->count() > 0) {
            $this->comment('Orders already exist — skipping.');
            return;
        }

        if (empty($this->waiters)) {
            $this->warn('No waiters found — skipping orders.');
            return;
        }

        $statusPool = array_merge(
            array_fill(0, 18, 'paid'),
            array_fill(0, 4, 'draft'),
            array_fill(0, 4, 'canceled'),
            array_fill(0, 2, 'payment_due'),
            array_fill(0, 2, 'kot'),
        );

        $orderNumber = ((int) Order::where('branch_id', $this->branch->id)->max('id')) + 1;
        $kotNumber = ((int) Kot::max('id')) + 1;

        foreach ($statusPool as $status) {
            $this->placeOrder($status, $orderNumber++, $kotNumber++);
        }

        $this->line('  ✓ Orders created (' . count($statusPool) . ')');
    }

    private function placeOrder(string $status, int $orderNumber, int $kotNumber): void
    {
        $now = now()->subDays(rand(0, 20))->setTime(rand(8, 21), rand(0, 59), 0);

        $typeSlug = array_rand($this->orderTypeIds);
        $isDineIn = $typeSlug === 'dine_in';
        $tableId = $isDineIn ? $this->tables[array_rand($this->tables)] : null;

        $order = Order::create([
            'order_number' => 'TND-' . $orderNumber,
            'table_id' => $tableId,
            'customer_id' => $this->customers ? $this->customers[array_rand($this->customers)] : null,
            'waiter_id' => $this->waiters[array_rand($this->waiters)],
            'order_type_id' => $this->orderTypeIds[$typeSlug],
            'date_time' => $now->toDateTimeString(),
            'sub_total' => 0,
            'total' => 0,
            'status' => 'draft',
            'branch_id' => $this->branch->id,
            'placed_via' => 'pos',
        ]);

        $kot = Kot::create([
            'kot_number' => (string) $kotNumber,
            'order_id' => $order->id,
            'branch_id' => $this->branch->id,
            'status' => $status === 'paid' && $isDineIn ? 'served' : 'in_kitchen',
        ]);

        $selected = $this->menuItems->random(min(rand(1, 5), $this->menuItems->count()));
        if (!($selected instanceof \Illuminate\Support\Collection)) {
            $selected = collect([$selected]);
        }

        $subTotal = 0.0;
        $orderItemRows = [];
        $kotItemRows = [];

        foreach ($selected as $item) {
            $quantity = rand(1, 3);
            $amount = round($quantity * (float) $item->price, 2);
            $subTotal += $amount;

            $kotItemRows[] = [
                'kot_id' => $kot->id,
                'menu_item_id' => $item->id,
                'menu_item_variation_id' => null,
                'quantity' => $quantity,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $orderItemRows[] = [
                'order_id' => $order->id,
                'menu_item_id' => $item->id,
                'menu_item_variation_id' => null,
                'quantity' => $quantity,
                'price' => $item->price,
                'amount' => $amount,
                'branch_id' => $this->branch->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if ($orderItemRows) {
            OrderItem::insert($orderItemRows);
        }
        if ($kotItemRows) {
            KotItem::insert($kotItemRows);
        }

        $total = $subTotal;
        if ($this->taxes && !$this->taxes->isEmpty()) {
            $taxRows = [];
            foreach ($this->taxes as $tax) {
                $taxRows[] = ['order_id' => $order->id, 'tax_id' => $tax->id];
                $total += ((float) $tax->tax_percent / 100) * $subTotal;
            }
            if ($taxRows) {
                OrderTax::insert($taxRows);
            }
        }
        $total = round($total);

        Order::where('id', $order->id)->update([
            'sub_total' => $subTotal,
            'total' => $total,
        ]);

        if ($status === 'paid') {
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => ['cash', 'card', 'others'][array_rand(['cash', 'card', 'others'])],
                'amount' => $total,
                'branch_id' => $this->branch->id,
            ]);
            Order::where('id', $order->id)->update(['status' => 'paid', 'amount_paid' => $total]);
        } elseif ($status === 'canceled') {
            Order::where('id', $order->id)->update([
                'status' => 'canceled',
                'cancel_time' => $now->toDateTimeString(),
                'amount_paid' => 0,
            ]);
        } elseif ($status === 'payment_due') {
            Order::where('id', $order->id)->update(['status' => 'payment_due', 'amount_paid' => 0]);
        } else {
            Order::where('id', $order->id)->update(['status' => $status, 'amount_paid' => 0]);
        }
    }

    private function seedReservations(): void
    {
        if (empty($this->tables) || empty($this->customers)) {
            $this->warn('Tables/customers missing — skipping reservations.');
            return;
        }

        $existing = Reservation::query();
        if (Schema::hasColumn('reservations', 'branch_id')) {
            $existing->where('branch_id', $this->branch->id);
        }
        if ($existing->count() > 0) {
            $this->comment('Reservations already exist — skipping.');
            return;
        }

        $slots = ['Breakfast', 'Lunch', 'Dinner'];
        $notes = [
            'Window seat preferred',
            'Celebrating a birthday',
            'Quiet corner, please',
            'High chair needed for a toddler',
            'Business lunch',
            'Regular customer',
        ];

        for ($i = 0; $i < 8; $i++) {
            $dt = now()->addDays(rand(1, 7))->setTime(rand(9, 21), [0, 30][rand(0, 1)]);
            $data = [
                'table_id' => $this->tables[array_rand($this->tables)],
                'customer_id' => $this->customers[array_rand($this->customers)],
                'reservation_date_time' => $dt->toDateTimeString(),
                'party_size' => rand(2, 8),
                'special_requests' => $notes[array_rand($notes)],
                'reservation_status' => 'Confirmed',
                'reservation_slot_type' => $slots[array_rand($slots)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if (Schema::hasColumn('reservations', 'branch_id')) {
                $data['branch_id'] = $this->branch->id;
            }
            Reservation::create($data);
        }
        $this->line('  ✓ Reservations created (8)');
    }

    private function seedInventory(): void
    {
        if (!class_exists(\Modules\Inventory\Entities\InventoryItem::class)) {
            $this->comment('Inventory module not available — skipping inventory.');
            return;
        }

        if (\Modules\Inventory\Entities\InventoryItem::where('branch_id', $this->branch->id)->count() > 0) {
            $this->comment('Inventory items already exist — skipping.');
            return;
        }

        if (!function_exists('module_enabled') || !module_enabled('Inventory')) {
            $this->comment('Inventory module not enabled — skipping inventory.');
            return;
        }

        $unitIds = [];
        foreach ([
            ['Kilogram', 'kg'],
            ['Gram', 'g'],
            ['Litre', 'L'],
            ['Piece', 'pcs'],
            ['Tray', 'tray'],
        ] as [$uName, $uSym]) {
            $unitIds[$uSym] = \Modules\Inventory\Entities\Unit::create([
                'branch_id' => $this->branch->id,
                'name' => $uName,
                'symbol' => $uSym,
            ])->id;
        }

        $catIds = [];
        foreach (['Vegetables', 'Meat & Fish', 'Staples', 'Dairy & Eggs', 'Beverages'] as $catName) {
            $catIds[$catName] = \Modules\Inventory\Entities\InventoryItemCategory::create([
                'branch_id' => $this->branch->id,
                'name' => $catName,
            ])->id;
        }

        $items = [
            ['Vegetables', 'Tomatoes', 'kg', 20],
            ['Vegetables', 'Onions', 'kg', 15],
            ['Vegetables', 'Green Pepper', 'kg', 10],
            ['Vegetables', 'Spinach', 'kg', 10],
            ['Vegetables', 'Irish Potatoes', 'kg', 50],
            ['Vegetables', 'Carrots', 'kg', 20],
            ['Meat & Fish', 'Chicken', 'kg', 30],
            ['Meat & Fish', 'Beef', 'kg', 25],
            ['Meat & Fish', 'Goat Meat', 'kg', 15],
            ['Meat & Fish', 'Tilapia', 'kg', 20],
            ['Meat & Fish', 'Pork', 'kg', 20],
            ['Meat & Fish', 'Sausages', 'kg', 15],
            ['Staples', 'Rice', 'kg', 60],
            ['Staples', 'Ugali Flour', 'kg', 50],
            ['Staples', 'Cooking Oil', 'L', 30],
            ['Staples', 'Beans', 'kg', 40],
            ['Staples', 'Salt', 'kg', 10],
            ['Staples', 'Sugar', 'kg', 20],
            ['Dairy & Eggs', 'Milk', 'L', 25],
            ['Dairy & Eggs', 'Eggs', 'tray', 100],
            ['Dairy & Eggs', 'Butter', 'kg', 5],
            ['Dairy & Eggs', 'Cheese', 'kg', 8],
            ['Beverages', 'Coffee Beans', 'kg', 15],
            ['Beverages', 'Tea Leaves', 'kg', 10],
            ['Beverages', 'Fruit Juice', 'L', 20],
            ['Beverages', 'Soda', 'pcs', 50],
            ['Beverages', 'Bottled Water', 'pcs', 100],
        ];

        // A few items deliberately low to demonstrate low-stock alerts.
        $lowStock = ['Green Pepper', 'Butter', 'Goat Meat'];

        foreach ($items as [$cat, $name, $sym, $threshold]) {
            $item = \Modules\Inventory\Entities\InventoryItem::create([
                'branch_id' => $this->branch->id,
                'name' => $name,
                'inventory_item_category_id' => $catIds[$cat],
                'unit_id' => $unitIds[$sym],
                'threshold_quantity' => $threshold,
            ]);

            $qty = in_array($name, $lowStock)
                ? round($threshold * 0.3, 2)
                : round($threshold * rand(2, 4), 2);

            \Modules\Inventory\Entities\InventoryStock::create([
                'branch_id' => $this->branch->id,
                'inventory_item_id' => $item->id,
                'quantity' => $qty,
            ]);
        }

        $this->line('  ✓ Inventory seeded (' . count($items) . ' items)');
    }

    private function inventoryCount(): int
    {
        if (!class_exists(\Modules\Inventory\Entities\InventoryItem::class)) {
            return 0;
        }
        return \Modules\Inventory\Entities\InventoryItem::where('branch_id', $this->branch->id)->count();
    }
}
