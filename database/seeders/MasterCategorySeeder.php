<?php

namespace Database\Seeders;

use App\Models\Setting\MasterCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // master category 1
        $master_category_1 = new MasterCategory();
        $master_category_1->name = 'Electronic';
        $master_category_1->save();

        // master category 2
        $master_category_2 = new MasterCategory();
        $master_category_2->name = 'Fashoin';
        $master_category_2->save();

    }
}
