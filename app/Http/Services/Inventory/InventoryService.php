<?php

namespace App\Http\Services\Inventory;



use App\Models\Stock;
use App\Models\StockHistory;

class InventoryService
{
    public function index(){
        return Stock::query()->with('item')->get();
    }

    public function history($date){
        return StockHistory::query()
            ->with(['stock.item'])
            ->whereDate('created_at',$date)
            ->get();
    }

}
