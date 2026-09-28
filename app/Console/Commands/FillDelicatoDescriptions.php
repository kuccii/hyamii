<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use App\Models\Branch;
use Illuminate\Console\Command;

class FillDelicatoDescriptions extends Command
{
    protected $signature = 'hyamii:fill-delicato-descriptions';
    protected $description = 'Fill descriptions for DELICATO menu items lacking one (wines get grape/region lines, prepared food gets short appetizing lines).';

    /**
     * item_name => short menu description.
     */
    private array $descriptions = [
        // === BREAKFAST ===
        'Full American Breakfast' => 'Eggs your way, bacon, sausage, beans, toast & hash browns',
        'Fritata Italian' => 'Oven-baked omelette with tomato, onion & parmesan',
        'American Denver Omelete' => 'Fluffy omelette with ham, peppers & cheddar',
        'Mushroom and Spinach Omelete' => 'Eggs folded with mushrooms & wilted spinach',
        'Scrambled Egg' => 'Soft scrambled, done simply',
        'Spanish Omelete' => 'Thick potato & onion tortilla',
        'Special Omelete' => 'Loaded with ham, cheese & mushrooms',
        'Vegetable Omelete' => 'Garden vegetables in a soft egg fold',
        'Regular Omelete' => 'The classic, plain & perfect',
        'Burrito' => 'Eggs, beans & salsa wrapped warm',
        'Delicato Omelete' => 'Our house omelette — everything we love in one',

        // === TEA ===
        'Hot Chocolate Tea' => 'Rich cocoa steeped warm & sweet',
        'Ginger Lemon Tea' => 'Fresh ginger & lemon, honey on the side',
        'African Tea' => 'Spiced milk tea the Rwandan way',
        'Black Tea' => 'Strong, classic & comforting',
        'Spice Tea' => 'Cinnamon, cardamom & clove infused',
        'Green Tea' => 'Light, clean & grassy',

        // === SALADS ===
        'Oriental Salad' => 'Crisp greens with sesame-soy dressing',
        'Avocado Vinaigrette' => 'Creamy avocado over fresh greens',
        'Nicoise Salad' => 'Tuna, egg, beans & olives, Provençal style',
        'Mexican Salad' => 'Beans, corn & tortilla strips with salsa dressing',

        // === SOUPS ===
        'American Zuppa Tuscana' => 'Sausage, potato & kale in creamy broth',
        'American Lentil Soup' => 'Hearty lentils simmered with cumin',
        'Ginger Carrot Soup' => 'Velvety carrots brightened with ginger',
        'Vegetable Soup' => 'Garden vegetables in a clear, herbed broth',

        // === PASTA ===
        'Mexican Spaghetti Verde' => 'Spaghetti in creamy green salsa',
        'Beef Chow Mein' => 'Wok-tossed noodles with beef & vegetables',
        'Chicken Chow Mein' => 'Wok-tossed noodles with chicken & vegetables',
        'Mexican Cheesy Spaghetti' => 'Spaghetti baked in cheddar cream',
        'Italian Bucatini Pasta' => 'Thick bucatini with tomato & guanciale',
        'Spaghetti Alla Gricia' => 'Guanciale, pecorino & black pepper — no tomato',
        'Spaghetti Al Pomodoro' => 'Fresh tomato & basil, the Italian classic',
        'Spaghetti Bolognaise' => 'Slow-simmered beef ragù',
        'Spaghetti Carbonara' => 'Egg, pecorino & guanciale, silky not creamy',

        // === BURGERS ===
        'British Pub Burger' => 'Cheddar, bacon & pickles on a toasted bun',
        'American Smash Burger' => 'Crispy-edged patty, cheese & special sauce',
        'Chicken Cheese Taco Burger' => 'Taco-spiced chicken patty with salsa',
        'Bacon Burger' => 'Beef patty stacked with bacon & cheese',
        'Delicato Beef Burger' => 'House beef burger with caramelized onions',
        'Delicato Chicken Burger' => 'Crispy chicken fillet with house mayo',

        // === SANDWICHES ===
        'Bacon Sandwich' => 'Crispy bacon on buttered toast',
        'Vegetable Sandwich' => 'Cheese & garden vegetables on soft bread',
        'Club Sandwich' => 'Triple-decker with chicken, bacon & egg',
        'Croque Monsieur' => 'Grilled ham & cheese under béchamel',
        'Croque Madam' => 'Croque Monsieur crowned with a fried egg',
        'Delicato Sandwich' => 'The house stack — ham, cheese, egg & sauce',

        // === MAIN COURSES ===
        'Beef Pilao' => 'Fragrant rice simmered with beef & pilau spices',
        'Mexican Beef Fajita' => 'Sizzling beef strips with peppers, tortillas on the side',
        'Beef Rouladine' => 'Stuffed beef roulade with rich gravy',
        'Delicato Chicken' => 'Our signature whole chicken, marinated & roasted',
        'Chicken Roulade' => 'Stuffed chicken breast with pan sauce',
        'Mexican Chicken Fajitas' => 'Sizzling chicken strips with peppers & tortillas',
        'Escalop De Poulet' => 'Breaded chicken cutlet with lemon',
        'Chicken Curry' => 'Comforting curry in a creamy tomato base',
        'Chicken Patiala' => 'Royal Punjabi curry with yogurt & cream',
        'Chicken Punjabi' => 'Bold tomato-onion masala, north Indian style',

        // === FISH ===
        'Delicato Fish' => 'Whole fish, house marinade, grilled to order',
        'Fish Fillet' => 'Tender fillet with butter & lemon',
        'Fish Stew' => 'Fish simmered in tomato-pepper stew',

        // === BEEF ===
        'Yummy Liver' => 'Tender liver with onions & tomatoes',
        'Salisbury Beef Steak' => 'Minced steak smothered in mushroom gravy',
        'Meat Ball with Gravy Sauce' => 'Hand-rolled meatballs in tomato gravy',
        'Beef Bolognaise' => 'Rich beef ragù over pasta',
        'Steak' => 'Seared & simple, with sides',

        // === BROCHETTES ===
        'Beef Brochette' => 'Flame-grilled cubes on skewers',
        'Goat Brochette' => 'Flame-grilled goat, a Kigali favourite',
        'Chicken Brochette' => 'Flame-grilled chicken cubes',
        'Fish Brochette' => 'Flame-grilled fish cubes',
        'Sausage Brochette' => 'Grilled sausages with peppers & onions',

        // === PORK ===
        'Schnitzel' => 'Crispy breaded cutlet with lemon',
        'Pork Chops' => 'Juicy chops with pan juices',
        'Pork Ribs' => 'Slow-cooked ribs in BBQ glaze',

        // === POTATOES ===
        'American Fries Potatoes' => 'Golden & crispy',
        'Potatoes Carbonara' => 'Potatoes tossed bacon-egg-parmesan style',
        'Ground Beef Spicy Potatoes' => 'Crispy potatoes topped with spiced beef',
        'Home Fries Potatoes' => 'Skillet-fried with onion & paprika',
        'Crown Irish Potatoes' => 'Buttery herbed potatoes',
        'Skillet Potatoes' => 'Crisped in butter with onions',
        'Regular Chips' => 'Freshly cut, hot & salty',

        // === RICE ===
        'Thai Rice' => 'Jasmine rice wok-tossed Thai style',
        'Creole Rice' => 'Rice with tomatoes, peppers & creole spice',
        'Singapore Rice' => 'Curry-scented fried rice with chicken & shrimp',
        'Caribbean Coconut Rice' => 'Creamy coconut rice with island spices',
        'Mexican Rice' => 'Tomato rice with cumin & garlic',
        'Kung Pao Rice' => 'Rice with chicken, peanuts & dried chilies',
        'Chinese Rice' => 'Classic fried rice with egg & vegetables',
        'Vegetable Rice' => 'Garden vegetables through fluffy rice',

        // === LOCAL FOOD ===
        'Fufu' => 'Ubugari — cassava staple, served with the day\'s soup',

        // === SAUCES AND VEGETABLES ===
        'Creamy Peppercorn Sauce' => 'Cracked pepper in slow cream',
        'Creamy Garlic Sauce' => 'Garden garlic in parmesan cream',
        'Cream Cheese Steak Sauce' => 'Steak-house cream cheese sauce',
        'Creamy Mushroom Sauce' => 'Earthy mushrooms in garlic cream',
        'Whisky Cream Sauce' => 'Flamed whisky, finished in cream',
        'Spinach Vegetable' => 'Garlicky wilted spinach',
        'Plate of Vegetable' => 'Seasonal mixed vegetables',
        'Greens Vegetable' => 'Slow-cooked local greens',

        // === WRAPS AND QUESADILLAS ===
        'Chicken Quesadilla' => 'Melted cheese & chicken in a crisped tortilla',
        'Beef Quesadilla' => 'Melted cheese & seasoned beef in a crisped tortilla',
        'Beef Shawarma' => 'Marinated beef, garlic sauce & pickles in flatbread',
        'Beef Wrap' => 'Beef strips & vegetables in a soft tortilla',
        'Chicken Wrap' => 'Chicken & vegetables in a soft tortilla',
        'Vegetable Wrap' => 'Grilled vegetables & cheese in a soft tortilla',

        // === PIZZA ===
        'Delicato Pizza' => 'Ham, mushroom & olives on house dough',
        'Four Seasons Pizza' => 'Four toppings, four quarters — the classic',
        'Margarita Pizza' => 'Tomato, mozzarella & fresh basil',
        'Vegetable Pizza' => 'Garden vegetables over mozzarella',
        'Chicken Pizza' => 'Chicken & peppers over mozzarella',

        // === SMOOTHIES ===
        'Mango Smoothie' => 'Ripe mango blended thick',
        'Banana Smoothie' => 'Banana, yogurt & honey, blended smooth',
        'Customer Choice' => 'Pick your fruits — we blend them thick',
        'Avocado Smoothie' => 'Avocado blended creamy with milk & honey',
        'Mixed Smoothie' => 'The big blend — mango, banana, pineapple & more',

        // === MILKSHAKES ===
        'Vanilla Milkshake' => 'Vanilla ice cream, whipped & tall',
        'Strawberry Milkshake' => 'Strawberry ice cream with real berries',
        'Chocolate Milkshake' => 'Chocolate ice cream with syrup',
        'Mango Milkshake' => 'Fresh mango spun with ice cream',
        'Banana Milkshake' => 'Banana spun with vanilla ice cream',
        'Delicato Milkshake' => 'The house blend — ask what\'s in it today',
        'Tropical Milkshake' => 'Pineapple, mango & coconut milk',

        // === COCKTAILS ===
        'Long Island' => 'Five spirits, one dangerous glass',
        'Mojito' => 'Rum, lime & crushed mint',
        'Aperol Spritz' => 'Aperol, prosecco & soda, orange to garnish',
        'Mimosa' => 'Champagne & fresh orange',
        'Margarita' => 'Tequila, lime & a salt rim',
        'Tequila Sunrise' => 'Tequila, orange & a grenadine sunrise',
        'Sex on the Beach' => 'Vodka, peach & cranberry',
        'Gin Tonic' => 'Gin over ice, tonic & lime',
        'Mint Margarita' => 'Margarita with fresh mint',
        'Adios Mother F' => 'Five spirits & blue curaçao — ask your server',

        // === JUICES ===
        'Mango Juice' => 'Fresh-pressed mango',
        'Pineapple Juice' => 'Fresh-pressed pineapple',
        'Passion Juice' => 'Fresh passion fruit, sweet & tart',
        'Cocktail Juice' => 'A blend of the day\'s fruits',
        'Tomato Juice' => 'Fresh-pressed & seasoned',

        // === COFFEE ===
        'Cappuccino' => 'Espresso under velvet foam',
        'Latte Macchiato' => 'Milk marked with espresso, layered',
        'Flat White' => 'Double ristretto under thin milk',
        'Hot Chocolate' => 'Steamed milk & real cocoa',
        'Espresso' => 'A single perfect shot',
        'Double Espresso' => 'Two shots, no compromise',
        'Americano' => 'Espresso lengthened with hot water',

        // === DESSERTS ===
        'Macedoine Fruits' => 'Diced seasonal fruit cup',
        'Plate of Shunks Fruits' => 'A full plate of fresh seasonal fruit',
        'Regular Crepe' => 'Thin & warm, sugar-dusted',
        'Chocolate Crepe' => 'Warm crepe with chocolate spread',
        'Honey Crepe' => 'Warm crepe drizzled with honey',
        'Regular Chapati' => 'Flaky street-style chapati',
        'Chocolate Chapati' => 'Chapati with melted chocolate',
        'Cake' => 'Slice of the day\'s bake',
        'Ice' => 'Scoops of the day, with topping',
    ];

