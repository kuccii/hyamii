<?php

namespace App\Console\Commands;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Currency;
use App\Models\ItemCategory;
use App\Models\KotPlace;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\ModifierGroup;
use App\Models\ModifierOption;
use App\Models\OnboardingStep;
use App\Models\OrderType;
use App\Models\Restaurant;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SeedTaniaRestaurant extends Command
{
    protected $signature = 'hyamii:seed-tania';
    protected $description = 'Seed TANIA restaurant with full menu';

    private const IMAGE_SOURCE = 'resources/images/tania-menu';
    private const IMAGE_DEST = 'public/user-uploads/item';

    private array $availableImages = [];

    public function handle(): int
    {
        if (Restaurant::where('name', 'TANIA')->exists()) {
            $this->warn('TANIA restaurant already exists — skipping.');
            return self::SUCCESS;
        }

        $country = Country::where('countries_code', 'RW')->first();
        if (!$country) {
            $this->error('Rwanda country not found. Run CountrySeeder first.');
            return self::FAILURE;
        }

        $packageId = 1;
        $this->info('Creating TANIA restaurant...');

        $restaurant = Restaurant::create([
            'name' => 'TANIA',
            'subtitle' => 'Food & Coffee',
            'address' => 'Kigali, Rwanda',
            'phone_number' => '+250 788 000 000',
            'email' => 'info@tania.rw',
            'timezone' => 'Africa/Kigali',
            'time_format' => 'h:i A',
            'date_format' => 'd/m/Y',
            'theme_hex' => '#8B4513',
            'theme_rgb' => '139, 69, 19',
            'country_id' => $country->id,
            'package_id' => $packageId,
            'package_type' => 'annual',
            'about_us' => '<p>A Culinary Journey of African Flavors. Established 2026.</p>',
            'facebook_link' => 'https://www.facebook.com/',
            'instagram_link' => 'https://www.instagram.com/',
            'twitter_link' => 'https://www.twitter.com/',
            'customer_site_language' => 'en',
            'approval_status' => 'Approved',
        ]);

        $restaurant->hash = substr(md5($restaurant->id . '_tania_' . time()), 0, 20);
        $restaurant->saveQuietly();

        $this->line('  ✓ Restaurant created (ID: ' . $restaurant->id . ')');

        $this->line('  Creating currencies...');
        $this->createCurrencies($restaurant);
        $this->line('  ✓ Currencies created');

        $this->line('  Creating branch...');
        $branch = $this->createBranch($restaurant);
        $this->line('  ✓ Branch created');

        $this->line('  Copying menu images...');
        $this->copyImages();
        $this->line('  ✓ Images copied');

        $this->line('  Creating menu categories and items...');
        $menu = Menu::create(['branch_id' => $branch->id, 'menu_name' => 'TANIA Menu']);
        $this->seedMenu($branch, $menu);
        $this->line('  ✓ Menu items created');

        $this->line('  Creating roles and users...');
        $this->createUsers($restaurant, $branch);
        $this->line('  ✓ Users created');

        $restaurant->license_type = 'paid';
        $restaurant->saveQuietly();

        $this->newLine();
        $this->info('✅ TANIA restaurant seeded successfully!');
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
            'name' => 'TANIA Kigali',
            'address' => 'Kigali, Rwanda',
            'phone' => '+250 788 000 000',
            'email' => 'info@tania.rw',
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

    private function copyImages(): void
    {
        $src = base_path(self::IMAGE_SOURCE);
        $dst = base_path(self::IMAGE_DEST);

        if (!is_dir($src)) {
            $this->warn('    Image source not found: ' . $src);
            return;
        }

        if (!is_dir($dst)) {
            mkdir($dst, 0755, true);
        }

        foreach (glob($src . '/*.jpg') as $file) {
            $filename = basename($file);
            copy($file, $dst . '/' . $filename);
        }
    }

    private function resolveImage(string $itemName): ?string
    {
        if (empty($this->availableImages)) {
            $dir = base_path(self::IMAGE_SOURCE);
            if (is_dir($dir)) {
                foreach (glob($dir . '/*.jpg') as $file) {
                    $this->availableImages[] = basename($file);
                }
            }
        }

        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $itemName), '-'));

        $nameMap = [
            'espresso-single' => 'espresso',
            'espresso-double' => 'espresso',
            'caffe-latte' => 'latte',
            '1-4-grilled-chicken' => 'peri-peri-chicken',
            '1-2-grilled-chicken' => 'grilled-chicken',
            'whole-grilled-chicken' => 'whole-chicken',
            'plate-of-samosa' => 'samosas',
            'plate-of-sombe' => 'sombe',
            'sombe-2kg' => 'sombe',
            'cheese-sausages' => 'cheese-sausages',
            'ginger-carrot-soup' => 'carrot-soup',
            'cream-tomato-soup' => 'tomato-soup',
            'twatundi-beef' => 'beef-twatundi',
            'beef-brochettes' => 'beef-brochette',
            'sizzling-twatundi-beef' => 'beef-twatundi',
            'beef-fillet-steak' => 'beef-fillet',
            'twatundi-pork' => 'pork-sausages',
            'fresh-sausage-brochette' => 'pork-sausages',
            'saucisse-pili-brochette' => 'pork-sausages',
            'twatundi-goat' => 'goat-grilled',
            'sizzling-twatundi-goat' => 'goat-grilled',
            'chevre-de-mr-seguin' => 'goat-stew',
            'ragout-de-chevre' => 'goat-stew',
            'chevre-grille' => 'goat-grilled',
            'twatundi-chicken' => 'chicken-brochette',
            'chicken-brochette' => 'chicken-brochette',
            'chicken-with-peanut-sauce' => 'chicken-yassa',
            'chicken-stroganoff' => 'chicken-stew',
            'poulet-mayo' => 'grilled-chicken',
            'peri-peri-1-4-chicken' => 'peri-peri-chicken',
            'twatundi-fish' => 'fish-brochette',
            'fish-brochette' => 'fish-brochette',
            'whole-tilapia-fish' => 'whole-tilapia',
            'makayabu-stew' => 'makayabu',
            'lengalenga-with-smoked-fish' => 'lengalenga-fish',
            'spinach-with-cream' => 'spinach-cream',
            'haricots-de-goma' => 'beans',
            'steamed-rice' => 'rice-steamed',
            'fried-rice' => 'rice-fried',
            'chicken-fried-rice' => 'chicken-fried-rice',
            'cassava-ugali' => 'ugali',
            'maize-ugali' => 'ugali',
            'ugali-mix' => 'ugali',
            'pure-lemonade' => 'lemonade',
            '1-scoop-ice-cream' => 'ice-cream-1',
            '2-scoops-ice-cream' => 'ice-cream-2',
            'iced-cappuccino' => 'iced-coffee',
            'iced-latte' => 'iced-coffee',
            'iced-americano' => 'iced-coffee',
            'iced-caramel' => 'iced-coffee',
            'iced-chocolate' => 'iced-coffee',
            'iced-espresso-tonic' => 'iced-coffee',
            'iced-spanish' => 'iced-coffee',
            'customer-choice-iced-coffee' => 'iced-coffee',
            'customer-choice-hot-coffee' => 'espresso',
            'customer-choice-smoothie' => 'mix-smoothie',
            'customer-choice-shake' => 'vanilla-shake',
            'spinach' => 'spinach',
            'poulet-gomb' => 'poulet-gombo',
            'poulet-maffe' => 'poulet-maffe',
        ];

        $targetSlug = $nameMap[$slug] ?? $slug;
        $targetFile = $targetSlug . '.jpg';

        if (in_array($targetFile, $this->availableImages)) {
            return $targetFile;
        }

        if (in_array($slug . '.jpg', $this->availableImages)) {
            return $slug . '.jpg';
        }

        return null;
    }

    private function seedMenu(Branch $branch, Menu $menu): void
    {
        $branchId = $branch->id;
        $menuId = $menu->id;
        $defaultKotId = KotPlace::where('branch_id', $branchId)->where('is_default', true)->value('id');

        $cat1 = ItemCategory::create(['category_name' => 'Snacks & Starters', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat1->id, $branchId, $defaultKotId, [
            ['name' => 'Snacks Platter', 'price' => '25,000 FRW', 'note' => 'Preparation: 45 min'],
            ['name' => 'BBQ Platter', 'price' => '75,000 FRW', 'note' => 'Preparation: 1 hour'],
            ['name' => 'Plate of Samosas', 'price' => '8,000 FRW'],
            ['name' => 'Cheese Platter', 'price' => '8,000 FRW'],
            ['name' => 'Cheese & Sausages', 'price' => '10,000 FRW'],
            ['name' => 'Chicken Nuggets', 'price' => '12,000 FRW'],
            ['name' => 'Chicken Lollipops', 'price' => '12,000 FRW'],
            ['name' => 'Fish Fingers', 'price' => '12,000 FRW'],
        ]);

        $cat2 = ItemCategory::create(['category_name' => 'Soups & Salads', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat2->id, $branchId, $defaultKotId, [
            ['name' => 'Vegetable Soup', 'price' => '8,000 FRW'],
            ['name' => 'Mushroom Soup', 'price' => '12,000 FRW'],
            ['name' => 'Cream Tomato Soup', 'price' => '12,000 FRW'],
            ['name' => 'Ginger Carrot Soup', 'price' => '12,000 FRW'],
            ['name' => 'Kachumbari', 'price' => '5,000 FRW'],
            ['name' => 'Garden Salad', 'price' => '6,000 FRW', 'desc' => 'Cucumbers, tomatoes, lettuces, onions, avocadoes'],
            ['name' => 'Chicken Salad', 'price' => '10,000 FRW'],
            ['name' => 'Chef Salad', 'price' => '12,000 FRW'],
        ]);

        $cat3 = ItemCategory::create(['category_name' => 'Beef & Pork', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat3->id, $branchId, $defaultKotId, [
            ['name' => 'Twatundi Beef', 'price' => '18,000 FRW'],
            ['name' => 'Beef Brochettes', 'price' => '18,000 FRW'],
            ['name' => 'Sizzling Twatundi Beef', 'price' => '18,000 FRW'],
            ['name' => 'Beef Stew', 'price' => '15,000 FRW'],
            ['name' => 'Beef Fillet Steak', 'price' => '25,000 FRW', 'desc' => 'Mushroom sauce, peppercorn sauce, or garlic sauce'],
            ['name' => 'Twatundi Pork', 'price' => '18,000 FRW'],
            ['name' => 'Fresh Sausage Brochette', 'price' => '10,000 FRW'],
            ['name' => 'Saucisse Pili Brochette', 'price' => '10,000 FRW'],
            ['name' => 'Pork Chops', 'price' => '20,000 FRW'],
            ['name' => 'Pork Ribs', 'price' => '15,000 FRW'],
        ]);

        $cat4 = ItemCategory::create(['category_name' => 'Goat Specialties', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat4->id, $branchId, $defaultKotId, [
            ['name' => 'Twatundi Goat', 'price' => '18,000 FRW'],
            ['name' => 'Sizzling Twatundi Goat', 'price' => '18,000 FRW'],
            ['name' => 'Chèvre de Mr Seguin', 'price' => '22,000 FRW', 'note' => 'Preparation: 40 min'],
            ['name' => 'Ragoût de Chèvre', 'price' => '22,000 FRW', 'note' => 'Preparation: 40 min'],
            ['name' => 'Chèvre Grillé', 'price' => '18,000 FRW'],
            ['name' => 'Cabri', 'price' => '25,000 FRW'],
            ['name' => 'Poulet Gombo', 'price' => '25,000 FRW', 'note' => 'Preparation: 45 min', 'desc' => 'Chef\'s Special'],
            ['name' => 'Poulet Maffé', 'price' => '25,000 FRW', 'note' => 'Preparation: 45 min', 'desc' => 'Chef\'s Special'],
        ]);

        $cat5 = ItemCategory::create(['category_name' => 'Chicken', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat5->id, $branchId, $defaultKotId, [
            ['name' => 'Twatundi Chicken', 'price' => '15,000 FRW'],
            ['name' => 'Chicken Brochette', 'price' => '15,000 FRW'],
            ['name' => '1/4 Grilled Chicken', 'price' => '15,000 FRW'],
            ['name' => '1/2 Grilled Chicken', 'price' => '18,000 FRW'],
            ['name' => 'Whole Grilled Chicken', 'price' => '25,000 FRW', 'note' => 'Preparation: 50 min'],
            ['name' => 'Chicken Yassa', 'price' => '25,000 FRW'],
            ['name' => 'Chicken with Peanut Sauce', 'price' => '20,000 FRW', 'desc' => 'Poulet à la sauce arachide', 'note' => 'Preparation: 1 hour'],
            ['name' => 'Chicken Stroganoff', 'price' => '18,000 FRW'],
            ['name' => 'Poulet Mayo', 'price' => '20,000 FRW'],
            ['name' => 'Peri Peri 1/4 Chicken', 'price' => '18,000 FRW'],
            ['name' => 'Chicken Stew', 'price' => '18,000 FRW'],
        ]);

        $cat6 = ItemCategory::create(['category_name' => 'Fish', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat6->id, $branchId, $defaultKotId, [
            ['name' => 'Fish Brochette', 'price' => '18,000 FRW'],
            ['name' => 'Fish Fillet', 'price' => '22,000 FRW', 'desc' => 'Served with your choice of sauce'],
            ['name' => 'Twatundi Fish', 'price' => '18,000 FRW'],
            ['name' => 'Tilapia Fillet', 'price' => '22,000 FRW', 'desc' => 'With lemon butter sauce', 'note' => 'Preparation: 1 hour'],
            ['name' => 'Swahili Fish', 'price' => '22,000 FRW', 'desc' => 'With coconut sauce'],
            ['name' => 'Whole Tilapia Fish', 'price' => '25,000 FRW', 'note' => 'Preparation: 1 hour'],
            ['name' => 'Makayabu Stew', 'price' => '20,000 FRW'],
        ]);

        $cat7 = ItemCategory::create(['category_name' => 'Extras & Sides', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat7->id, $branchId, $defaultKotId, [
            ['name' => 'Plate of Sombe', 'price' => '4,000'],
            ['name' => 'Lengalenga', 'price' => '3,000'],
            ['name' => 'Lengalenga with Smoked Fish', 'price' => '5,000'],
            ['name' => 'Spinach', 'price' => '4,000'],
            ['name' => 'Spinach with Cream', 'price' => '8,000'],
            ['name' => 'Fumbwa', 'price' => '20,000'],
            ['name' => 'Beans', 'price' => '3,000'],
            ['name' => 'Haricots de Goma', 'price' => '5,000'],
            ['name' => 'Steamed Rice', 'price' => '3,000'],
            ['name' => 'Fried Rice', 'price' => '6,000'],
            ['name' => 'Chicken Fried Rice', 'price' => '8,000'],
            ['name' => 'Kwanga', 'price' => '2,500'],
            ['name' => 'Plantain', 'price' => '4,000'],
            ['name' => 'Chips', 'price' => '3,500'],
            ['name' => 'Fried Bananas', 'price' => '3,000'],
            ['name' => 'Grilled Bananas', 'price' => '3,000'],
            ['name' => 'Boiled Potatoes', 'price' => '3,000'],
            ['name' => 'Garlic Potatoes', 'price' => '4,500'],
            ['name' => 'Sombe (2kg)', 'price' => '15,000'],
            ['name' => 'Cassava Ugali', 'price' => '3,000'],
            ['name' => 'Maize Ugali', 'price' => '3,000'],
            ['name' => 'Ugali Mix', 'price' => '4,000'],
        ]);

        $cat8 = ItemCategory::create(['category_name' => 'Coffee & Tea', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat8->id, $branchId, $defaultKotId, [
            ['name' => 'Espresso (Single)', 'price' => '2,500'],
            ['name' => 'Espresso (Double)', 'price' => '3,000'],
            ['name' => 'Macchiato', 'price' => '3,000'],
            ['name' => 'Americano', 'price' => '4,000'],
            ['name' => 'Caffé Latte', 'price' => '4,000'],
            ['name' => 'Cappuccino', 'price' => '4,000'],
            ['name' => 'Flat White', 'price' => '4,000'],
            ['name' => 'Spanish Coffee', 'price' => '5,000'],
            ['name' => 'Mocha', 'price' => '5,000'],
            ['name' => 'Caramel Macchiato', 'price' => '5,000'],
            ['name' => 'Hot Chocolate', 'price' => '5,000'],
            ['name' => 'Tania\'s Coffee', 'price' => '6,000'],
            ['name' => 'Customer Choice (Hot Coffee)', 'price' => '8,000'],
            ['name' => 'Iced Cappuccino', 'price' => '5,000'],
            ['name' => 'Iced Latte', 'price' => '5,000'],
            ['name' => 'Iced Americano', 'price' => '5,000'],
            ['name' => 'Iced Mocha', 'price' => '6,000'],
            ['name' => 'Iced Tea', 'price' => '5,000'],
            ['name' => 'Iced Caramel', 'price' => '6,000'],
            ['name' => 'Iced Chocolate', 'price' => '6,000'],
            ['name' => 'Iced Espresso Tonic', 'price' => '5,000'],
            ['name' => 'Iced Spanish', 'price' => '8,000'],
            ['name' => 'Customer Choice (Iced Coffee)', 'price' => '8,000'],
            ['name' => 'African Tea', 'price' => '6,000'],
            ['name' => 'Spice Tea', 'price' => '6,000'],
            ['name' => 'Green Tea', 'price' => '4,000'],
            ['name' => 'Black Tea', 'price' => '3,500'],
            ['name' => 'Lemon Tea', 'price' => '3,500'],
        ]);

        $cat9 = ItemCategory::create(['category_name' => 'Smoothies & Juices', 'branch_id' => $branchId]);
        $this->insertItems($menuId, $cat9->id, $branchId, $defaultKotId, [
            ['name' => 'Mango Smoothie', 'price' => '10,000'],
            ['name' => 'Banana Smoothie', 'price' => '10,000'],
            ['name' => 'Mix Smoothie', 'price' => '10,000'],
            ['name' => 'Avocado Smoothie', 'price' => '10,000'],
            ['name' => 'Customer Choice (Smoothie)', 'price' => '12,000'],
            ['name' => 'Pineapple Juice', 'price' => '8,000'],
            ['name' => 'Passion Juice', 'price' => '8,000'],
            ['name' => 'Tree Tomato Juice', 'price' => '8,000'],
            ['name' => 'Lemon Juice', 'price' => '8,000'],
            ['name' => 'Mango Juice', 'price' => '10,000'],
            ['name' => 'Pure Lemonade', 'price' => '8,000'],
            ['name' => 'Vanilla Shake', 'price' => '8,000'],
            ['name' => 'Chocolate Shake', 'price' => '8,000'],
            ['name' => 'Oreo Shake', 'price' => '10,000'],
            ['name' => 'Espresso Shake', 'price' => '8,000'],
            ['name' => 'Tropical Shake', 'price' => '8,000'],
            ['name' => 'Strawberry Shake', 'price' => '8,000'],
            ['name' => 'Customer Choice (Shake)', 'price' => '10,000'],
            ['name' => '1 Scoop Ice Cream', 'price' => '3,000'],
            ['name' => '2 Scoops Ice Cream', 'price' => '6,000'],
        ]);

        $this->createModifiers($branch, $branchId);
    }

    private function insertItems(int $menuId, int $categoryId, int $branchId, int $defaultKotId, array $items): void
    {
        $rows = [];
        foreach ($items as $item) {
            $image = $this->resolveImage($item['name']);
            $rows[] = [
                'item_name' => $item['name'],
                'menu_id' => $menuId,
                'item_category_id' => $categoryId,
                'branch_id' => $branchId,
                'type' => MenuItem::NONVEG,
                'price' => $this->parsePrice($item['price']),
                'description' => $item['desc'] ?? null,
                'image' => $image,
                'preparation_time' => $this->parseMinutes($item['note'] ?? null),
                'kot_place_id' => $defaultKotId,
                'is_available' => 1,
                'show_on_customer_site' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        MenuItem::insert($rows);
    }

    private function createModifiers(Branch $branch, int $branchId): void
    {
        $sauceGroup = ModifierGroup::create([
            'name' => 'Sauce Choice',
            'branch_id' => $branchId,
        ]);
        foreach ([
            ['name' => 'Mushroom Sauce', 'price' => 1000, 'is_available' => 1],
            ['name' => 'Peppercorn Sauce', 'price' => 1000, 'is_available' => 1],
            ['name' => 'Garlic Sauce', 'price' => 1000, 'is_available' => 1],
            ['name' => 'Lemon Butter Sauce', 'price' => 1000, 'is_available' => 1],
            ['name' => 'Coconut Sauce', 'price' => 1000, 'is_available' => 1],
            ['name' => 'Peanut Sauce', 'price' => 1000, 'is_available' => 1],
        ] as $s) {
            ModifierOption::create([
                'name' => $s['name'],
                'modifier_group_id' => $sauceGroup->id,
                'price' => $s['price'],
                'is_available' => $s['is_available'],
            ]);
        }

        $extraGroup = ModifierGroup::create([
            'name' => 'Extras',
            'branch_id' => $branchId,
        ]);
        foreach ([
            ['name' => 'Extra Cheese', 'price' => 500, 'is_available' => 1],
            ['name' => 'Extra Sauce', 'price' => 300, 'is_available' => 1],
            ['name' => 'Grilled Onions', 'price' => 400, 'is_available' => 1],
            ['name' => 'French Fries', 'price' => 2000, 'is_available' => 1],
        ] as $e) {
            ModifierOption::create([
                'name' => $e['name'],
                'modifier_group_id' => $extraGroup->id,
                'price' => $e['price'],
                'is_available' => $e['is_available'],
            ]);
        }

        foreach (MenuItem::where('branch_id', $branchId)->whereIn('item_name', ['Beef Fillet Steak', 'Fish Fillet', 'Tilapia Fillet', 'Swahili Fish'])->get() as $item) {
            $item->modifierGroups()->attach($sauceGroup->id);
        }
    }

    private function createUsers(Restaurant $restaurant, Branch $branch): void
    {
        Role::create(['name' => 'Admin_' . $restaurant->id, 'display_name' => 'Admin', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Branch Head_' . $restaurant->id, 'display_name' => 'Branch Head', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Waiter_' . $restaurant->id, 'display_name' => 'Waiter', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);
        Role::create(['name' => 'Chef_' . $restaurant->id, 'display_name' => 'Chef', 'guard_name' => 'web', 'restaurant_id' => $restaurant->id]);

        $allPerms = \Spatie\Permission\Models\Permission::whereHas('module', fn($q) => $q->where('is_superadmin', 0))->get();
        Role::where('name', 'Admin_' . $restaurant->id)->first()->syncPermissions($allPerms);
        Role::where('name', 'Branch Head_' . $restaurant->id)->first()->syncPermissions($allPerms);

        $admin = User::create([
            'name' => 'Tania Admin',
            'email' => 'admin@tania.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
        ]);
        $admin->assignRole('Admin_' . $restaurant->id);

        $waiter = User::create([
            'name' => 'Tania Waiter',
            'email' => 'waiter@tania.rw',
            'password' => bcrypt(123456),
            'restaurant_id' => $restaurant->id,
            'branch_id' => $branch->id,
        ]);
        $waiter->assignRole('Waiter_' . $restaurant->id);

        $this->info('    Admin: admin@tania.rw / 123456');
        $this->info('    Waiter: waiter@tania.rw / 123456');
    }

    private function parsePrice(string $price): float
    {
        return (float) str_replace(',', '', explode(' ', trim($price))[0]);
    }

    private function parseMinutes(?string $note): ?int
    {
        if (!$note) return null;
        if (preg_match('/(\d+)\s*(min|hour)/i', $note, $m)) {
            return (int) $m[1] * (str_starts_with(strtolower($m[2]), 'h') ? 60 : 1);
        }
        return null;
    }
}
