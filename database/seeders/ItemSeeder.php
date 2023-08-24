<?php

namespace Database\Seeders;

use App\Models\Setting\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // item 1
        $item_1 = new Item();
        $item_1->name = 'Dell';
        $item_1->unit = 'Pcs';
        $item_1->master_category_id = 1;
        $item_1->level_one_category_id = 1;
        $item_1->level_two_category_id = 2;
        $item_1->save();

        // item 2
        $item_2 = new Item();
        $item_2->name = 'Hp';
        $item_2->unit = 'Pcs';
        $item_2->master_category_id = 1;
        $item_2->level_one_category_id = 1;
        $item_2->level_two_category_id = 2;
        $item_2->save();

        // item 3
        $item_3 = new Item();
        $item_3->name = 'Lenovo';
        $item_3->unit = 'Pcs';
        $item_3->master_category_id = 1;
        $item_3->level_one_category_id = 1;
        $item_3->level_two_category_id = 2;
        $item_3->save();

        // item 4
        $item_4 = new Item();
        $item_4->name = 'Mac';
        $item_4->unit = 'Pcs';
        $item_4->master_category_id = 1;
        $item_4->level_one_category_id = 1;
        $item_4->level_two_category_id = 2;
        $item_4->save();
    }
}
