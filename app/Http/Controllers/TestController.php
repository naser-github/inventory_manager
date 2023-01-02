<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function test(){
        return Role::all('id','name');
    }
}
