<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ItemCategory;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DelicatoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating Delicato restaurant profile...');

        // Find Rwanda country or use first
        $country = DB::table('countries')->where('countries_name', 'Rwanda')->first()
            ?? DB::table('countries')->first();

        // Find RWF currency
        $currency = DB::table('global_currencies')->where('currency_code', 'RWF')->first()
            ?? DB::table('global_currencies')->first();

        // Find default package
        $package = DB::table('packages')->where('package_name', 'Starter')->first()
            ?? DB::table('packages')->where('is_free', 1)->first();

        if (!$country || !$currency || !$package) {
            $this->command->error('Missing required setup (country, currency, package). Run other seeders first.');
            return;
        }

        // --- Create Restaurant ---
        $restaurant = Restaurant::create([
            'name' => 'Delicato',
            'address' => 'Kigali, Rwanda',
            'phone_number' => '+250780000000',
            'email' => 'info@delicato.rw',
            'country_id' => $country->id ?? 1,
            'currency_id' => $currency->id ?? 1,
            'package_id' => $package->id,
            'package_type' => 'monthly',
            'timezone' => 'Africa/Kigali',
            'theme_hex' => '#002522',
            'theme_rgb' => '0, 37, 34',
            'about_us' => 'Welcome to Delicato — a fine dining experience in the heart of Kigali.',
            'customer_site_language' => 'en',
            'is_active' => true,
        ]);

        // Generate hash for the restaurant
        $restaurant->update(['hash' => substr(hash('sha256', 'delicato-' . time()), 0, 20)]);

