<?php

namespace App\Http\Services;


use App\Models\Consumption;
use App\Models\PurchaseInbound;
use App\Models\PurchaseInboundItem;
use App\Models\Stock;
use App\Models\StockHistory;
use Carbon\Carbon;
use Rakibhstu\Banglanumber\NumberToBangla;

class DashboardService
{
    public function openingStock($location_id)
    {
        $date = Carbon::now()->subDay(1)->format('Y-m-d');
        $today = Carbon::now();

        $inbound = PurchaseInbound::query()
            ->whereDate('raised_date', '=', $today)
            ->leftJoin('purchase_inbound_items', 'purchase_inbound_items.purchase_inbound_id', '=', 'purchase_inbounds.id')
            ->selectRaw("
                purchase_inbound_items.item_id as item_id, null as item_name, null as item_unit,
                0 as opening_quantity, 0 as opening_unit_price,
                SUM(purchase_inbound_items.quantity) as inbound_quantity,
                SUM(purchase_inbound_items.quantity * purchase_inbound_items.unit_price) / COUNT(purchase_inbound_items.item_id) as inbound_unit_price,
                0 as consumption_quantity
            ")
            ->groupBy('purchase_inbound_items.item_id');

        $consumption = Consumption::query()
            ->whereDate('consumption_date', '=', $today)
            ->selectRaw("
                consumptions.item_id as item_id, null as item_name, null as item_unit,
                0 as opening_quantity, 0 as opening_unit_price,
                0 as inbound_quantity, 0 as inbound_unit_price,
                SUM(consumptions.quantity) as consumption_quantity
            ")
            ->groupBy('consumptions.item_id');

        return StockHistory::query()
            ->whereDate('stock_histories.created_at', '=', $date)
            ->leftJoin('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
            ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
            ->where('stocks.location_id', '=', $location_id)
            ->selectRaw("
                items.id as item_id, items.name as item_name, unit as item_unit,
                stock_histories.quantity as opening_quantity, stock_histories.unit_price as opening_unit_price,
                0 as inbound_quantity, 0 as inbound_unit_price,
                0 as consumption_quantity
            ")
            ->union($inbound)
            ->union($consumption)
            ->get()
            ->groupBy('item_id')
            ->map(function ($item) {
                return [
                    'item_id' => isset($item[0]) ? $item[0]->item_id : null,
                    'item_name' => isset($item[0]) ? $item[0]->item_name : null,
                    'item_unit' => isset($item[0]) ? $item[0]->item_unit : null,
                    'opening_quantity' => isset($item[0]) ? $item[0]->opening_quantity : null,
                    'opening_unit_price' => isset($item[0]) ? $item[0]->opening_unit_price : null,
                    'inbound_quantity' => isset($item[1]) ? $item[1]->inbound_quantity : null,
                    'inbound_unit_price' => isset($item[1]) ? $item[1]->inbound_unit_price : null,
                    'consumption_quantity' => isset($item[2]) ? $item[2]->consumption_quantity : null,
                ];
            });
    }
}
