<?php

use App\Http\Controllers\Settings\Category\LevelOneCategoryController;
use App\Http\Controllers\Settings\Category\LevelTwoCategoryController;
use App\Http\Controllers\Settings\Category\MasterCategoryController;
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


//Begin::Settings
Route::get('/categories', function () {
    return view('pages.settings.category.index');
})->name('categories.index');

Route::prefix('/category')->group(function () {
    Route::resource('master-categories', MasterCategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    Route::resource('level-one-categories', LevelOneCategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    Route::resource('level-two-categories', LevelTwoCategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
});


Route::resource('permissions', PermissionController::class)->only([
    'index', 'store', 'destroy'
]);

Route::resource('vendors', VendorController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

Route::prefix('/modal')->group(function () {
    Route::post('/master-category-edit', [MasterCategoryController::class, 'edit'])->name('modal.master_category.edit');
    Route::post('/level-one-category-edit', [LevelOneCategoryController::class, 'edit'])->name('modal.level_one_category.edit');
    Route::post('/level-two-category-edit', [LevelTwoCategoryController::class, 'edit'])->name('modal.level_two_category.edit');

    Route::post('/vendor-edit', [VendorController::class, 'edit'])->name('modal.vendors.edit');
});

Route::resources([
    //setting
    'items' => ItemController::class,
    'locations' => LocationController::class,
    'vendors' => VendorController::class,

    // system settings
    'roles' => RoleController::class,
    'users' => UserController::class,
]);

//End::Settings
