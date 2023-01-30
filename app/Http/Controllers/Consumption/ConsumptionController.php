<?php

namespace App\Http\Controllers\Consumption;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\FilterbyDateAndLocation;
use App\Http\Requests\Consumption\ConsumptionStoreRequest;
use App\Http\Services\Consumption\ConsumptionService;
use App\Http\Services\Inventory\InventoryService;
use App\Http\Services\Purchase\PurchaseInboundService;
use App\Http\Services\setting\LocationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ConsumptionController extends Controller
{
    /**
     * @param FilterbyDateAndLocation $request
     * @param ConsumptionService $consumptionService
     * @param LocationService $locationService
     * @return Factory|View|Application
     */
    public function index(FilterbyDateAndLocation $request, ConsumptionService $consumptionService, LocationService $locationService): Factory|View|Application
    {
        $validated = $request->validated();

        if (array_key_exists('date', $validated)) {
            $date = explode(' - ', $validated['date']);
            $date = [date('Y-m-d', strtotime($date[0])), date('Y-m-d', strtotime($date[1]))];
        } else $date = [Carbon::now()->subDay(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')];

        $location = array_key_exists('location', $validated) ? $validated['location'] : null;

        $consumptions = $consumptionService->index($date, $location);
        $locations = $locationService->locationList();
        return view('pages.consumption.index', compact('consumptions', 'locations'));
    }

    /**
     * @param LocationService $locationService
     * @return Factory|View|Application
     */
    public function add(LocationService $locationService): Factory|View|Application
    {
        $locations = $locationService->locationList();

        return view('pages.consumption.add', compact('locations'));
    }

    /**
     * @param Request $request
     * @param InventoryService $inventoryService
     * @return Factory|View|Application
     */
    public function consumption_portal(Request $request, InventoryService $inventoryService): Factory|View|Application
    {
        $validated = $request->validate([
            'location_id' => ['required', 'integer', Rule::exists("locations", "id")],
        ]);

        $location_id = $validated['location_id'];
        $items = $inventoryService->index($location_id);

        return view('pages.consumption.consumption_portal', compact('items', 'location_id'));
    }

    /**
     * @param ConsumptionStoreRequest $request
     * @param ConsumptionService $consumptionService
     * @return RedirectResponse
     */
    public function store(ConsumptionStoreRequest $request, ConsumptionService $consumptionService): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $consumptionService->store($validated);
            $message = $consumptionService->updateStock($validated);
            if ($message) return redirect()->back()->with('error', $message);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->back()->with('error', 'Process failed try again!!');
        }
        return redirect()->back()->with('success', 'Consumption Successful');
    }

    public function destroy($id, ConsumptionService $consumptionService, PurchaseInboundService $purchaseInboundService)
    {
        $consumption = $consumptionService->findById($id);

        if ($consumption) {
            $already_inbounded = $purchaseInboundService->already_Inbounded(
                $consumption->item_id, $consumption->location_id, $consumption->updated_at
            );
            if (!$already_inbounded) {
                DB::beginTransaction();
                try {
                    $consumptionService->returnStock($consumption);
                    $consumptionService->destroy($id);
                    DB::commit();
                } catch (\Exception $error) {
                    DB::rollback();
                }
                return redirect()->back()->with('success', 'Consumption Deleted');
            }
        }
        return redirect()->back()->with('error', 'Permission Denied!!');
    }
}
