<?php

namespace App\Http\Controllers\Consumption;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\FilterbyDateAndLocation;
use App\Http\Services\Consumption\ConsumptionService;
use App\Http\Services\setting\LocationService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    public function add(ConsumptionService $consumptionService)
    {
        $items = $consumptionService->add();

        return view('pages.consumption.add',compact('items'));
    }


}