    private array $wineFallbacks = [
        'Red Wine' => 'Red wine — served by the bottle',
        'White and Rose Wine' => 'White & rosé wine — served by the bottle',
        'Champagne' => 'Champagne — served by the bottle',
    ];

    public function handle(): int
    {
        $filled = 0;
        $missing = [];

        foreach ($this->descriptions as $name => $desc) {
            $updated = MenuItem::where('item_name', $name)
                ->whereHas('branch', fn ($q) => $q->where('restaurant_id', 9))
                ->where(function ($q) {
                    $q->whereNull('description')->orWhere('description', '');
                })
                ->update(['description' => $desc]);
            $updated > 0 ? $filled++ : $missing[] = $name;
        }

        // Second pass: quantity-only descriptions ("2 pieces") from the seeder get
        // replaced by the curated line, keeping the quantity as a suffix.
        foreach ($this->descriptions as $name => $desc) {
            $updated = MenuItem::where('item_name', $name)
                ->whereHas('branch', fn ($q) => $q->where('restaurant_id', 9))
                ->where(function ($q) {
                    $q->where('description', 'like', '%pieces%')
                      ->orWhere('description', 'Ubugari')
                      ->orWhere('description', 'like', '%ask server%');
                })
                ->update(['description' => $desc]);
            if ($updated > 0) {
                // re-append the quantity where the curated map has one
                $qty = ['Beef Brochette' => '2 pieces', 'Goat Brochette' => '2 pieces', 'Chicken Brochette' => '2 pieces', 'Fish Brochette' => '2 pieces', 'Sausage Brochette' => '2 pieces', 'Regular Crepe' => '3 pieces', 'Chocolate Crepe' => '3 pieces', 'Honey Crepe' => '3 pieces', 'Regular Chapati' => '3 pieces', 'Chocolate Chapati' => '3 pieces'][$name] ?? null;
                if ($qty) {
                    MenuItem::where('item_name', $name)
                        ->whereHas('branch', fn ($q) => $q->where('restaurant_id', 9))
                        ->update(['description' => $desc . ' (' . $qty . ')']);
                }
                $filled += $updated;
            }
        }

        // Wine & champagne categories: only fill items that still have no description.
        // NOTE: category_name is stored as JSON translations ({"en":"Vodka"}),
        // so match inside the JSON rather than equality.
        $branchId = Branch::where('restaurant_id', 9)->value('id');
        $catId = fn (string $name) => \App\Models\ItemCategory::where('branch_id', $branchId)
            ->where('category_name', 'like', '%"' . $name . '"%')->value('id');

        foreach ($this->wineFallbacks as $cat => $desc) {
            if ($id = $catId($cat)) {
                $filled += MenuItem::where('branch_id', $branchId)
                    ->where('item_category_id', $id)
                    ->where(function ($q) {
                        $q->whereNull('description')->orWhere('description', '');
                    })
                    ->update(['description' => $desc]);
            }
        }

        // Beers/spirits/soft drinks: "Served chilled" fallback where empty
        $drinkCatIds = \App\Models\ItemCategory::where('branch_id', $branchId)
            ->where(function ($q) {
                foreach (['Beers and Ciders', 'Rum', 'Tequila', 'Gin', 'Liqueurs', 'Vodka', 'Whisky', 'Cognac', 'Soft Drinks'] as $n) {
                    $q->orWhere('category_name', 'like', '%"' . $n . '"%');
                }
            })->pluck('id');
        $filled += MenuItem::where('branch_id', $branchId)
            ->whereIn('item_category_id', $drinkCatIds)
            ->where(function ($q) {
                $q->whereNull('description')->orWhere('description', '');
            })
            ->update(['description' => 'Served chilled']);

        $total = MenuItem::whereHas('branch', fn ($q) => $q->where('restaurant_id', 9))->count();
        $withDesc = MenuItem::whereHas('branch', fn ($q) => $q->where('restaurant_id', 9))
            ->where(function ($q) {
                $q->whereNull('description')->orWhere('description', '')->orwhere('description', 'Served chilled');
            })
            ->count();

        $this->info("Filled {$filled} descriptions.");
        if (!empty($missing)) {
            $this->warn('Names not found in DB: ' . implode(', ', $missing));
        }
        $this->info("Remaining without real description (beers/spirits show 'Served chilled'): {$withDesc}");

        return self::SUCCESS;
    }
}