// --- Create Branch ---
        $branch = Branch::create([
            'restaurant_id' => $restaurant->id,
            'name' => 'Delicato Main',
            'address' => 'Kigali, Rwanda',
            'unique_hash' => \Illuminate\Support\Str::random(12),
        ]);

        // --- Create Menu ---
        $menu = Menu::create([
            'menu_name' => 'Delicato Menu',
            'branch_id' => $branch->id,
        ]);

        // --- Define categories ---
        $categories = [
            'Breakfast', 'Tea', 'Salads', 'Starters', 'Soups', 'Pasta', 'Burgers', 'Sandwiches',
            'Main Courses', 'Fish', 'Beef', 'Brochettes', 'Pork', 'Potatoes', 'Rice', 'Local Food',
            'Sauces and Vegetables', 'Wraps and Quesadillas', 'Pizza', 'Smoothies', 'Milkshakes',
            'Cocktails', 'Beers and Ciders', 'Soft Drinks', 'Juices', 'Coffee', 'Desserts',
            'Red Wine', 'White and Rose Wine', 'Champagne', 'Rum', 'Tequila', 'Gin', 'Liqueurs', 'Vodka', 'Whisky', 'Cognac'
        ];

        $itemCategories = [];
        foreach ($categories as $cat) {
            $ic = ItemCategory::create([
                'category_name' => $cat,
                'branch_id' => $branch->id,
            ]);
            $itemCategories[$cat] = $ic->id;
        }

        // --- Define menu items ---
        $items = [
            'Breakfast' => [
                ['name' => 'Full American Breakfast', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Fritata Italian', 'price' => 7000, 'type' => 'egg'],
                ['name' => 'American Denver Omelete', 'price' => 8000, 'type' => 'egg'],
                ['name' => 'Mushroom and Spinach Omelete', 'price' => 4000, 'type' => 'egg'],
                ['name' => 'Scrambled Egg', 'price' => 3000, 'type' => 'egg'],
                ['name' => 'Spanish Omelete', 'price' => 3000, 'type' => 'egg'],
                ['name' => 'Special Omelete', 'price' => 4000, 'type' => 'egg'],
                ['name' => 'Vegetable Omelete', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Regular Omelete', 'price' => 2000, 'type' => 'egg'],
                ['name' => 'Burrito', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Delicato Omelete', 'price' => 10000, 'type' => 'egg'],
            ],
            'Tea' => [
                ['name' => 'Hot Chocolate Tea', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Ginger Lemon Tea', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'African Tea', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Black Tea', 'price' => 7000, 'type' => 'veg'],
                ['name' => 'Spice Tea', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Green Tea', 'price' => 15000, 'type' => 'veg'],
            ],
            'Salads' => [
                ['name' => 'Oriental Salad', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Avocado Vinaigrette', 'price' => 10000, 'type' => 'veg'],
                ['name' => 'Nicoise Salad', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Mexican Salad', 'price' => 10000, 'type' => 'veg'],
            ],
            'Starters' => [
                ['name' => 'Beef Samosa', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Chicken Samosa', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Vegetable Samosa', 'price' => 3000, 'type' => 'veg'],
            ],
            'Soups' => [
                ['name' => 'American Zuppa Tuscana', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'American Lentil Soup', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Ginger Carrot Soup', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Vegetable Soup', 'price' => 15000, 'type' => 'veg'],
            ],
            'Pasta' => [
                ['name' => 'Mexican Spaghetti Verde', 'price' => 10000, 'type' => 'veg'],
                ['name' => 'Beef Chow Mein', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Chicken Chow Mein', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Mexican Cheesy Spaghetti', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Italian Bucatini Pasta', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Spaghetti Alla Gricia', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Spaghetti Al Pomodoro', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Spaghetti Bolognaise', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Spaghetti Carbonara', 'price' => 15000, 'type' => 'non-veg'],
            ],
            'Burgers' => [
                ['name' => 'British Pub Burger', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'American Smash Burger', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Chicken Cheese Taco Burger', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Bacon Burger', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Delicato Beef Burger', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Delicato Chicken Burger', 'price' => 18000, 'type' => 'non-veg'],
            ],
            'Sandwiches' => [
                ['name' => 'Bacon Sandwich', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Vegetable Sandwich', 'price' => 10000, 'type' => 'veg'],
                ['name' => 'Club Sandwich', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Croque Monsieur', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Croque Madam', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Delicato Sandwich', 'price' => 18000, 'type' => 'non-veg'],
            ],
            'Main Courses' => [
                ['name' => 'Beef Pilao', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Mexican Beef Fajita', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Beef Rouladine', 'price' => 20000, 'type' => 'non-veg'],
                ['name' => 'Delicato Chicken', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Chicken Roulade', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Mexican Chicken Fajitas', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Escalop De Poulet', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Chicken Curry', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Chicken Patiala', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Chicken Punjabi', 'price' => 12000, 'type' => 'non-veg'],
            ],
            'Fish' => [
                ['name' => 'Delicato Fish', 'price' => 35000, 'type' => 'non-veg'],
                ['name' => 'Fish Fillet', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Fish Stew', 'price' => 20000, 'type' => 'non-veg'],
            ],
            'Beef' => [
                ['name' => 'Yummy Liver', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Salisbury Beef Steak', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Meat Ball with Gravy Sauce', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Beef Bolognaise', 'price' => 20000, 'type' => 'non-veg'],
                ['name' => 'Steak', 'price' => 8000, 'type' => 'non-veg'],
            ],
            'Brochettes' => [
                ['name' => 'Beef Brochette', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Goat Brochette', 'price' => 9000, 'type' => 'non-veg'],
                ['name' => 'Chicken Brochette', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Fish Brochette', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Sausage Brochette', 'price' => 25000, 'type' => 'non-veg'],
            ],
            'Pork' => [
                ['name' => 'Schnitzel', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Pork Chops', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Pork Ribs', 'price' => 15000, 'type' => 'non-veg'],
            ],
            'Potatoes' => [
                ['name' => 'American Fries Potatoes', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Potatoes Carbonara', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Ground Beef Spicy Potatoes', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Home Fries Potatoes', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Crown Irish Potatoes', 'price' => 7000, 'type' => 'veg'],
                ['name' => 'Skillet Potatoes', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Regular Chips', 'price' => 4000, 'type' => 'veg'],
            ],
            'Rice' => [
                ['name' => 'Thai Rice', 'price' => 15000, 'type' => 'veg'],
                ['name' => 'Creole Rice', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Singapore Rice', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Caribbean Coconut Rice', 'price' => 18000, 'type' => 'veg'],
                ['name' => 'Mexican Rice', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Kung Pao Rice', 'price' => 18000, 'type' => 'non-veg'],
                ['name' => 'Chinese Rice', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Vegetable Rice', 'price' => 12000, 'type' => 'veg'],
            ],
            'Local Food' => [
                ['name' => 'Fufu', 'description' => 'Ubugari', 'price' => 12000, 'type' => 'veg'],
            ],
            'Sauces and Vegetables' => [
                ['name' => 'Creamy Peppercorn Sauce', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Creamy Garlic Sauce', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Cream Cheese Steak Sauce', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Creamy Mushroom Sauce', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Whisky Cream Sauce', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Spinach Vegetable', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Plate of Vegetable', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Greens Vegetable', 'price' => 3000, 'type' => 'veg'],
            ],
            'Wraps and Quesadillas' => [
                ['name' => 'Chicken Quesadilla', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Beef Quesadilla', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Beef Shawarma', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Beef Wrap', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Chicken Wrap', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Vegetable Wrap', 'price' => 10000, 'type' => 'veg'],
            ],
            'Pizza' => [
                ['name' => 'Delicato Pizza', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Four Seasons Pizza', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Margarita Pizza', 'price' => 10000, 'type' => 'veg'],
                ['name' => 'Vegetable Pizza', 'price' => 10000, 'type' => 'veg'],
                ['name' => 'Chicken Pizza', 'price' => 15000, 'type' => 'non-veg'],
            ],
            'Smoothies' => [
                ['name' => 'Mango Smoothie', 'price' => 12000, 'type' => 'veg'],
                ['name' => 'Banana Smoothie', 'price' => 15000, 'type' => 'veg'],
                ['name' => 'Customer Choice', 'price' => 35000, 'type' => 'veg'],
                ['name' => 'Avocado Smoothie', 'price' => 45000, 'type' => 'veg'],
                ['name' => 'Mixed Smoothie', 'price' => 60000, 'type' => 'veg'],
            ],
            'Milkshakes' => [
                ['name' => 'Vanilla Milkshake', 'price' => 65000, 'type' => 'non-veg'],
                ['name' => 'Strawberry Milkshake', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Chocolate Milkshake', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Mango Milkshake', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Banana Milkshake', 'price' => 65000, 'type' => 'non-veg'],
                ['name' => 'Delicato Milkshake', 'price' => 35000, 'type' => 'non-veg'],
                ['name' => 'Tropical Milkshake', 'price' => 70000, 'type' => 'non-veg'],
            ],
            'Cocktails' => [
                ['name' => 'Long Island', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Mojito', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Aperol Spritz', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Mimosa', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Margarita', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Tequila Sunrise', 'price' => 80000, 'type' => 'non-veg'],
                ['name' => 'Sex on the Beach', 'price' => 90000, 'type' => 'non-veg'],
                ['name' => 'Gin Tonic', 'price' => 100000, 'type' => 'non-veg'],
                ['name' => 'Mint Margarita', 'price' => 100000, 'type' => 'non-veg'],
                ['name' => 'Adios Mother F', 'price' => null, 'type' => 'non-veg'],
            ],
            'Beers and Ciders' => [
                ['name' => 'Bavaria', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Heineken', 'price' => 3000, 'type' => 'non-veg'],
                ['name' => 'Amstel', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Mutzig', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Primus', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Desperados', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Virunga Mist', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Virunga Silver', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Virunga Gold', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Skol Malt', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Tusker Malt', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'Tusker Lager', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'Stella', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'Guinness', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'Heineken 0', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'Corona', 'price' => 2000, 'type' => 'non-veg'],
                ['name' => 'FLO', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Budweiser', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Savana', 'price' => 4000, 'type' => 'non-veg'],
            ],
            'Soft Drinks' => [
                ['name' => 'Fanta', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Water', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Panache', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Red Bull', 'price' => 4000, 'type' => 'veg'],
                ['name' => "Hanson's", 'price' => 4000, 'type' => 'veg'],
            ],
            'Juices' => [
                ['name' => 'Mango Juice', 'price' => 3500, 'type' => 'veg'],
                ['name' => 'Pineapple Juice', 'price' => 5000, 'type' => 'veg'],
                ['name' => 'Passion Juice', 'price' => 1500, 'type' => 'veg'],
                ['name' => 'Cocktail Juice', 'price' => 1500, 'type' => 'veg'],
                ['name' => 'Tomato Juice', 'price' => 4000, 'type' => 'veg'],
            ],
            'Coffee' => [
                ['name' => 'Cappuccino', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Latte Macchiato', 'price' => 2500, 'type' => 'non-veg'],
                ['name' => 'Flat White', 'price' => 2500, 'type' => 'non-veg'],
                ['name' => 'Hot Chocolate', 'price' => 4000, 'type' => 'non-veg'],
                ['name' => 'Espresso', 'price' => 2500, 'type' => 'non-veg'],
                ['name' => 'Double Espresso', 'price' => 2500, 'type' => 'non-veg'],
                ['name' => 'Americano', 'price' => 5000, 'type' => 'non-veg'],
            ],
            'Desserts' => [
                ['name' => 'Macedoine Fruits', 'price' => 5500, 'type' => 'veg'],
                ['name' => 'Plate of Shunks Fruits', 'price' => 6000, 'type' => 'veg'],
                ['name' => 'Regular Crepe', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Chocolate Crepe', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Honey Crepe', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Regular Chapati', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Chocolate Chapati', 'price' => 3000, 'type' => 'veg'],
                ['name' => 'Cake', 'price' => 7000, 'type' => 'veg'],
                ['name' => 'Ice', 'price' => 8000, 'type' => 'veg'],
            ],
            'Red Wine' => [
                ['name' => 'Franschhoek C. Merlot', 'price' => 35000, 'type' => 'non-veg'],
                ['name' => 'Franschhoek C. Pinotage Red', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Franschhoek Cellar Shiraz Red', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Heritades Cotes du Rhone Red', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'J. Balmont Cabernet Sauvignon Red', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'JP Chenet Merlot Red', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Patriarche Cabernet Sauvignon Red', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Patriarche Merlot Red', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Lamothe Parrot 1989, France', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Franschhoek Cellar', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Rero Marone 2023, Italy', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Demon Noir 2022, France', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Kiwi Cuvee', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'La Baume', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Pinta Negra Rose', 'price' => 35000, 'type' => 'non-veg'],
            ],
            'White and Rose Wine' => [
                ['name' => 'JP Chenet, France, 1984', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Pinta Negra San Milonga', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Freixenet, Spain', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Prosecco Canetelli, Italy', 'price' => 35000, 'type' => 'non-veg'],
                ['name' => 'Moscato Rosate', 'price' => 45000, 'type' => 'non-veg'],
                ['name' => 'Moscato Dolce', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Baron D\'Arignac', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Baron Demi Sec', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Baron D\'Arignac Ice', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Nederburg', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Jacobs', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Pinta Negra 2023, Portugal', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Los Molinos 2015, Spain', 'price' => 60000, 'type' => 'non-veg'],
                ['name' => 'Villa Blanch', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Four Cousins', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Grande Vertus', 'price' => 40000, 'type' => 'non-veg'],
                ['name' => 'Domaine Bergeron 2023, France', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'El Chivo Merlot 2023, France', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Cabernet Sauvignon 2020, Spain', 'price' => 50000, 'type' => 'non-veg'],
                ['name' => 'Belle Emilie 2018, France', 'price' => 60000, 'type' => 'non-veg'],
                ['name' => 'Varietals Calvet 2023, France', 'price' => 60000, 'type' => 'non-veg'],
            ],
            'Champagne' => [
                ['name' => 'Moët Chandon', 'price' => 250000, 'type' => 'non-veg'],
                ['name' => 'Moët Chandon Rose', 'price' => 280000, 'type' => 'non-veg'],
                ['name' => 'Veuve Clicquot Brut', 'price' => 350000, 'type' => 'non-veg'],
                ['name' => 'Veuve Clicquot Rich', 'price' => 300000, 'type' => 'non-veg'],
                ['name' => 'Veuve Clicquot Rosé', 'price' => 250000, 'type' => 'non-veg'],
                ['name' => 'Dom Pérignon', 'price' => 1500000, 'type' => 'non-veg'],
                ['name' => 'Taittinger', 'price' => 300000, 'type' => 'non-veg'],
                ['name' => 'Laurent Perrier Brut', 'price' => 150000, 'type' => 'non-veg'],
                ['name' => 'Ruinart Blanc de Blanc', 'price' => 700000, 'type' => 'non-veg'],
                ['name' => 'Ruinart Brut', 'price' => 600000, 'type' => 'non-veg'],
                ['name' => 'Moët Nectar Imperial', 'price' => 250000, 'type' => 'non-veg'],
            ],
            'Rum' => [
                ['name' => 'Malibu', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Bacardi Black', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Bacardi Gold', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Bacardi White', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Captain Morgan', 'price' => 5000, 'type' => 'non-veg'],
            ],
            'Tequila' => [
                ['name' => 'Clase Azul', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Tequila Olmeca Silver', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Tequila Olmeca Gold', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Tequila Camino', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Jose Cuervo', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Patron Silver', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Don Julio Silver', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Don Julio Reposado', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Don Julio Blanco', 'price' => 10000, 'type' => 'non-veg'],
            ],
            'Gin' => [
                ['name' => "Hendrick's", 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Roku Gin', 'price' => 14000, 'type' => 'non-veg'],
                ['name' => 'Bombay Sapphire', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Bulldog', 'price' => 8000, 'type' => 'non-veg'],
                ['name' => 'Beefeater Silver', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Beefeater Pink', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Gordon\'s', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Volcano Silver', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Volcano Pink', 'price' => 6000, 'type' => 'non-veg'],
            ],
            'Liqueurs' => [
                ['name' => 'Amarula', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Baileys', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Cointreau', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Jägermeister', 'price' => 8000, 'type' => 'non-veg'],
                ['name' => 'Kahlua', 'price' => 5000, 'type' => 'non-veg'],
            ],
            'Vodka' => [
                ['name' => 'Absolut Vodka Citron', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Absolut Vodka', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Belvedere', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Grey Goose', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Cîroc Blue', 'price' => 5000, 'type' => 'non-veg'],
                ['name' => 'Absolut Blue', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Absolut Vanilla', 'price' => 8000, 'type' => 'non-veg'],
                ['name' => 'Absolut Vodka', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Belvedere 1L', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Mamont North South', 'price' => 7000, 'type' => 'non-veg'],
            ],
            'Whisky' => [
                ['name' => 'Jack Daniels', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Jameson Irish', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Black Label', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Double Black', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Chivas 12 Years', 'price' => 6000, 'type' => 'non-veg'],
                ['name' => 'Dimple Golden', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Dimple Golden Selection', 'price' => 8000, 'type' => 'non-veg'],
                ['name' => 'Jameson Black Barrel', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Barcelo Imperial', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Glenlivet 18 Years', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Jack Gentleman', 'price' => 7000, 'type' => 'non-veg'],
                ['name' => 'Malt', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Statesman', 'price' => 15000, 'type' => 'non-veg'],
            ],
            'Cognac' => [
                ['name' => 'Hennessy VS', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Hennessy VSOP', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Martell VSOP', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Rémy Martin VSOP', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Hennessy XO', 'price' => 10000, 'type' => 'non-veg'],
                ['name' => 'Martell XO', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Rémy Martin XO', 'price' => 15000, 'type' => 'non-veg'],
                ['name' => 'Courvoisier VSOP', 'price' => 12000, 'type' => 'non-veg'],
                ['name' => 'Meukow VSOP', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Martell XO', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Martell VSOP', 'price' => null, 'type' => 'non-veg'],
                ['name' => 'Courvoisier VSOP', 'price' => null, 'type' => 'non-veg'],
            ],
        ];

        // --- Insert menu items ---
        $insertData = [];
        foreach ($items as $categoryName => $categoryItems) {
            $catId = $itemCategories[$categoryName] ?? null;
            if (!$catId) {
                $this->command->warn("Category not found: $categoryName");
                continue;
            }

            foreach ($categoryItems as $item) {
                $insertData[] = [
                    'menu_id' => $menu->id,
                    'item_category_id' => $catId,
                    'item_name' => $item['name'],
                    'price' => $item['price'],
                    'description' => $item['description'] ?? null,
                    'type' => $item['type'] ?? 'non-veg',
                    'is_available' => true,
                    'show_on_customer_site' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Batch insert in chunks
        $chunks = array_chunk($insertData, 500);
        foreach ($chunks as $chunk) {
            DB::table('menu_items')->insert($chunk);
        }

        $this->command->info("Delicato created successfully!");
        $this->command->info("- Restaurant ID: {$restaurant->id}");
        $this->command->info("- Branch ID: {$branch->id}");
        $this->command->info("- Menu ID: {$menu->id}");
        $this->command->info("- Categories: " . count($categories));
        $this->command->info("- Menu items: " . count($insertData));
    }
}
