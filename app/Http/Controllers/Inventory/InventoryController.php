<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\FilterbyDateAndLocation;
use App\Http\Services\Inventory\InventoryService;
use App\Http\Services\setting\LocationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InventoryController extends Controller
{
    /**
     * @param FilterbyDateAndLocation $request
     * @param LocationService $locationService
     * @param InventoryService $inventoryService
     * @return Factory|View|Application
     */
    public function index(FilterbyDateAndLocation $request, LocationService $locationService, InventoryService $inventoryService): Factory|View|Application
    {
        $validated = $request->validated();

        if (array_key_exists('date', $validated)) {
            $current_date = Carbon::now()->format('Y-m-d');
            $date = date('Y-m-d', strtotime($validated['date']));

            if (strtotime($current_date) > strtotime($date)) {
                $inventory = $inventoryService->history($date);
            } else $inventory = $inventoryService->index();

        } else $inventory = $inventoryService->index();
        $locations = $locationService->locationList();

        return view('pages.inventory.index', compact( 'inventory', 'locations'));
    }
}
