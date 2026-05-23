<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run($branch): void
    {
        $areas = [
            [
                'area_name' => 'Kicukiro',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Nyarugenge',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Gasabo',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Nyamirambo',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Kimironko',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Remera',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Gisozi',
                'branch_id' => $branch->id,
            ],
            [
                'area_name' => 'Kanombe',
                'branch_id' => $branch->id,
            ],
        ];

        Area::insert($areas);
    }
}
