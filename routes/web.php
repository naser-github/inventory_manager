<?php

use App\Http\Controllers\Consumption\ConsumptionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Inventory\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Purchase\PurchaseInboundController;
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


Route::get('/test', [TestController::class, 'test']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Begin::Dashboard
    Route::prefix('/')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/export-report', [DashboardController::class, 'export'])->name('export.report');
    });
    // End::Dashboard

    // Begin::Purchase
    Route::prefix('/purchase-inbound')->group(function () {
        Route::get('/index', [PurchaseInboundController::class, 'index'])->name('purchase_inbound.index');

        Route::get('/create', [PurchaseInboundController::class, 'create'])->name('purchase_inbound.create');
        Route::post('/store', [PurchaseInboundController::class, 'store'])->name('purchase_inbound.store');

        Route::patch('/approve/{id}', [PurchaseInboundController::class, 'approve'])->name('purchase_inbound.approve');
        Route::patch('/cancel/{id}', [PurchaseInboundController::class, 'cancel'])->name('purchase_inbound.cancel');

        Route::get('/show/{id}', [PurchaseInboundController::class, 'show'])->name('purchase_inbound.show');

        Route::delete('/delete/{id}', [PurchaseInboundController::class, 'destroy'])->name('purchase_inbound.destroy');
    });
    // End::Purchase

    // Begin::Inventory
    Route::prefix('/inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    });
    // End::Inventory

    // Begin::Inventory
    Route::prefix('/consumption')->group(function () {
        Route::get('/index', [ConsumptionController::class, 'index'])->name('consumption.index');

        Route::get('/add', [ConsumptionController::class, 'add'])->name('consumption.add');
        Route::post('/consumption_portal', [ConsumptionController::class, 'consumption_portal'])->name('consumption.consumption_portal');
        Route::post('/store', [ConsumptionController::class, 'store'])->name('consumption.store');

        Route::delete('/delete/{id}', [ConsumptionController::class, 'destroy'])->name('consumption.destroy');
    });
    // End::Inventory


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

    Route::resources([
        //setting
        'items' => ItemController::class,
        'locations' => LocationController::class,

        // system settings
        'roles' => RoleController::class,
        'users' => UserController::class,
    ]);

    Route::prefix('/modal')->group(function () {
        // add
        Route::prefix('/add')->group(function () {
            Route::get('/level-one-category', [LevelOneCategoryController::class, 'create'])->name('modal.level_one_category.add');
            Route::get('/level-two-category', [LevelTwoCategoryController::class, 'create'])->name('modal.level_two_category.add');
        });

        // edit
        Route::prefix('/edit')->group(function () {
            Route::post('/master-category', [MasterCategoryController::class, 'edit'])->name('modal.master_category.edit');
            Route::post('/level-one-category', [LevelOneCategoryController::class, 'edit'])->name('modal.level_one_category.edit');
            Route::post('/level-two-category', [LevelTwoCategoryController::class, 'edit'])->name('modal.level_two_category.edit');

            Route::post('/location', [LocationController::class, 'edit'])->name('modal.locations.edit');
            Route::post('/vendor', [VendorController::class, 'edit'])->name('modal.vendors.edit');
        });
    });
    //End::Settings
});

require __DIR__ . '/auth.php';
