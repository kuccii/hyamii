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

class SeedDelicatoRestaurant extends Command
{
    protected $signature = 'hyamii:seed-delicato';
    protected $description = 'Seed DELICATO restaurant with full menu (food, drinks, wines, spirits) from PDF';

    public function handle(): int
    {
        $existing = Restaurant::where('name', 'DELICATO')->first();
        if ($existing) {
            $this->warn('DELICATO restaurant already exists — deleting and recreating.');
            $existing->delete();
        }

        $country = Country::where('countries_code', 'RW')->first();
        if (!$country) {
            $this->error('Rwanda country not found. Run CountrySeeder first.');
            return self::FAILURE;
        }

        $this->info('Creating DELICATO restaurant...');

        $restaurant = Restaurant::create([
            'name' => 'DELICATO',
            'subtitle' => 'Restaurant, Bar & Lounge',
            'address' => 'Kigali, Rwanda',
            'phone_number' => '+250 788 000 000',
            'email' => 'info@delicato.rw',
            'timezone' => 'Africa/Kigali',
            'time_format' => 'h:i A',
            'date_format' => 'd/m/Y',
            'theme_hex' => '#002522',
            'theme_rgb' => '0, 37, 34',
            'country_id' => $country->id,
            'package_id' => 1,
            'package_type' => 'annual',
            'about_us' => '<p>Delicato — Italian-inspired dining in the heart of Kigali. Pastas, pizzas, grills, fine wines and crafted cocktails.</p>',
            'customer_site_language' => 'en',
            'approval_status' => 'Approved',
        ]);

        $restaurant->hash = substr(md5($restaurant->id . '_delicato_' . time()), 0, 20);
        $restaurant->saveQuietly();

        $this->line('  ✓ Restaurant created (ID: ' . $restaurant->id . ')');

        $this->line('  Creating currencies...');
        $this->createCurrencies($restaurant);
        $this->line('  ✓ Currencies created');

        $this->line('  Creating branch...');
        $branch = $this->createBranch($restaurant);
        $this->line('  ✓ Branch created');

        $this->line('  Creating menu categories and items...');
        $menu = Menu::create(['branch_id' => $branch->id, 'menu_name' => 'Delicato Menu']);
        $this->seedMenu($branch, $menu);
        $this->line('  ✓ Menu items created');

        $this->line('  Creating roles and users...');
        $this->createUsers($restaurant, $branch);
        $this->line('  ✓ Users created');

        $restaurant->license_type = 'paid';
        $restaurant->saveQuietly();

        $this->newLine();
        $this->info('✅ DELICATO restaurant seeded successfully!');
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
            'name' => 'Delicato Kigali',
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

        // === BREAKFAST ===
        $cat = ItemCategory::create(['category_name' => 'Breakfast', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Full American Breakfast', 'price' => 7000],
            ['name' => 'Fritata Italian', 'price' => 7000],
            ['name' => 'American Denver Omelete', 'price' => 8000],
            ['name' => 'Mushroom and Spinach Omelete', 'price' => 4000],
            ['name' => 'Scrambled Egg', 'price' => 3000],
            ['name' => 'Spanish Omelete', 'price' => 3000],
            ['name' => 'Special Omelete', 'price' => 4000],
            ['name' => 'Vegetable Omelete', 'price' => 5000],
            ['name' => 'Regular Omelete', 'price' => 2000],
            ['name' => 'Burrito', 'price' => 10000],
            ['name' => 'Delicato Omelete', 'price' => 10000],
        ]);

        // === TEA ===
        $cat = ItemCategory::create(['category_name' => 'Tea', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Hot Chocolate Tea', 'price' => 15000],
            ['name' => 'Ginger Lemon Tea', 'price' => 12000],
            ['name' => 'African Tea', 'price' => 5000],
            ['name' => 'Black Tea', 'price' => 7000],
            ['name' => 'Spice Tea', 'price' => 12000],
            ['name' => 'Green Tea', 'price' => 15000],
        ]);

        // === SALADS ===
        $cat = ItemCategory::create(['category_name' => 'Salads', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Oriental Salad', 'price' => 12000],
            ['name' => 'Avocado Vinaigrette', 'price' => 10000],
            ['name' => 'Nicoise Salad', 'price' => 10000],
            ['name' => 'Mexican Salad', 'price' => 10000],
        ]);

        // === STARTERS ===
        $cat = ItemCategory::create(['category_name' => 'Starters', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Beef Samosa', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Chicken Samosa', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Vegetable Samosa', 'desc' => '3 pieces', 'price' => 3000],
        ]);

        // === SOUPS ===
        $cat = ItemCategory::create(['category_name' => 'Soups', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'American Zuppa Tuscana', 'price' => 12000],
            ['name' => 'American Lentil Soup', 'price' => 12000],
            ['name' => 'Ginger Carrot Soup', 'price' => 12000],
            ['name' => 'Vegetable Soup', 'price' => 15000],
        ]);

