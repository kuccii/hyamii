<?php

namespace Database\Seeders;

use App\Models\DeliveryExecutive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryExecutiveSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run($branch): void
    {
        $names = [
            'Jean Claude Habimana', 'Alice Mukamana', 'Patrick Niyonzima',
            'Diane Uwimana', 'Eric Mugisha', 'Grace Nyiraneza',
            'Emmanuel Nkusi', 'Chantal Mukeshimana', 'David Ndagijimana',
            'Joseline Ingabire', 'Olivier Hategekimana'
        ];

        for ($i = 0; $i < count($names); $i++) {
            $customer = new DeliveryExecutive();
            $customer->branch_id = $branch->id;
            $customer->name = $names[$i];
            $customer->email = 'de' . ($i + 1) . '.branch' . $branch->id . '@hyamii.rw';
            $customer->phone = '078' . $branch->id . str_pad((8000000 + $i), 6, '0', STR_PAD_LEFT);
            $customer->phone_code = '250';
            $customer->status = 'available';
            $customer->save();
        }
    }
}
