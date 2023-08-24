<?php

namespace Database\Seeders;

use App\Models\Setting\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vendor 1
        $vendor_1 = new Vendor();
        $vendor_1->name = 'Vendor 1';
        $vendor_1->save();

        // Vendor 2
        $vendor_2 = new Vendor();
        $vendor_2->name = 'Vendor 2';
        $vendor_2->save();

        // Vendor 3
        $vendor_3 = new Vendor();
        $vendor_3->name = 'Vendor 3';
        $vendor_3->save();

        // Vendor 4
        $vendor_4 = new Vendor();
        $vendor_4->name = 'Vendor 4';
        $vendor_4->save();
    }
}
