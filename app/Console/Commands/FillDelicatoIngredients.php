<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use Illuminate\Console\Command;

class FillDelicatoIngredients extends Command
{
    protected $signature = 'hyamii:fill-delicato-ingredients';
    protected $description = 'Fill ingredients for DELICATO menu items (kitchen-prepared items only; commercial drinks skipped).';

    /**
     * item_name => ingredients list
     */
    private array $ingredients = [
        // === BREAKFAST ===
        'Full American Breakfast' => '2 eggs, bacon, sausage, baked beans, toast, hash browns',
        'Fritata Italian' => 'Eggs, tomatoes, onions, bell peppers, parmesan',
        'American Denver Omelete' => 'Eggs, ham, bell peppers, onions, cheddar',
        'Mushroom and Spinach Omelete' => 'Eggs, mushrooms, spinach, cheese',
        'Scrambled Egg' => 'Eggs, butter, milk, salt',
        'Spanish Omelete' => 'Eggs, potatoes, onions, olive oil',
        'Special Omelete' => 'Eggs, ham, cheese, mushrooms, tomatoes',
        'Vegetable Omelete' => 'Eggs, tomatoes, onions, bell peppers, greens',
        'Regular Omelete' => 'Eggs, butter, salt',
        'Burrito' => 'Flour tortilla, scrambled eggs, beans, cheese, salsa',
        'Delicato Omelete' => 'Eggs, cheese, ham, mushrooms, onions, herbs',

        // === TEA ===
        'Hot Chocolate Tea' => 'Cocoa, milk, sugar',
        'Ginger Lemon Tea' => 'Fresh ginger, lemon, honey, black tea',
        'African Tea' => 'Milk, ginger, tea leaves, sugar',
        'Black Tea' => 'Black tea leaves, water, sugar (optional)',
        'Spice Tea' => 'Tea leaves, cinnamon, cardamom, cloves, ginger, milk',
        'Green Tea' => 'Green tea leaves, water, honey (optional)',

        // === SALADS ===
        'Oriental Salad' => 'Lettuce, cabbage, carrots, bell peppers, sesame-soy dressing',
        'Avocado Vinaigrette' => 'Avocado, lettuce, tomatoes, vinaigrette dressing',
        'Nicoise Salad' => 'Tuna, egg, green beans, potatoes, olives, lettuce',
        'Mexican Salad' => 'Lettuce, beans, corn, tomatoes, cheese, tortilla strips, salsa dressing',

        // === STARTERS ===
        'Beef Samosa' => 'Wheat pastry, minced beef, onions, carrots, spices',
        'Chicken Samosa' => 'Wheat pastry, minced chicken, onions, herbs, spices',
        'Vegetable Samosa' => 'Wheat pastry, potatoes, peas, carrots, spices',

        // === SOUPS ===
        'American Zuppa Tuscana' => 'Sausage, potatoes, kale, cream, garlic, chicken broth',
        'American Lentil Soup' => 'Lentils, carrots, onions, celery, tomatoes, cumin',
        'Ginger Carrot Soup' => 'Carrots, fresh ginger, onion, cream, vegetable stock',
        'Vegetable Soup' => 'Mixed vegetables, tomatoes, potatoes, herbs, stock',

        // === PASTA ===
        'Mexican Spaghetti Verde' => 'Spaghetti, green salsa (tomatillo), cream, cheese',
        'Beef Chow Mein' => 'Noodles, beef strips, cabbage, carrots, bell peppers, soy sauce',
        'Chicken Chow Mein' => 'Noodles, chicken strips, cabbage, carrots, soy sauce',
        'Mexican Cheesy Spaghetti' => 'Spaghetti, cheddar, cream, tomatoes, mild spices',
        'Italian Bucatini Pasta' => 'Bucatini, tomatoes, guanciale, pecorino, garlic',
        'Spaghetti Alla Gricia' => 'Spaghetti, guanciale, pecorino romano, black pepper',
        'Spaghetti Al Pomodoro' => 'Spaghetti, fresh tomatoes, basil, garlic, olive oil',
        'Spaghetti Bolognaise' => 'Spaghetti, minced beef, tomatoes, onions, carrots, herbs',
        'Spaghetti Carbonara' => 'Spaghetti, eggs, guanciale/bacon, pecorino, black pepper',

        // === BURGERS ===
        'British Pub Burger' => 'Beef patty, cheddar, bacon, lettuce, tomato, onion, pickles, burger bun',
        'American Smash Burger' => 'Smashed beef patty, cheese, onions, pickles, special sauce, burger bun',
        'Chicken Cheese Taco Burger' => 'Chicken patty, cheese, taco seasoning, salsa, burger bun',
        'Bacon Burger' => 'Beef patty, bacon, cheese, lettuce, tomato, burger bun',
        'Delicato Beef Burger' => 'Beef patty, cheese, caramelized onions, lettuce, tomato, house sauce, burger bun',
        'Delicato Chicken Burger' => 'Chicken fillet, cheese, lettuce, mayo, burger bun',

        // === SANDWICHES ===
        'Bacon Sandwich' => 'Bacon, buttered toast, tomato (optional)',
        'Vegetable Sandwich' => 'Mixed vegetables, cheese, lettuce, tomato, sandwich bread',
        'Club Sandwich' => 'Chicken, bacon, egg, lettuce, tomato, mayo, triple-decker toast',
        'Croque Monsieur' => 'Ham, gruyère/cheese, béchamel, bread',
        'Croque Madam' => 'Ham, cheese, béchamel, bread, fried egg',
        'Delicato Sandwich' => 'House fillings: ham, cheese, egg, vegetables, house sauce',

        // === MAIN COURSES ===
        'Beef Pilao' => 'Rice, beef, onions, tomatoes, pilau spices, stock',
        'Mexican Beef Fajita' => 'Beef strips, bell peppers, onions, tortillas, fajita spices',
        'Beef Rouladine' => 'Beef roulade, stuffing (herbs, cheese/bread), gravy',
        'Delicato Chicken' => 'Whole chicken, house marinade, herbs, sides',
        'Chicken Roulade' => 'Chicken breast, stuffing, cheese, herbs, sauce',
        'Mexican Chicken Fajitas' => 'Chicken strips, bell peppers, onions, tortillas, fajita spices',
        'Escalop De Poulet' => 'Breaded chicken breast, butter, lemon, herbs',
        'Chicken Curry' => 'Chicken, curry spices, onions, tomatoes, cream, rice or bread',
        'Chicken Patiala' => 'Chicken, onions, tomatoes, yogurt, Punjabi spices, cream',
        'Chicken Punjabi' => 'Chicken, tomatoes, onions, ginger-garlic, Punjabi spices',

        // === FISH ===
        'Delicato Fish' => 'Whole fish, house marinade, lemon, herbs, sides',
        'Fish Fillet' => 'Fish fillet, butter, lemon, herbs, sides',
        'Fish Stew' => 'Fish pieces, tomatoes, onions, bell peppers, spices, stock',

        // === BEEF ===
        'Yummy Liver' => 'Beef liver, onions, tomatoes, spices, sides',
        'Salisbury Beef Steak' => 'Minced beef steak, mushroom gravy, onions, sides',
        'Meat Ball with Gravy Sauce' => 'Minced beef meatballs, tomato gravy, herbs, sides',
        'Beef Bolognaise' => 'Minced beef, tomatoes, onions, carrots, red wine, herbs, pasta',
        'Steak' => 'Beef steak, butter, pepper, sides',

        // === BROCHETTES ===
        'Beef Brochette' => 'Cubed beef, onions, bell peppers, spices',
        'Goat Brochette' => 'Cubed goat meat, onions, bell peppers, spices',
        'Chicken Brochette' => 'Cubed chicken, onions, bell peppers, spices',
        'Fish Brochette' => 'Cubed fish, onions, bell peppers, spices',
        'Sausage Brochette' => 'Sausages, onions, bell peppers, spices',

        // === PORK ===
        'Schnitzel' => 'Breaded pork cutlet, eggs, flour, breadcrumbs, lemon',
        'Pork Chops' => 'Pork chops, salt, pepper, herbs, pan sauce',
        'Pork Ribs' => 'Pork ribs, BBQ glaze, spices, slow-cooked',

        // === POTATOES ===
        'American Fries Potatoes' => 'Potatoes, oil, salt',
        'Potatoes Carbonara' => 'Potatoes, bacon, eggs, parmesan, black pepper',
        'Ground Beef Spicy Potatoes' => 'Potatoes, minced beef, chili, onions, spices',
        'Home Fries Potatoes' => 'Potatoes, onions, paprika, oil',
        'Crown Irish Potatoes' => 'Potatoes, butter, herbs, salt',
        'Skillet Potatoes' => 'Potatoes, butter, onions, seasoning',
        'Regular Chips' => 'Potatoes, oil, salt',

        // === RICE ===
        'Thai Rice' => 'Jasmine rice, vegetables, soy sauce, Thai spices, egg (optional)',
        'Creole Rice' => 'Rice, tomatoes, bell peppers, celery, creole spices',
        'Singapore Rice' => 'Rice, chicken/shrimp, curry powder, vegetables, egg',
        'Caribbean Coconut Rice' => 'Rice, coconut milk, beans, Caribbean spices',
        'Mexican Rice' => 'Rice, tomatoes, onions, garlic, cumin',
        'Kung Pao Rice' => 'Rice, chicken, peanuts, dried chilies, soy sauce, vegetables',
        'Chinese Rice' => 'Rice, vegetables, egg, soy sauce',
        'Vegetable Rice' => 'Rice, mixed vegetables, butter, herbs',

        // === LOCAL FOOD ===
        'Fufu' => 'Cassava/maize flour (ugali/ubugari), water, salt — served with soup of the day',

        // === SAUCES AND VEGETABLES ===
        'Creamy Peppercorn Sauce' => 'Cream, black peppercorns, butter, stock',
        'Creamy Garlic Sauce' => 'Cream, garlic, butter, parmesan',
        'Cream Cheese Steak Sauce' => 'Cream cheese, cream, garlic, herbs',
        'Creamy Mushroom Sauce' => 'Mushrooms, cream, garlic, butter',
        'Whisky Cream Sauce' => 'Whisky, cream, shallots, stock, butter',
        'Spinach Vegetable' => 'Fresh spinach, garlic, onions, cream (optional)',
        'Plate of Vegetable' => 'Seasonal mixed vegetables, butter, herbs',
        'Greens Vegetable' => 'Leafy greens (dodo/spinach), onions, tomatoes, spices',

        // === WRAPS AND QUESADILLAS ===
        'Chicken Quesadilla' => 'Tortilla, chicken, cheese, bell peppers, onions',
        'Beef Quesadilla' => 'Tortilla, minced beef, cheese, bell peppers, onions',
        'Beef Shawarma' => 'Flatbread, marinated beef, garlic sauce, pickles, vegetables',
        'Beef Wrap' => 'Tortilla, beef strips, vegetables, house sauce',
        'Chicken Wrap' => 'Tortilla, chicken strips, vegetables, house sauce',
        'Vegetable Wrap' => 'Tortilla, grilled vegetables, cheese, house sauce',

        // === PIZZA ===
        'Delicato Pizza' => 'Pizza dough, tomato sauce, mozzarella, ham, mushrooms, olives',
        'Four Seasons Pizza' => 'Pizza dough, tomato sauce, mozzarella, ham, mushrooms, artichokes, olives',
        'Margarita Pizza' => 'Pizza dough, tomato sauce, mozzarella, fresh basil',
        'Vegetable Pizza' => 'Pizza dough, tomato sauce, mozzarella, mixed vegetables',
        'Chicken Pizza' => 'Pizza dough, tomato sauce, mozzarella, chicken, bell peppers',

        // === SMOOTHIES ===
        'Mango Smoothie' => 'Mango, milk, yogurt, honey, ice',
        'Banana Smoothie' => 'Banana, milk, yogurt, honey, ice',
        'Customer Choice' => 'Your choice of seasonal fruits, milk or yogurt, honey, ice',
        'Avocado Smoothie' => 'Avocado, milk, honey, ice',
        'Mixed Smoothie' => 'Assorted fruits (mango, banana, avocado, pineapple), milk, honey, ice',

        // === MILKSHAKES ===
        'Vanilla Milkshake' => 'Vanilla ice cream, milk, vanilla syrup, whipped cream',
        'Strawberry Milkshake' => 'Strawberry ice cream, milk, strawberries, whipped cream',
        'Chocolate Milkshake' => 'Chocolate ice cream, milk, chocolate syrup, whipped cream',
        'Mango Milkshake' => 'Mango, milk, vanilla ice cream, honey',
        'Banana Milkshake' => 'Banana, milk, vanilla ice cream, honey',
        'Delicato Milkshake' => 'House blend: ice cream, milk, seasonal fruits, honey',
        'Tropical Milkshake' => 'Pineapple, mango, banana, coconut milk, ice cream',

        // === COCKTAILS ===
        'Long Island' => 'Vodka, gin, rum, tequila, triple sec, lemon, cola',
        'Mojito' => 'White rum, lime, mint, sugar, soda water',
        'Aperol Spritz' => 'Aperol, prosecco, soda water, orange slice',
        'Mimosa' => 'Champagne, orange juice',
        'Margarita' => 'Tequila, triple sec, lime, salt rim',
        'Tequila Sunrise' => 'Tequila, orange juice, grenadine',
        'Sex on the Beach' => 'Vodka, peach schnapps, orange juice, cranberry juice',
        'Gin Tonic' => 'Gin, tonic water, lime',
        'Mint Margarita' => 'Tequila, triple sec, lime, fresh mint, salt rim',
        'Adios Mother F' => 'Vodka, gin, rum, tequila, blue curaçao, lemon-lime soda',

        // === JUICES ===
        'Mango Juice' => 'Fresh mango, water, sugar (optional)',
        'Pineapple Juice' => 'Fresh pineapple, water, sugar (optional)',
        'Passion Juice' => 'Fresh passion fruit, water, sugar (optional)',
        'Cocktail Juice' => 'Assorted fruits (mango, pineapple, passion), water, sugar',
        'Tomato Juice' => 'Fresh tomatoes, salt, celery salt (optional)',

        // === COFFEE ===
        'Cappuccino' => 'Espresso, steamed milk, milk foam',
        'Latte Macchiato' => 'Espresso, steamed milk, light foam',
        'Flat White' => 'Espresso, steamed milk, thin foam',
        'Hot Chocolate' => 'Cocoa, steamed milk, sugar, whipped cream (optional)',
        'Espresso' => 'Espresso beans, water',
        'Double Espresso' => 'Double shot espresso beans, water',
        'Americano' => 'Espresso, hot water',

        // === DESSERTS ===
        'Macedoine Fruits' => 'Diced seasonal fruits (pineapple, banana, mango, avocado)',
        'Plate of Shunks Fruits' => 'Assorted whole seasonal fruits',
        'Regular Crepe' => 'Flour, eggs, milk, butter, sugar',
        'Chocolate Crepe' => 'Flour, eggs, milk, butter, chocolate spread',
        'Honey Crepe' => 'Flour, eggs, milk, butter, honey',
        'Regular Chapati' => 'Flour, water, oil, salt',
        'Chocolate Chapati' => 'Flour, water, oil, salt, chocolate spread',
        'Cake' => 'Flour, eggs, sugar, butter, vanilla, cream (optional)',
        'Ice' => 'Ice cream scoops (vanilla, chocolate, strawberry), toppings',
    ];

