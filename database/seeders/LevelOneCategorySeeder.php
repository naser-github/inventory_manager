<?php

namespace Database\Seeders;

use App\Models\Setting\LevelOneCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelOneCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // level one category 1
        $level_one_category_1 = new LevelOneCategory();
        $level_one_category_1->name = 'Computer';
        $level_one_category_1->master_category_id = 1;
        $level_one_category_1->save();

        // level one category 2
        $level_one_category_2 = new LevelOneCategory();
        $level_one_category_2->name = 'Clothing';
        $level_one_category_2->master_category_id = 2;
        $level_one_category_2->save();
    }
}
