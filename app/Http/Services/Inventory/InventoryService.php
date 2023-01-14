<?php

namespace App\Http\Services\Inventory;


use App\Models\Stock;
use App\Models\StockHistory;

class InventoryService
{
    public function index()
    {
        return Stock::query()
            ->with('item')
            ->get();
    }

    public function history($date)
    {
        return StockHistory::query()
            ->with(['stock.item'])
            ->whereHas('stock', function ($query) {
                $query->where('location_id', '=', 1);
            })
            ->whereDate('created_at', $date)
            ->get();
    }
}
