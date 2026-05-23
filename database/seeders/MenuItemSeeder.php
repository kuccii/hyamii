<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\ItemCategory;
use App\Models\ModifierGroup;
use App\Models\ModifierOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run($branch): void
    {
        $branchId = $branch->id;

        // Item categories (Indyo = dishes)
        $categoryStarter = new ItemCategory();
        $categoryStarter->category_name = 'Starters (Ibyokurya by\'Ubusa)';
        $categoryStarter->branch_id = $branchId;
        $categoryStarter->saveQuietly();

        $categoryMain = new ItemCategory();
        $categoryMain->category_name = 'Main Course (Indyo Nyamukuru)';
        $categoryMain->branch_id = $branchId;
        $categoryMain->saveQuietly();

        $categoryGrill = new ItemCategory();
        $categoryGrill->category_name = 'Grills & Brochettes (Ibyokurya bikaranze)';
        $categoryGrill->branch_id = $branchId;
        $categoryGrill->saveQuietly();

        $categorySides = new ItemCategory();
        $categorySides->category_name = 'Sides (Inyamibwa)';
        $categorySides->branch_id = $branchId;
        $categorySides->saveQuietly();

        $categoryBeverages = new ItemCategory();
        $categoryBeverages->category_name = 'Beverages (Ibinyobwa)';
        $categoryBeverages->branch_id = $branchId;
        $categoryBeverages->saveQuietly();

        $categorySnacks = new ItemCategory();
        $categorySnacks->category_name = 'Snacks (Ibyokurya byoroheje)';
        $categorySnacks->branch_id = $branchId;
        $categorySnacks->saveQuietly();

        $menu1 = new Menu();
        $menu1->menu_name = 'Amakuru y\'Igihugu (Flavors of the Land)';
        $menu1->branch_id = $branchId;
        $menu1->saveQuietly();

        $defaultKotPlaceId = optional($branch->kotPlaces()->where('is_default', true)->first())->id;

        $menuItems1 = [
            [
                'item_name' => 'Ugali na Isombe',
                'menu_id' => $menu1->id,
                'type' => MenuItem::VEG,
                'price' => 2500,
                'item_category_id' => $categoryMain->id,
                'image' => 'ugali-isombe.webp',
                'description' => 'Maize porridge served with cassava leaves cooked in groundnut sauce.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Ibihaza (Pumpkin in Peanut Sauce)',
                'menu_id' => $menu1->id,
                'type' => MenuItem::VEG,
                'price' => 3000,
                'item_category_id' => $categoryMain->id,
                'image' => 'ibihaza.webp',
                'description' => 'Fresh pumpkin simmered in a rich peanut sauce with local spices.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Agatogo (Plantain Stew)',
                'menu_id' => $menu1->id,
                'type' => MenuItem::VEG,
                'price' => 2800,
                'item_category_id' => $categoryMain->id,
                'image' => 'agatogo.webp',
                'description' => 'Green plantains cooked in a savory tomato and vegetable stew.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Ibijumba (Sweet Potatoes)',
                'menu_id' => $menu1->id,
                'type' => MenuItem::VEG,
                'price' => 1500,
                'item_category_id' => $categorySides->id,
                'image' => 'ibijumba.webp',
                'description' => 'Rwandan orange-fleshed sweet potatoes, boiled to perfection.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Kigali Special Brochettes (Mixed)',
                'menu_id' => $menu1->id,
                'type' => MenuItem::NONVEG,
                'price' => 5000,
                'item_category_id' => $categoryGrill->id,
                'image' => 'brochettes-mixed.webp',
                'description' => 'Skewered mix of beef, goat and chicken, grilled over charcoal with Rwandan spices.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
        ];

        $menu2 = new Menu();
        $menu2->menu_name = 'Indumburwa z\'Abanyarwanda (Rwandan Specialties)';
        $menu2->branch_id = $branchId;
        $menu2->saveQuietly();

        $menuItems2 = [
            [
                'item_name' => 'Akabenz (Fried Pork)',
                'menu_id' => $menu2->id,
                'type' => MenuItem::NONVEG,
                'price' => 4500,
                'item_category_id' => $categoryMain->id,
                'image' => 'akabenz.webp',
                'description' => 'Crispy fried pork belly marinated in garlic, ginger and local herbs.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Sambaza (Fried Small Fish)',
                'menu_id' => $menu2->id,
                'type' => MenuItem::NONVEG,
                'price' => 2000,
                'item_category_id' => $categoryStarter->id,
                'image' => 'sambaza.webp',
                'description' => 'Crispy lake Tanganyika sardines fried with chili and lemon.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Grilled Tilapia',
                'menu_id' => $menu2->id,
                'type' => MenuItem::NONVEG,
                'price' => 4000,
                'item_category_id' => $categoryGrill->id,
                'image' => 'grilled-tilapia.webp',
                'description' => 'Whole tilapia from Lake Kivu, grilled with herbs and served with piri-piri sauce.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Ugali (Maize Cake)',
                'menu_id' => $menu2->id,
                'type' => MenuItem::VEG,
                'price' => 1000,
                'item_category_id' => $categorySides->id,
                'image' => 'ugali.webp',
                'description' => 'Traditional stiff maize porridge, the staple of East Africa.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Ikinyiga (Rwandan Pumpkin Stew)',
                'menu_id' => $menu2->id,
                'type' => MenuItem::VEG,
                'price' => 2500,
                'item_category_id' => $categoryMain->id,
                'image' => 'ikinyiga.webp',
                'description' => 'Traditional pumpkin stew cooked with beans and leafy greens.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
        ];

        $menu3 = new Menu();
        $menu3->menu_name = 'Ibinyobwa n\'Indyo (Drinks & Snacks)';
        $menu3->branch_id = $branchId;
        $menu3->saveQuietly();

        $menuItems3 = [
            [
                'item_name' => 'Kawa y\'u Rwanda (Rwandan Coffee)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 1500,
                'item_category_id' => $categoryBeverages->id,
                'image' => 'rwandan-coffee.webp',
                'description' => 'Single-origin Arabica from the hills of Rwanda, freshly brewed.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Ikivuguto (Fermented Milk)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 1200,
                'item_category_id' => $categoryBeverages->id,
                'image' => 'ikivuguto.webp',
                'description' => 'Traditional Rwandan fermented yogurt-like drink.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Urwagwa (Banana Beer)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 2000,
                'item_category_id' => $categoryBeverages->id,
                'image' => 'urwagwa.webp',
                'description' => 'Traditional banana beer, a beloved Rwandan brew.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Fanta Orange',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 1000,
                'item_category_id' => $categoryBeverages->id,
                'image' => 'fanta-orange.webp',
                'description' => 'Chilled Fanta Orange, a local favorite.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Mandazi (Fried Dough)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 500,
                'item_category_id' => $categorySnacks->id,
                'image' => 'mandazi.webp',
                'description' => 'Lightly sweetened triangular fried dough, perfect with coffee.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Sambusa (Beef Samosa)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::NONVEG,
                'price' => 800,
                'item_category_id' => $categorySnacks->id,
                'image' => 'sambusa.webp',
                'description' => 'Crispy triangle pastries filled with spiced minced beef.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
            [
                'item_name' => 'Mizuzu (Fried Plantains)',
                'menu_id' => $menu3->id,
                'type' => MenuItem::VEG,
                'price' => 1000,
                'item_category_id' => $categorySnacks->id,
                'image' => 'mizuzu.webp',
                'description' => 'Ripe plantains deep-fried to golden perfection.',
                'preparation_time' => rand(10, 30),
                'branch_id' => $branchId,
                'kot_place_id' => $defaultKotPlaceId,
            ],
        ];

        MenuItem::insert($menuItems1);
        MenuItem::insert($menuItems2);
        MenuItem::insert($menuItems3);

        // Create Modifier Groups
        $modifierGroup1 = new ModifierGroup();
        $modifierGroup1->name = 'Inyangamugayo (Extra Toppings)';
        $modifierGroup1->branch_id = $branchId;
        $modifierGroup1->saveQuietly();

        $modifierGroup2 = new ModifierGroup();
        $modifierGroup2->name = 'Ibyohereza (Dips & Sauces)';
        $modifierGroup2->branch_id = $branchId;
        $modifierGroup2->saveQuietly();

        // Create modifier options
        $modifierOptions = [
            [
                'name' => 'Extra Cheese',
                'modifier_group_id' => $modifierGroup1->id,
                'price' => 500,
                'is_available' => 1,
            ],
            [
                'name' => 'Extra Sauce',
                'modifier_group_id' => $modifierGroup1->id,
                'price' => 300,
                'is_available' => 1,
            ],
            [
                'name' => 'Grilled Onions',
                'modifier_group_id' => $modifierGroup1->id,
                'price' => 400,
                'is_available' => 1,
            ],
            [
                'name' => 'Akabanga (Rwandan Hot Sauce)',
                'modifier_group_id' => $modifierGroup2->id,
                'price' => 200,
                'is_available' => 1,
            ],
            [
                'name' => 'Kachumbari (African Salsa)',
                'modifier_group_id' => $modifierGroup2->id,
                'price' => 300,
                'is_available' => 1,
            ],
            [
                'name' => 'Piri-Piri Sauce',
                'modifier_group_id' => $modifierGroup2->id,
                'price' => 250,
                'is_available' => 1,
            ],
            [
                'name' => 'Mint Chutney',
                'modifier_group_id' => $modifierGroup2->id,
                'price' => 200,
                'is_available' => 1,
            ],
            [
                'name' => 'Tamarind Sauce',
                'modifier_group_id' => $modifierGroup2->id,
                'price' => 300,
                'is_available' => 1,
            ],
        ];

        foreach ($modifierOptions as $option) {
            $modifierOption = new ModifierOption();
            $modifierOption->name = $option['name'];
            $modifierOption->modifier_group_id = $option['modifier_group_id'];
            $modifierOption->price = $option['price'];
            $modifierOption->is_available = $option['is_available'];
            $modifierOption->saveQuietly();
        }

        $menuItems = MenuItem::whereIn('item_name', ['Sambusa (Beef Samosa)', 'Mizuzu (Fried Plantains)'])
            ->where('branch_id', $branchId)
            ->get()
            ->keyBy('item_name');

        if (isset($menuItems['Sambusa (Beef Samosa)'])) {
            $menuItems['Sambusa (Beef Samosa)']->modifierGroups()->attach($modifierGroup2->id);
        }

        if (isset($menuItems['Mizuzu (Fried Plantains)'])) {
            $menuItems['Mizuzu (Fried Plantains)']->modifierGroups()->attach([
                $modifierGroup1->id,
                $modifierGroup2->id,
            ]);
        }
    }
}
