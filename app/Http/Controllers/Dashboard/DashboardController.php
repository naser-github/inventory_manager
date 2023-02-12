<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use App\Http\Services\setting\LocationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rakibhstu\Banglanumber\NumberToBangla;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService, LocationService $locationService)
    {
        $locations = $locationService->locationList();

        $bangla_number = new NumberToBangla();
        $location_id = 1;

        $stock_report = $dashboardService->openingStock($location_id);

        $stock_report_data = array();

        foreach ($stock_report as $item) {
            $stock_report_data[] = $item;
        }

        return view('pages.dashboard.index', compact('locations', 'stock_report_data', 'bangla_number'));
    }
}
