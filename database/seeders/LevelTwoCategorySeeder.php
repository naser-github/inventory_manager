<?php

namespace Database\Seeders;

use App\Models\Setting\LevelTwoCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelTwoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // level two category 1
        $level_two_category_1 = new LevelTwoCategory();
        $level_two_category_1->name = 'Desktop';
        $level_two_category_1->master_category_id = 1;
        $level_two_category_1->level_one_category_id = 1;
        $level_two_category_1->save();

        // level two category 2
        $level_two_category_2 = new LevelTwoCategory();
        $level_two_category_2->name = 'Laptop';
        $level_two_category_2->master_category_id = 1;
        $level_two_category_2->level_one_category_id = 1;
        $level_two_category_2->save();

        // level two category 3
        $level_two_category_3 = new LevelTwoCategory();
        $level_two_category_3->name = 'Men';
        $level_two_category_3->master_category_id = 2;
        $level_two_category_3->level_one_category_id = 2;
        $level_two_category_3->save();

        // level two category 4
        $level_two_category_4 = new LevelTwoCategory();
        $level_two_category_4->name = 'Women';
        $level_two_category_4->master_category_id = 2;
        $level_two_category_4->level_one_category_id = 2;
        $level_two_category_4->save();
    }
}
