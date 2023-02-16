<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\FilterbyDateAndLocation;
use App\Http\Services\DashboardService;
use App\Http\Services\setting\LocationService;
use App\Http\Traits\HelperFunctionTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rakibhstu\Banglanumber\NumberToBangla;

class DashboardController extends Controller
{
    use HelperFunctionTrait;

    public function index(FilterbyDateAndLocation $request, DashboardService $dashboardService, LocationService $locationService)
    {
        $bangla_number = new NumberToBangla();
        $exportable = false;
        $stock_report_data = array();

        $validated = $request->validated();

        $dates = $this->extract_dates_from_date_range($validated);
        $location_id = array_key_exists('location', $validated) ? $validated['location'] : null;

        if ($location_id != null) {
            $exportable = true;
            $stock_report = $dashboardService->openingStock($dates, $location_id);
            foreach ($stock_report as $item) $stock_report_data[] = $item;
        }

        $locations = $locationService->locationList();

        return view('pages.dashboard.index', compact(
            'bangla_number', 'exportable', 'locations', 'stock_report_data',
        ));
    }

    public function export(Request $request, DashboardService $dashboardService,)
    {
        $validated = $request->validate([
            'date' => ['required'],
            'location' => ['required'],
        ]);

        $stock_report_data = array();

        $dates = $this->extract_dates_from_date_range($validated);
        $location_id = $validated['location'];

        $stock_report = $dashboardService->openingStock($dates, $location_id);
        foreach ($stock_report as $item) $stock_report_data[] = $item;

        return Excel::download(new ReportExport($stock_report_data), 'report.xlsx');
    }
}