    public function handle(): int
    {
        $filled = 0;
        $skipped = 0;
        $missing = [];

        foreach ($this->ingredients as $name => $ingredients) {
            $updated = MenuItem::where('item_name', $name)
                ->whereHas('branch.restaurant', fn ($q) => $q->where('name', 'DELICATO'))
                ->update(['ingredients' => $ingredients]);
            $updated > 0 ? $filled++ : $missing[] = $name;
        }

        // Count commercial drinks (beers, wines, spirits, soft drinks) that we intentionally skip
        $drinkCategories = ['Beers and Ciders', 'Soft Drinks', 'Red Wine', 'White and Rose Wine', 'Champagne', 'Rum', 'Tequila', 'Gin', 'Liqueurs', 'Vodka', 'Whisky', 'Cognac'];
        $drinkItems = MenuItem::whereHas('branch.restaurant', fn ($q) => $q->where('name', 'DELICATO'))
            ->whereHas('category', fn ($q) => $q->whereIn('category_name', $drinkCategories))
            ->count();
        $skipped = $drinkItems; // Commercial drinks — no ingredients to list

        $total = MenuItem::whereHas('branch.restaurant', fn ($q) => $q->where('name', 'DELICATO'))->count();

        $this->info("Filled ingredients for {$filled} Delicato items.");
        $this->line("Intentionally skipped {$skipped} commercial drink items (beers, wines, spirits, soft drinks).");

        if (!empty($missing)) {
            $this->warn('Names not found in DB (check spelling): ' . implode(', ', $missing));
            return self::FAILURE;
        }

        $this->info("Total Delicato items: {$total}. Food items now show ingredients on the customer site item detail modal.");

        return self::SUCCESS;
    }
}
