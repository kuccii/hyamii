<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run($restaurant): void
    {
        $currencies = [
            [
                'currency_name' => 'Rwanda Franc',
                'currency_symbol' => 'FRw',
                'currency_code' => 'RWF',
                'restaurant_id' => $restaurant->id,
                'currency_position' => 'left',
                'no_of_decimal' => 0,
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'currency_name' => 'Dollars',
                'currency_symbol' => '$',
                'currency_code' => 'USD',
                'restaurant_id' => $restaurant->id,
                'currency_position' => 'left',
                'no_of_decimal' => 2,
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'currency_name' => 'Pounds',
                'currency_symbol' => '£',
                'currency_code' => 'GBP',
                'restaurant_id' => $restaurant->id,
                'currency_position' => 'left',
                'no_of_decimal' => 2,
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'currency_name' => 'Euros',
                'currency_symbol' => '€',
                'currency_code' => 'EUR',
                'restaurant_id' => $restaurant->id,
                'currency_position' => 'left',
                'no_of_decimal' => 2,
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Currency::insert($currencies);

        // Set the restaurant's currency_id to the RWF currency
        $rwfCurrency = Currency::where('restaurant_id', $restaurant->id)
            ->where('currency_code', 'RWF')
            ->first();

        if ($rwfCurrency) {
            $restaurant->currency_id = $rwfCurrency->id;
            $restaurant->save();
        }
    }
}
