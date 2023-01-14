<?php

namespace App\Http\Services\Consumption;


use App\Models\Consumption;
use App\Models\Stock;

class ConsumptionService
{

    public function index($date, $location)
    {
        $consumptions = Consumption::query();
        if ($location) {
            $consumptions = $consumptions->where('location_id', $location);
        }
        return $consumptions->with(['item'])
            ->whereBetween('consumption_date', $date)
            ->get();
    }

    public function add(){
        return Stock::query()
            ->with('item')
            ->get();
    }
}
