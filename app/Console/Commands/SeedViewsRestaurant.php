<?php

namespace App\Console\Commands;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Currency;
use App\Models\ItemCategory;
use App\Models\KotPlace;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Module;
use App\Models\OnboardingStep;
use App\Models\OrderType;
use App\Models\Restaurant;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SeedViewsRestaurant extends Command
{
    protected $signature = 'hyamii:seed-views';
    protected $description = 'Seed VIEWS restaurant (Kigali Views) with drinks + food menu from PDFs';

    public function handle(): int
    {
        $existing = Restaurant::where('name', 'VIEWS')->first();
        if ($existing) {
            $this->warn('VIEWS restaurant already exists — deleting and recreating.');
            $existing->delete();
        }

        $country = Country::where('countries_code', 'RW')->first();
        if (!$country) {
            $this->error('Rwanda country not found. Run CountrySeeder first.');
            return self::FAILURE;
        }

        $packageId = 1;
        $this->info('Creating VIEWS (Kigali Views) restaurant...');

        $restaurant = Restaurant::create([
            'name' => 'VIEWS',
            'subtitle' => 'Restaurant & Bar',
            'address' => 'Kigali, Rwanda',
            'phone_number' => '+250 788 123 456',
            'email' => 'info@views.rw',
            'timezone' => 'Africa/Kigali',
            'time_format' => 'h:i A',
            'date_format' => 'd/m/Y',
            'theme_hex' => '#002522',
            'theme_rgb' => '0, 37, 34',
            'country_id' => $country->id,
            'package_id' => $packageId,
            'package_type' => 'annual',
            'about_us' => '<p>Kigali Views — A premium dining experience in the heart of Kigali. Enjoy our curated selection of craft cocktails, fine wines, and delicious food with a stunning view.</p>',
            'facebook_link' => 'https://www.facebook.com/',
            'instagram_link' => 'https://www.instagram.com/',
            'twitter_link' => 'https://www.twitter.com/',
            'customer_site_language' => 'en',
            'approval_status' => 'Approved',
        ]);

        $restaurant->hash = substr(md5($restaurant->id . '_views_' . time()), 0, 20);
        $restaurant->saveQuietly();

        $this->line('  ✓ Restaurant created (ID: ' . $restaurant->id . ')');

        $this->line('  Creating currencies...');
        $this->createCurrencies($restaurant);
        $this->line('  ✓ Currencies created');

        $this->line('  Creating branch...');
        $branch = $this->createBranch($restaurant);
        $this->line('  ✓ Branch created');

        $this->line('  Creating menu categories and items...');
        $menu = Menu::create(['branch_id' => $branch->id, 'menu_name' => 'VIEWS Menu']);
        $this->seedMenu($branch, $menu);
        $this->line('  ✓ Menu items created');

        $this->line('  Creating roles and users...');
        $this->createUsers($restaurant, $branch);
        $this->line('  ✓ Users created');

        $restaurant->license_type = 'paid';
        $restaurant->saveQuietly();

        $this->newLine();
        $this->info('✅ VIEWS (Kigali Views) restaurant seeded successfully!');
        $this->table(
            ['Entity', 'Count'],
            [
                ['Categories', ItemCategory::where('branch_id', $branch->id)->count()],
                ['Menu Items', MenuItem::where('branch_id', $branch->id)->count()],
                ['Branches', 1],
            ]
        );

        return self::SUCCESS;
    }

    private function createCurrencies(Restaurant $restaurant): void
    {
        $currencies = [
            ['currency_name' => 'Rwanda Franc', 'currency_symbol' => 'FRw', 'currency_code' => 'RWF', 'currency_position' => 'left', 'no_of_decimal' => 0, 'thousand_separator' => ',', 'decimal_separator' => '.'],
            ['currency_name' => 'Dollars', 'currency_symbol' => '$', 'currency_code' => 'USD', 'currency_position' => 'left', 'no_of_decimal' => 2, 'thousand_separator' => ',', 'decimal_separator' => '.'],
            ['currency_name' => 'Euros', 'currency_symbol' => '€', 'currency_code' => 'EUR', 'currency_position' => 'left', 'no_of_decimal' => 2, 'thousand_separator' => ',', 'decimal_separator' => '.'],
            ['currency_name' => 'Pounds', 'currency_symbol' => '£', 'currency_code' => 'GBP', 'currency_position' => 'left', 'no_of_decimal' => 2, 'thousand_separator' => ',', 'decimal_separator' => '.'],
        ];
        foreach ($currencies as $c) {
            $c['restaurant_id'] = $restaurant->id;
            $c['created_at'] = now();
            $c['updated_at'] = now();
        }
        Currency::insert($currencies);
        $rwf = Currency::where('restaurant_id', $restaurant->id)->where('currency_code', 'RWF')->first();
        if ($rwf) {
            $restaurant->currency_id = $rwf->id;
            $restaurant->saveQuietly();
        }
    }

    private function createBranch(Restaurant $restaurant): Branch
    {
        $branch = Branch::create([
            'restaurant_id' => $restaurant->id,
            'name' => 'VIEWS Kigali',
            'address' => 'Kigali, Rwanda',
        ]);
        $branch->generateUniqueHash();
        $branch->saveQuietly();

        OnboardingStep::create(['branch_id' => $branch->id]);
        $branch->generateQrCode();
        $this->addOrderTypes($branch);
        $branch->generateKotSetting();

        KotPlace::create([
            'branch_id' => $branch->id,
            'name' => 'Main Kitchen',
            'type' => 'kitchen',
            'is_active' => true,
            'is_default' => true,
        ]);

        Tax::create([
            'restaurant_id' => $restaurant->id,
            'branch_id' => $branch->id,
            'tax_name' => 'VAT',
            'tax_percent' => 18,
            'status' => 'active',
        ]);

        return $branch;
    }

    private function addOrderTypes(Branch $branch): void
    {
        foreach ([
            ['order_type_name' => 'Dine In', 'slug' => 'dine_in'],
            ['order_type_name' => 'Delivery', 'slug' => 'delivery'],
            ['order_type_name' => 'Pickup', 'slug' => 'pickup'],
        ] as $t) {
            OrderType::firstOrCreate([
                'order_type_name' => $t['order_type_name'],
                'branch_id' => $branch->id,
                'slug' => $t['slug'],
            ]);
        }
    }

    private function seedMenu(Branch $branch, Menu $menu): void
    {
        $branchId = $branch->id;
        $menuId = $menu->id;
        $defaultKotId = KotPlace::where('branch_id', $branchId)->where('is_default', true)->value('id');

        // === COCKTAILS (from Drinks Menu) ===
        $catCocktails = ItemCategory::create(['category_name' => 'Cocktails', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catCocktails->id, $branchId, $defaultKotId, [
            ['name' => 'Honey Old Fashioned', 'price' => '18,000 Rwf', 'desc' => 'Honey Jack Daniels, Angostura Bitters'],
            ['name' => 'Margarita Picante', 'price' => '15,000 Rwf', 'desc' => 'Jose Cuervo, Cointreau, Lime'],
            ['name' => 'Cuban Spritz', 'price' => '18,000 Rwf', 'desc' => 'Captain Morgan Spiced, Sparkling Wine, Lime Juice, Angostura Bitters, Syrup, Mint'],
            ['name' => 'Bartender\'s Choice', 'price' => '18,000 Rwf', 'desc' => 'Cocktail of the day'],
        ]);

        // === MOCKTAILS ===
        $catMocktails = ItemCategory::create(['category_name' => 'Mocktails', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catMocktails->id, $branchId, $defaultKotId, [
            ['name' => 'Mocktail', 'price' => '8,000 Rwf'],
        ]);

        // === SOFT DRINKS ===
        $catSoft = ItemCategory::create(['category_name' => 'Soft Drinks', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catSoft->id, $branchId, $defaultKotId, [
            ['name' => 'Fanta', 'price' => '2,500 Rwf'],
            ['name' => 'Coca-Cola', 'price' => '2,500 Rwf'],
            ['name' => 'Sprite', 'price' => '2,500 Rwf'],
            ['name' => 'Tonic', 'price' => '2,500 Rwf'],
        ]);

        // === SPARKLING WATER ===
        $catWater = ItemCategory::create(['category_name' => 'Sparkling Water', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catWater->id, $branchId, $defaultKotId, [
            ['name' => 'Sparkling Water', 'price' => '2,500 Rwf', 'desc' => 'Vitalo'],
        ]);

        // === Beer & Spirits ===
        $catBeerSpirits = ItemCategory::create(['category_name' => 'Beer & Spirits', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catBeerSpirits->id, $branchId, $defaultKotId, [
            ['name' => 'Smirnoff Ice', 'price' => '7,000 Rwf'],
            ['name' => 'Desperados', 'price' => '7,000 Rwf'],
            ['name' => 'Mugizon', 'price' => '3,500 Rwf'],
            ['name' => 'Heineken', 'price' => '3,500 Rwf'],
            ['name' => 'Amstel', 'price' => '3,500 Rwf'],
            ['name' => 'Virunga', 'price' => '3,500 Rwf'],
            ['name' => 'Other Beverages', 'price' => '5,000 Rwf', 'desc' => 'Ask server for selection'],
        ]);

        // === WHITE WINE ===
        $catWhiteWine = ItemCategory::create(['category_name' => 'White Wine', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catWhiteWine->id, $branchId, $defaultKotId, [
            ['name' => 'Cellar Road Chardonnay 2023', 'price' => '15000', 'desc' => 'Glass 15K / Bottle 70K Rwf'],
            ['name' => 'Freyé Parellada & Muscat 2022', 'price' => '15000', 'desc' => 'Glass 15K / Bottle 70K Rwf'],
            ['name' => 'Bericanto Pinot Grigio 2022', 'price' => '90000', 'desc' => 'Bottle 90K Rwf'],
            ['name' => 'Swartland Chenin Blanc 2023', 'price' => '100000', 'desc' => 'Bottle 100K Rwf'],
        ]);

        // === RED WINE ===
        $catRedWine = ItemCategory::create(['category_name' => 'Red Wine', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catRedWine->id, $branchId, $defaultKotId, [
            ['name' => 'Impala Sweet', 'price' => '8000', 'desc' => 'Glass 8K / Bottle 45K Rwf'],
            ['name' => 'La Fauna de La Viña', 'price' => '15000', 'desc' => 'Glass 15K / Bottle 50K Rwf'],
            ['name' => 'Freyé Syrah & Tempranillo 2022', 'price' => '70000', 'desc' => 'Bottle 70K Rwf'],
            ['name' => 'Maestro Primitivo 2023', 'price' => '17000', 'desc' => 'Glass 17K / Bottle 70K Rwf'],
            ['name' => 'Bercanto Cabernet Sauvignon 2020', 'price' => '90000', 'desc' => 'Bottle 90K Rwf'],
            ['name' => 'Bercanto Merlot & Cabernet 2020', 'price' => '100000', 'desc' => 'Bottle 100K Rwf'],
            ['name' => 'Cultivare Tinto DO Penedès 2022', 'price' => '500000', 'desc' => 'Samsó & Sumoll — Bottle 500K Rwf'],
        ]);

        // === ROSÉ ===
        $catRose = ItemCategory::create(['category_name' => 'Rosé', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catRose->id, $branchId, $defaultKotId, [
            ['name' => 'Freyé Syrah & Sumoll Negre 2022', 'price' => '70000', 'desc' => 'Bottle 70K Rwf'],
        ]);

        // === CHAMPAGNE, CAVA & PROSECCO ===
        $catChampagne = ItemCategory::create(['category_name' => 'Champagne, Cava & Prosecco', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catChampagne->id, $branchId, $defaultKotId, [
            ['name' => 'Cielo e Terra Cuvée Blanc de Blanc', 'price' => '70000', 'desc' => 'Bottle 70K Rwf'],
            ['name' => 'Cielo e Terra Freschello Extra Dry', 'price' => '75000', 'desc' => 'Bottle 75K Rwf'],
            ['name' => 'Vallformosa Classic Brut Cava', 'price' => '70000', 'desc' => 'Bottle 70K Rwf'],
            ['name' => 'Vallformosa Semi Seco Ice Cava', 'price' => '75000', 'desc' => 'Bottle 75K Rwf'],
            ['name' => 'Maía Prosecco Extra Dry Bio', 'price' => '100000', 'desc' => 'Bottle 100K Rwf'],
            ['name' => 'Bericanto Prosecco DOC Millesimato', 'price' => '150000', 'desc' => 'Bottle 150K Rwf'],
            ['name' => 'Veuve Clicquot Brut', 'price' => '400000', 'desc' => 'Bottle 400K Rwf'],
        ]);

        // === STARTERS (from Food Menu) ===
        $catStarters = ItemCategory::create(['category_name' => 'Starters', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catStarters->id, $branchId, $defaultKotId, [
            ['name' => 'Korean Fried Cauliflower', 'price' => '12000', 'desc' => 'Crispy chicken wings coated in a sweet and savory soy glaze'],
            ['name' => 'Loaded Nachos', 'price' => '12000', 'desc' => 'Tortilla chips topped with cheese, guacamole, salsa, and sour cream'],
            ['name' => 'Sticky Soy Chicken Wings', 'price' => '12000', 'desc' => 'Crispy chicken wings glazed with a sweet and savory soy sauce'],
        ]);

        // === MAIN COURSE (from Food Menu) ===
        $catMains = ItemCategory::create(['category_name' => 'Main Course', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $catMains->id, $branchId, $defaultKotId, [
            ['name' => 'Pulled BBQ Pork', 'price' => '20000', 'desc' => 'Slow-cooked barbecue pulled pork served with creamy coleslaw and mac & cheese'],
            ['name' => 'Glazed Chicken', 'price' => '22000', 'desc' => 'Glazed chicken breast served with rice mosaic and vegetable velouté'],
            ['name' => 'Orange Fish Fillet', 'price' => '22000', 'desc' => 'Pan-seared fish fillet served with Mediterranean vegetables and an orange butter sauce'],
        ]);

        $this->line('    Categories: Cocktails, Mocktails, Soft Drinks, Sparkling Water, Beer & Spirits, White Wine, Red Wine, Rosé, Champagne/Cava/Prosecco, Starters, Main Course');
    }

    private function insertItems(int $menuId, int $categoryId, int $branchId, int $defaultKotId, array $items): void
    {
        $rows = [];
        foreach ($items as $item) {
            $rows[] = [
                'item_name' => $item['name'],
                'menu_id' => $menuId,
                'item_category_id' => $categoryId,
                'branch_id' => $branchId,
                'type' => MenuItem::NONVEG,
                'price' => $this->parsePrice($item['price']),
                'description' => $item['desc'] ?? null,
                'preparation_time' => null,
                'kot_place_id' => $defaultKotId,
                'is_available' => 1,
                'show_on_customer_site' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        MenuItem::insert($rows);
    }

    private function createUsers(Restaurant $restaurant, Branch $branch): void
    {
        Role::create(['name' => 'Admin_' . $restaurant->id, 'display_name' => 'Admin', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Branch Head_' . $restaurant->id, 'display_name' => 'Branch Head', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Waiter_' . $restaurant->id, 'display_name' => 'Waiter', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Chef_' . $restaurant->id, 'display_name' => 'Chef', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);

        $restaurantModuleIds = Module::where('is_superadmin', 0)->pluck('id')->toArray();
        $allPermissions = \Spatie\Permission\Models\Permission::whereIn('module_id', $restaurantModuleIds)->pluck('name')->toArray();
        Role::where('name', 'Admin_' . $restaurant->id)->first()->syncPermissions($allPermissions);
        Role::where('name', 'Branch Head_' . $restaurant->id)->first()->syncPermissions($allPermissions);

        $admin = User::create([
            'name' => 'Views Admin',
            'email' => 'admin@views.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
        ]);
        $admin->assignRole('Admin_' . $restaurant->id);

        $waiter = User::create([
            'name' => 'Views Waiter',
            'email' => 'waiter@views.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
            'branch_id' => $branch->id,
        ]);
        $waiter->assignRole('Waiter_' . $restaurant->id);

        $this->info('    Admin: admin@views.rw / 123456');
        $this->info('    Waiter: waiter@views.rw / 123456');
    }

    private function parsePrice(string|int $price): float
    {
        if (is_int($price)) {
            return (float) $price;
        }
        // Handle formats like "18,000 Rwf", "15K/70k Rwf", "15000"
        $cleaned = preg_replace('/[^0-9]/', '', (string) $price);
        return (float) $cleaned;
    }
}
