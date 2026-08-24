<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\GlobalCurrency;
use Illuminate\Database\Seeder;
use App\Enums\PackageType;
use App\Scopes\ModuleScope;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $currencyID = GlobalCurrency::where('currency_code', 'RWF')->first()->id
            ?? GlobalCurrency::first()->id;

        $allAdmin = Module::withoutGlobalScope(ModuleScope::class)
            ->where('is_superadmin', 0)
            ->get();
        $byName = $allAdmin->keyBy('name');

        $idsFor = fn($names) => collect($names)
            ->map(fn($n) => optional($byName[$n])->id)
            ->filter()
            ->values()
            ->toArray();

        $core = ['Menu', 'Menu Item', 'Item Category', 'Area', 'Table', 'KOT', 'Order', 'Customer', 'Staff', 'Report', 'Payment', 'Settings'];
        $growth = array_merge($core, ['Reservation', 'Delivery Executive', 'Waiter Request', 'Expense']);
        $enterprise = $allAdmin->pluck('name')->toArray();

        // --- Default (system) package ---
        $default = Package::updateOrCreate(
            ['package_name' => 'Default'],
            [
                'description' => 'Its a default package and cannot be deleted',
                'currency_id' => $currencyID,
                'monthly_status' => 0,
                'annual_status' => 0,
                'annual_price' => null,
                'monthly_price' => null,
                'price' => 0,
                'is_free' => 1,
                'billing_cycle' => 12,
                'sort_order' => 1,
                'is_private' => 0,
                'is_recommended' => 0,
                'package_type' => PackageType::DEFAULT,
            ]
        );
        $default->modules()->sync($allAdmin->pluck('id')->toArray());

        // --- Trial package ---
        $trial = Package::updateOrCreate(
            ['package_name' => 'Trial Package'],
            [
                'description' => 'This is a trial package',
                'currency_id' => $currencyID,
                'monthly_status' => 0,
                'annual_status' => 0,
                'annual_price' => null,
                'monthly_price' => null,
                'price' => 0,
                'is_free' => 1,
                'billing_cycle' => 0,
                'sort_order' => null,
                'is_private' => 0,
                'is_recommended' => 0,
                'additional_features' => json_encode(Package::ADDITIONAL_FEATURES),
                'package_type' => PackageType::TRIAL,
                'trial_days' => 30,
                'trial_status' => 1,
                'trial_notification_before_days' => 5,
                'trial_message' => '30 Days Free Trial',
            ]
        );
        $trial->modules()->sync($allAdmin->pluck('id')->toArray());

        // --- Market tiers (Rwanda-first, multi-currency) ---
        $tiers = [
            'Starter' => [
                'description' => 'For a single location getting going.',
                'monthly' => 12000, 'annual' => 120000,
                'branch_limit' => 1, 'staff_limit' => 3, 'menu_items_limit' => 50,
                'order_limit' => -1, 'multipos_limit' => 0, 'ai_monthly_request_limit' => 1000,
                'is_recommended' => 0, 'modules' => $core, 'sort_order' => 2,
                'prices' => [
                    'RWF' => [12000, 120000], 'TZS' => [30000, 300000], 'UGX' => [35000, 350000],
                    'KES' => [1100, 11000], 'BIF' => [30000, 300000], 'USD' => [9.99, 99],
                ],
            ],
            'Growth' => [
                'description' => 'For multi-branch restaurants ready to scale.',
                'monthly' => 39000, 'annual' => 390000,
                'branch_limit' => 5, 'staff_limit' => 15, 'menu_items_limit' => 500,
                'order_limit' => -1, 'multipos_limit' => 1, 'ai_monthly_request_limit' => 5000,
                'is_recommended' => 1, 'modules' => $growth, 'sort_order' => 3,
                'prices' => [
                    'RWF' => [39000, 390000], 'TZS' => [95000, 950000], 'UGX' => [110000, 1100000],
                    'KES' => [3500, 35000], 'BIF' => [95000, 950000], 'USD' => [32.99, 329],
                ],
            ],
            'Enterprise' => [
                'description' => 'For groups, franchises and chains.',
                'monthly' => 99000, 'annual' => 990000,
                'branch_limit' => -1, 'staff_limit' => -1, 'menu_items_limit' => -1,
                'order_limit' => -1, 'multipos_limit' => 1, 'ai_monthly_request_limit' => -1,
                'is_recommended' => 0, 'modules' => $enterprise, 'sort_order' => 4,
                'prices' => [
                    'RWF' => [99000, 990000], 'TZS' => [240000, 2400000], 'UGX' => [280000, 2800000],
                    'KES' => [9000, 90000], 'BIF' => [240000, 2400000], 'USD' => [79.99, 799],
                ],
            ],
        ];

        foreach ($tiers as $name => $cfg) {
            $package = Package::updateOrCreate(
                ['package_name' => $name],
                [
                    'description' => $cfg['description'],
                    'currency_id' => $currencyID,
                    'monthly_status' => 1,
                    'annual_status' => 1,
                    'monthly_price' => $cfg['monthly'],
                    'annual_price' => $cfg['annual'],
                    'price' => 0,
                    'is_free' => 0,
                    'billing_cycle' => 12,
                    'sort_order' => $cfg['sort_order'],
                    'is_private' => 0,
                    'is_recommended' => $cfg['is_recommended'],
                    'additional_features' => json_encode(Package::ADDITIONAL_FEATURES),
                    'package_type' => PackageType::STANDARD,
                    'branch_limit' => $cfg['branch_limit'],
                    'staff_limit' => $cfg['staff_limit'],
                    'menu_items_limit' => $cfg['menu_items_limit'],
                    'order_limit' => $cfg['order_limit'],
                    'multipos_limit' => $cfg['multipos_limit'],
                    'ai_monthly_token_limit' => $cfg['ai_monthly_request_limit'],
                ]
            );

            $package->modules()->sync($idsFor($cfg['modules']));

            // (Re)create localized prices
            $package->prices()->delete();
            foreach ($cfg['prices'] as $code => [$m, $a]) {
                PackagePrice::create([
                    'package_id' => $package->id,
                    'currency_code' => $code,
                    'monthly_price' => $m,
                    'annual_price' => $a,
                ]);
            }
        }
    }
}
