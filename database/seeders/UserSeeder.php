<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Operator
        $user = new User();
        $user->name = 'Super Operator';
        $user->email = 'superOperator@gmail.com';
        $user->password = Hash::make('Im#123456');
        $user->save();
    }
}