        // === PASTA ===
        $cat = ItemCategory::create(['category_name' => 'Pasta', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Mexican Spaghetti Verde', 'price' => 10000],
            ['name' => 'Beef Chow Mein', 'price' => 12000],
            ['name' => 'Chicken Chow Mein', 'price' => 12000],
            ['name' => 'Mexican Cheesy Spaghetti', 'price' => 15000],
            ['name' => 'Italian Bucatini Pasta', 'price' => 18000],
            ['name' => 'Spaghetti Alla Gricia', 'price' => 18000],
            ['name' => 'Spaghetti Al Pomodoro', 'price' => 12000],
            ['name' => 'Spaghetti Bolognaise', 'price' => 12000],
            ['name' => 'Spaghetti Carbonara', 'price' => 15000],
        ]);

        // === BURGERS ===
        $cat = ItemCategory::create(['category_name' => 'Burgers', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'British Pub Burger', 'price' => 18000],
            ['name' => 'American Smash Burger', 'price' => 15000],
            ['name' => 'Chicken Cheese Taco Burger', 'price' => 12000],
            ['name' => 'Bacon Burger', 'price' => 12000],
            ['name' => 'Delicato Beef Burger', 'price' => 15000],
            ['name' => 'Delicato Chicken Burger', 'price' => 18000],
        ]);

        // === SANDWICHES ===
        $cat = ItemCategory::create(['category_name' => 'Sandwiches', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Bacon Sandwich', 'price' => 10000],
            ['name' => 'Vegetable Sandwich', 'price' => 10000],
            ['name' => 'Club Sandwich', 'price' => 18000],
            ['name' => 'Croque Monsieur', 'price' => 12000],
            ['name' => 'Croque Madam', 'price' => 12000],
            ['name' => 'Delicato Sandwich', 'price' => 18000],
        ]);

        // === MAIN COURSES ===
        $cat = ItemCategory::create(['category_name' => 'Main Courses', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Beef Pilao', 'price' => 18000],
            ['name' => 'Mexican Beef Fajita', 'price' => 18000],
            ['name' => 'Beef Rouladine', 'price' => 20000],
            ['name' => 'Delicato Chicken', 'price' => 50000],
            ['name' => 'Chicken Roulade', 'price' => 15000],
            ['name' => 'Mexican Chicken Fajitas', 'price' => 15000],
            ['name' => 'Escalop De Poulet', 'price' => 15000],
            ['name' => 'Chicken Curry', 'price' => 12000],
            ['name' => 'Chicken Patiala', 'price' => 12000],
            ['name' => 'Chicken Punjabi', 'price' => 12000],
        ]);

        // === FISH ===
        $cat = ItemCategory::create(['category_name' => 'Fish', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Delicato Fish', 'price' => 35000],
            ['name' => 'Fish Fillet', 'price' => 15000],
            ['name' => 'Fish Stew', 'price' => 20000],
        ]);

        // === BEEF ===
        $cat = ItemCategory::create(['category_name' => 'Beef', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Yummy Liver', 'price' => 12000],
            ['name' => 'Salisbury Beef Steak', 'price' => 10000],
            ['name' => 'Meat Ball with Gravy Sauce', 'price' => 10000],
            ['name' => 'Beef Bolognaise', 'price' => 20000],
            ['name' => 'Steak', 'price' => 8000],
        ]);

        // === BROCHETTES ===
        $cat = ItemCategory::create(['category_name' => 'Brochettes', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Beef Brochette', 'desc' => '2 pieces', 'price' => 7000],
            ['name' => 'Goat Brochette', 'desc' => '2 pieces', 'price' => 9000],
            ['name' => 'Chicken Brochette', 'desc' => '2 pieces', 'price' => 10000],
            ['name' => 'Fish Brochette', 'desc' => '2 pieces', 'price' => 6000],
            ['name' => 'Sausage Brochette', 'desc' => '2 pieces', 'price' => 25000],
        ]);

        // === PORK ===
        $cat = ItemCategory::create(['category_name' => 'Pork', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Schnitzel', 'price' => 15000],
            ['name' => 'Pork Chops', 'price' => 18000],
            ['name' => 'Pork Ribs', 'price' => 15000],
        ]);

        // === POTATOES ===
        $cat = ItemCategory::create(['category_name' => 'Potatoes', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'American Fries Potatoes', 'price' => 5000],
            ['name' => 'Potatoes Carbonara', 'price' => 5000],
            ['name' => 'Ground Beef Spicy Potatoes', 'price' => 5000],
            ['name' => 'Home Fries Potatoes', 'price' => 5000],
            ['name' => 'Crown Irish Potatoes', 'price' => 7000],
            ['name' => 'Skillet Potatoes', 'price' => 5000],
            ['name' => 'Regular Chips', 'price' => 4000],
        ]);

        // === RICE ===
        $cat = ItemCategory::create(['category_name' => 'Rice', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Thai Rice', 'price' => 15000],
            ['name' => 'Creole Rice', 'price' => 18000],
            ['name' => 'Singapore Rice', 'price' => 12000],
            ['name' => 'Caribbean Coconut Rice', 'price' => 18000],
            ['name' => 'Mexican Rice', 'price' => 12000],
            ['name' => 'Kung Pao Rice', 'price' => 18000],
            ['name' => 'Chinese Rice', 'price' => 12000],
            ['name' => 'Vegetable Rice', 'price' => 12000],
        ]);

        // === LOCAL FOOD ===
        $cat = ItemCategory::create(['category_name' => 'Local Food', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Fufu', 'desc' => 'Ubugari', 'price' => 12000],
        ]);

        // === SAUCES AND VEGETABLES ===
        $cat = ItemCategory::create(['category_name' => 'Sauces and Vegetables', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Creamy Peppercorn Sauce', 'price' => 3000],
            ['name' => 'Creamy Garlic Sauce', 'price' => 3000],
            ['name' => 'Cream Cheese Steak Sauce', 'price' => 3000],
            ['name' => 'Creamy Mushroom Sauce', 'price' => 3000],
            ['name' => 'Whisky Cream Sauce', 'price' => 3000],
            ['name' => 'Spinach Vegetable', 'price' => 3000],
            ['name' => 'Plate of Vegetable', 'price' => 3000],
            ['name' => 'Greens Vegetable', 'price' => 3000],
        ]);

        // === WRAPS AND QUESADILLAS ===
        $cat = ItemCategory::create(['category_name' => 'Wraps and Quesadillas', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Chicken Quesadilla', 'price' => 15000],
            ['name' => 'Beef Quesadilla', 'price' => 15000],
            ['name' => 'Beef Shawarma', 'price' => 12000],
            ['name' => 'Beef Wrap', 'price' => 10000],
            ['name' => 'Chicken Wrap', 'price' => 12000],
            ['name' => 'Vegetable Wrap', 'price' => 10000],
        ]);

        // === PIZZA ===
        $cat = ItemCategory::create(['category_name' => 'Pizza', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Delicato Pizza', 'price' => 15000],
            ['name' => 'Four Seasons Pizza', 'price' => 15000],
            ['name' => 'Margarita Pizza', 'price' => 10000],
            ['name' => 'Vegetable Pizza', 'price' => 10000],
            ['name' => 'Chicken Pizza', 'price' => 15000],
        ]);

        // === SMOOTHIES ===
        $cat = ItemCategory::create(['category_name' => 'Smoothies', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Mango Smoothie', 'price' => 12000],
            ['name' => 'Banana Smoothie', 'price' => 15000],
            ['name' => 'Customer Choice', 'price' => 35000],
            ['name' => 'Avocado Smoothie', 'price' => 45000],
            ['name' => 'Mixed Smoothie', 'price' => 60000],
        ]);

        // === MILKSHAKES ===
        $cat = ItemCategory::create(['category_name' => 'Milkshakes', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Vanilla Milkshake', 'price' => 65000],
            ['name' => 'Strawberry Milkshake', 'price' => 45000],
            ['name' => 'Chocolate Milkshake', 'price' => 40000],
            ['name' => 'Mango Milkshake', 'price' => 45000],
            ['name' => 'Banana Milkshake', 'price' => 65000],
            ['name' => 'Delicato Milkshake', 'price' => 35000],
            ['name' => 'Tropical Milkshake', 'price' => 70000],
        ]);

        // === COCKTAILS ===
        $cat = ItemCategory::create(['category_name' => 'Cocktails', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Long Island', 'price' => 80000],
            ['name' => 'Mojito', 'price' => 80000],
            ['name' => 'Aperol Spritz', 'price' => 80000],
            ['name' => 'Mimosa', 'price' => 80000],
            ['name' => 'Margarita', 'price' => 80000],
            ['name' => 'Tequila Sunrise', 'price' => 80000],
            ['name' => 'Sex on the Beach', 'price' => 90000],
            ['name' => 'Gin Tonic', 'price' => 100000],
            ['name' => 'Mint Margarita', 'price' => 100000],
            ['name' => 'Adios Mother F', 'price' => 0, 'desc' => 'Ask server for price'],
        ]);

        // === BEERS AND CIDERS ===
        $cat = ItemCategory::create(['category_name' => 'Beers and Ciders', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Bavaria', 'price' => 3000],
            ['name' => 'Heineken', 'price' => 3000],
            ['name' => 'Amstel', 'price' => 4000],
            ['name' => 'Mutzig', 'price' => 4000],
            ['name' => 'Primus', 'price' => 4000],
            ['name' => 'Desperados', 'price' => 4000],
            ['name' => 'Virunga Mist', 'price' => 4000],
            ['name' => 'Virunga Silver', 'price' => 4000],
            ['name' => 'Virunga Gold', 'price' => 4000],
            ['name' => 'Skol Malt', 'price' => 4000],
            ['name' => 'Tusker Malt', 'price' => 2000],
            ['name' => 'Tusker Lager', 'price' => 2000],
            ['name' => 'Stella', 'price' => 2000],
            ['name' => 'Guinness', 'price' => 2000],
            ['name' => 'Heineken 0', 'price' => 2000],
            ['name' => 'Corona', 'price' => 2000],
            ['name' => 'FLO', 'price' => 5000],
            ['name' => 'Budweiser', 'price' => 5000],
            ['name' => 'Savana', 'price' => 4000],
        ]);

        // === SOFT DRINKS ===
        $cat = ItemCategory::create(['category_name' => 'Soft Drinks', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Fanta', 'price' => 5000],
            ['name' => 'Water', 'price' => 5000],
            ['name' => 'Panache', 'price' => 5000],
            ['name' => 'Red Bull', 'price' => 4000],
            ['name' => "Hanson's", 'price' => 4000],
        ]);

        // === JUICES ===
        $cat = ItemCategory::create(['category_name' => 'Juices', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Mango Juice', 'price' => 3500],
            ['name' => 'Pineapple Juice', 'price' => 5000],
            ['name' => 'Passion Juice', 'price' => 1500],
            ['name' => 'Cocktail Juice', 'price' => 1500],
            ['name' => 'Tomato Juice', 'price' => 4000],
        ]);

        // === COFFEE ===
        $cat = ItemCategory::create(['category_name' => 'Coffee', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Cappuccino', 'price' => 4000],
            ['name' => 'Latte Macchiato', 'price' => 2500],
            ['name' => 'Flat White', 'price' => 2500],
            ['name' => 'Hot Chocolate', 'price' => 4000],
            ['name' => 'Espresso', 'price' => 2500],
            ['name' => 'Double Espresso', 'price' => 2500],
            ['name' => 'Americano', 'price' => 5000],
        ]);

        // === DESSERTS ===
        $cat = ItemCategory::create(['category_name' => 'Desserts', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Macedoine Fruits', 'price' => 5500],
            ['name' => 'Plate of Shunks Fruits', 'price' => 6000],
            ['name' => 'Regular Crepe', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Chocolate Crepe', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Honey Crepe', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Regular Chapati', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Chocolate Chapati', 'desc' => '3 pieces', 'price' => 3000],
            ['name' => 'Cake', 'price' => 7000],
            ['name' => 'Ice', 'price' => 8000],
        ]);

        // === RED WINE ===
        $cat = ItemCategory::create(['category_name' => 'Red Wine', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Franschhoek C. Merlot', 'price' => 35000],
            ['name' => 'Franschhoek C. Pinotage Red', 'price' => 40000],
            ['name' => 'Franschhoek Cellar Shiraz Red', 'price' => 45000],
            ['name' => 'Heritades Cotes du Rhone Red', 'price' => 40000],
            ['name' => 'J. Balmont Cabernet Sauvignon Red', 'price' => 45000],
            ['name' => 'JP Chenet Merlot Red', 'price' => 45000],
            ['name' => 'Patriarche Cabernet Sauvignon Red', 'price' => 45000],
            ['name' => 'Patriarche Merlot Red', 'price' => 40000],
            ['name' => 'Lamothe Parrot 1989, France', 'price' => 45000],
            ['name' => 'Franschhoek Cellar', 'price' => 45000],
            ['name' => 'Rero Marone 2023, Italy', 'price' => 45000],
            ['name' => 'Demon Noir 2022, France', 'price' => 40000],
            ['name' => 'Kiwi Cuvee', 'price' => 40000],
            ['name' => 'La Baume', 'price' => 40000],
            ['name' => 'Pinta Negra Rose', 'price' => 35000],
        ]);

        // === WHITE AND ROSE WINE ===
        $cat = ItemCategory::create(['category_name' => 'White and Rose Wine', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'JP Chenet, France, 1984', 'price' => 40000],
            ['name' => 'Pinta Negra San Milonga', 'price' => 40000],
            ['name' => 'Freixenet, Spain', 'price' => 40000],
            ['name' => 'Prosecco Canetelli, Italy', 'price' => 35000],
            ['name' => 'Moscato Rosate', 'price' => 45000],
            ['name' => 'Moscato Dolce', 'price' => 50000],
            ['name' => "Baron D'Arignac", 'price' => 50000],
            ['name' => 'Baron Demi Sec', 'price' => 50000],
            ['name' => "Baron D'Arignac Ice", 'price' => 50000],
            ['name' => 'Nederburg', 'price' => 50000],
            ['name' => 'Jacobs', 'price' => 50000],
            ['name' => 'Pinta Negra 2023, Portugal', 'price' => 50000],
            ['name' => 'Los Molinos 2015, Spain', 'price' => 60000],
            ['name' => 'Villa Blanch', 'price' => 40000],
            ['name' => 'Four Cousins', 'price' => 40000],
            ['name' => 'Grande Vertus', 'price' => 40000],
            ['name' => 'Domaine Bergeron 2023, France', 'price' => 50000],
            ['name' => 'El Chivo Merlot 2023, France', 'price' => 50000],
            ['name' => 'Cabernet Sauvignon 2020, Spain', 'desc' => 'Viña Albali', 'price' => 50000],
            ['name' => 'Belle Emilie 2018, France', 'price' => 60000],
            ['name' => 'Varietals Calvet 2023, France', 'price' => 60000],
        ]);

        // === CHAMPAGNE ===
        $cat = ItemCategory::create(['category_name' => 'Champagne', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Moët Chandon', 'price' => 250000],
            ['name' => 'Moët Chandon Rose', 'price' => 280000],
            ['name' => 'Veuve Clicquot Brut', 'price' => 350000],
            ['name' => 'Veuve Clicquot Rich', 'price' => 300000],
            ['name' => 'Veuve Clicquot Rosé', 'price' => 250000],
            ['name' => 'Dom Pérignon', 'price' => 1500000],
            ['name' => 'Taittinger', 'price' => 300000],
            ['name' => 'Laurent Perrier Brut', 'price' => 150000],
            ['name' => 'Ruinart Blanc de Blanc', 'price' => 700000],
            ['name' => 'Ruinart Brut', 'price' => 600000],
            ['name' => 'Moët Nectar Imperial', 'price' => 250000],
        ]);

        // === RUM ===
        $cat = ItemCategory::create(['category_name' => 'Rum', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Malibu', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Bacardi Black', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Bacardi Gold', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Bacardi White', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Captain Morgan', 'price' => 5000, 'desc' => 'Bottle 90,000 Rwf'],
        ]);

        // === TEQUILA ===
        $cat = ItemCategory::create(['category_name' => 'Tequila', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Clase Azul', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Tequila Olmeca Silver', 'price' => 6000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Tequila Olmeca Gold', 'price' => 5000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Tequila Camino', 'price' => 0, 'desc' => 'Bottle 1,500,000 Rwf — ask server'],
            ['name' => 'Jose Cuervo', 'price' => 6000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Patron Silver', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Don Julio Silver', 'price' => 6000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Don Julio Reposado', 'price' => 6000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Don Julio Blanco', 'price' => 10000, 'desc' => 'Bottle 250,000 Rwf'],
        ]);

        // === GIN ===
        $cat = ItemCategory::create(['category_name' => 'Gin', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => "Hendrick's", 'price' => 15000, 'desc' => 'Bottle 350,000 Rwf'],
            ['name' => 'Roku Gin', 'price' => 14000, 'desc' => 'Bottle 400,000 Rwf'],
            ['name' => 'Bombay Sapphire', 'price' => 12000, 'desc' => 'Bottle 230,000 Rwf'],
            ['name' => 'Bulldog', 'price' => 8000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Beefeater Silver', 'price' => 7000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Beefeater Pink', 'price' => 7000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => "Gordon's", 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Volcano Silver', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Volcano Pink', 'price' => 6000, 'desc' => 'Bottle 120,000 Rwf'],
        ]);

        // === LIQUEURS ===
        $cat = ItemCategory::create(['category_name' => 'Liqueurs', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Amarula', 'price' => 6000, 'desc' => 'Bottle 120,000 Rwf'],
            ['name' => 'Baileys', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
            ['name' => 'Cointreau', 'price' => 10000, 'desc' => 'Bottle 250,000 Rwf'],
            ['name' => 'Jägermeister', 'price' => 8000, 'desc' => 'Bottle 180,000 Rwf'],
            ['name' => 'Kahlua', 'price' => 5000, 'desc' => 'Bottle 80,000 Rwf'],
        ]);

        // === VODKA ===
        $cat = ItemCategory::create(['category_name' => 'Vodka', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Absolut Vodka Citron', 'price' => 10000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Absolut Vodka', 'price' => 15000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Belvedere', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Grey Goose', 'price' => 6000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Cîroc Blue', 'price' => 5000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Absolut Blue', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Absolut Vanilla', 'price' => 8000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Absolut Vodka 1L', 'price' => 0, 'desc' => 'Bottle 200,000 Rwf — ask server'],
            ['name' => 'Belvedere 1L', 'price' => 7000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Mamont North South', 'price' => 7000, 'desc' => 'Bottle 100,000 Rwf'],
        ]);

        // === WHISKY ===
        $cat = ItemCategory::create(['category_name' => 'Whisky', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Jack Daniels', 'price' => 15000, 'desc' => 'Bottle 300,000 Rwf'],
            ['name' => 'Jameson Irish', 'price' => 12000, 'desc' => 'Bottle 220,000 Rwf'],
            ['name' => 'Black Label', 'price' => 15000, 'desc' => 'Bottle 350,000 Rwf'],
            ['name' => 'Double Black', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Chivas 12 Years', 'price' => 6000, 'desc' => 'Bottle 90,000 Rwf'],
            ['name' => 'Dimple Golden', 'price' => 7000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Dimple Golden Selection', 'price' => 8000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Jameson Black Barrel', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Barcelo Imperial', 'price' => 7000, 'desc' => 'Bottle 150,000 Rwf'],
            ['name' => 'Glenlivet 18 Years', 'price' => 7000, 'desc' => 'Bottle 1,200,000 Rwf'],
            ['name' => 'Jack Gentleman', 'price' => 7000, 'desc' => 'Bottle 100,000 Rwf'],
            ['name' => 'Malt', 'price' => 0, 'desc' => 'Bottle 150,000 Rwf — ask server'],
            ['name' => 'Statesman', 'price' => 15000, 'desc' => 'Bottle 350,000 Rwf'],
        ]);

        // === COGNAC ===
        $cat = ItemCategory::create(['category_name' => 'Cognac', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat->id, $branchId, $defaultKotId, [
            ['name' => 'Hennessy VS', 'price' => 10000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Hennessy VSOP', 'price' => 12000, 'desc' => 'Bottle 200,000 Rwf'],
            ['name' => 'Rémy Martin VSOP', 'price' => 12000, 'desc' => 'Bottle 320,000 Rwf'],
            ['name' => 'Hennessy XO', 'price' => 10000, 'desc' => 'Bottle 250,000 Rwf'],
            ['name' => 'Martell XO', 'price' => 15000, 'desc' => 'Bottle 350,000 Rwf'],
            ['name' => 'Rémy Martin XO', 'price' => 15000, 'desc' => 'Bottle 350,000 Rwf'],
            ['name' => 'Courvoisier VSOP', 'price' => 12000, 'desc' => 'Bottle 300,000 Rwf'],
            ['name' => 'Meukow VSOP', 'price' => 0, 'desc' => 'Bottle 900,000 Rwf — ask server'],
            ['name' => 'Martell VSOP', 'price' => 0, 'desc' => 'Bottle 800,000 Rwf — ask server'],
        ]);
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
                'price' => (float) $item['price'],
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
        $this->line('    ✓ ' . count($rows) . ' items in "' . ItemCategory::find($categoryId)->category_name . '"');
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
            'name' => 'Delicato Admin',
            'email' => 'admin@delicato.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
        ]);
        $admin->assignRole('Admin_' . $restaurant->id);

        $waiter = User::create([
            'name' => 'Delicato Waiter',
            'email' => 'waiter@delicato.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
            'branch_id' => $branch->id,
        ]);
        $waiter->assignRole('Waiter_' . $restaurant->id);

        $this->info('    Admin: admin@delicato.rw / 123456');
        $this->info('    Waiter: waiter@delicato.rw / 123456');
    }
}
