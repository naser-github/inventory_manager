<?php

namespace Database\Seeders;

use App\Models\Setting\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Location 1
        $location_1 = new Location();
        $location_1->name = 'Dhaka';
        $location_1->description = 'central warehouse';
        $location_1->save();

        // Location 2
        $location_2 = new Location();
        $location_2->name = 'Chittagong';
        $location_2->description = 'port warehouse';
        $location_2->save();
    }
}
