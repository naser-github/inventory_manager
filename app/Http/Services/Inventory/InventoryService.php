<?php

namespace App\Http\Services\Inventory;


use App\Models\Stock;
use App\Models\StockHistory;

class InventoryService
{
    public function index($location)
    {
        return Stock::query()
            ->with('item')
            ->where('location_id', '=', $location)
            ->get();
    }

    public function history($date, $location)
    {
        return StockHistory::query()
            ->with(['stock.item'])
            ->whereHas('stock', function ($query) use ($location) {
                $query->where('location_id', '=', $location);
            })
            ->whereDate('created_at', $date)
            ->get();
    }
}
