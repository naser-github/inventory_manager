<?php

use App\Http\Controllers\Settings\CategoryController;
use App\Http\Controllers\Settings\ItemController;
use App\Http\Controllers\Settings\LocationController;
use App\Http\Controllers\Settings\PermissionController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\VendorController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);

Route::resource('permissions', PermissionController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resources([

    //setting
    'categories' => CategoryController::class,
    'items' => ItemController::class,
    'locations' => LocationController::class,
    'vendors' => VendorController::class,

    // system settings
    'roles' => RoleController::class,
    'users' => UserController::class,
]);
