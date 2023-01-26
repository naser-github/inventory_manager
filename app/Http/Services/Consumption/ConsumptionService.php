<?php

namespace App\Http\Services\Consumption;


use App\Models\Consumption;
use App\Models\Stock;
use Carbon\Carbon;
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
        $consumptionItemsArray = array();
        $time = Carbon::now();
        $user_id = Auth::id();

        $consumptionItem['consumption_date'] = date('Y-m-d', strtotime($payload['consumption_date']));
        $consumptionItem['received_by'] = $payload['name'];
        $consumptionItem['location_id'] = $payload['location_id'];
        $consumptionItem['user_id'] = $user_id;
        $consumptionItem['created_at'] = $time;
        $consumptionItem['updated_at'] = $time;

        foreach ($payload['consumption_data'] as $item) {
            $consumptionItem['item_id'] = $item['item_id'];
            $consumptionItem['quantity'] = $item['quantity'];
            $consumptionItem['unit_price'] = $item['unit_price'];

            $consumptionItemsArray[] = $consumptionItem;
        }
        Consumption::insert($consumptionItemsArray);
    }

    public function updateStock($payload)
    {
        $message = null;

        foreach ($payload['consumption_data'] as $item) {
            $itemExist = Stock::query()
                ->where('location_id', $payload['location_id'])
                ->where('item_id', $item['item_id'])
                ->first();

            if ($itemExist && $itemExist->quantity >= $item['quantity']) {
                $itemExist->quantity -= $item['quantity'];
                $itemExist->save();
            } else {
                $message = 'item quantity is insufficient';
                break;
            }
        }

        return $message;

    }
}
