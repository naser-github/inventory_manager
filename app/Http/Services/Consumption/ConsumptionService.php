<?php

namespace App\Http\Services\Consumption;


use App\Models\Consumption;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

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

    public function add()
    {
        return Stock::query()
            ->with('item')
            ->get();
    }

    public function store($payload)
    {
        $consumption = new Consumption();
        $consumption->consumption_date = $payload['consumption_date'];
        $consumption->item_id = $payload['item_id'];
        $consumption->quantity = $payload['consume'];
        $consumption->location_id = $payload['location_id'];
        $consumption->user_id = Auth::id();
        $consumption->save();
    }

    public function updateStock($payload)
    {
        $message = null;

        $itemExist = Stock::query()
            ->where('location_id', $payload['location_id'])
            ->where('item_id', $payload['item_id'])
            ->first();

        if ($itemExist && $itemExist->quantity>=$payload['consume']) {
            $itemExist->quantity -= $payload['consume'];
            $itemExist->save();
        }else{
            $message = 'item quantity is insufficient';
        }

        return $message;

    }
}
