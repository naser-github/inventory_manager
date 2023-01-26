<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function test()
    {
//        $location_id = 1;
//        $search_value = 'l';
//
//        return Stock::query()
//            ->with(['item'])
//            ->whereHas('item', function ($query) use ($search_value) {
//                $query->where('name', 'LIKE', "%{$search_value}%");
//            })
//            ->where('location_id', '=', $location_id)
//            ->limit(5)->get();
    }
}
