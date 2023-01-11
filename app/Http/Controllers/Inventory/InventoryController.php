<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Services\Inventory\InventoryService;
use App\Http\Services\setting\LocationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request, LocationService $locationService, InventoryService $inventoryService)
    {

        $validated = $request->validate([
            'date' => ['bail', 'nullable'],
            'location' => ['bail', 'nullable'],
        ]);

        $date = date('Y-m-d', strtotime($validated['date']));

        if (array_key_exists('date', $validated) && strtotime(Carbon::now()) > strtotime($date)) {
            $inventory = $inventoryService->history($date);
        }else{
            $inventory = $inventoryService->index();
        }
        $locations = $locationService->locationList();

        return view('pages.inventory.index', compact('inventory', 'locations'));
    }
}
