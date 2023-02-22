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
    public function openingStock($dates, $location_id)
    {
        $inbound = PurchaseInbound::query()
            ->whereBetween('purchase_inbounds.raised_date', $dates)
            ->where('purchase_inbounds.location_id', '=', $location_id)
            ->leftJoin('purchase_inbound_items', 'purchase_inbound_items.purchase_inbound_id', '=', 'purchase_inbounds.id')
            ->leftJoin('items', 'items.id', '=', 'purchase_inbound_items.item_id')
            ->selectRaw("
                items.id as item_id, items.name as item_name, items.unit as item_unit,
                0 as opening_quantity, 0 as opening_unit_price,
                SUM(purchase_inbound_items.quantity) as inbound_quantity,
                SUM(purchase_inbound_items.total) / SUM(purchase_inbound_items.quantity) as inbound_unit_price,
                0 as consumption_quantity,
                'inbound' as type
            ")
            ->groupBy('purchase_inbound_items.item_id');

        $consumption = Consumption::query()
            ->whereBetween('consumption_date', $dates)
            ->where('location_id', '=', $location_id)
            ->leftJoin('items', 'items.id', '=', 'consumptions.item_id')
            ->selectRaw("
                items.id as item_id, items.name as item_name, items.unit as item_unit,
                0 as opening_quantity, 0 as opening_unit_price,
                0 as inbound_quantity, 0 as inbound_unit_price,
                SUM(consumptions.quantity) as consumption_quantity,
                'consumption' as type
            ")
            ->groupBy('consumptions.item_id');

        return StockHistory::query()
            ->whereDate('stock_histories.created_at', '=', $dates[0])
            ->leftJoin('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
            ->leftJoin('items', 'items.id', '=', 'stocks.item_id')
            ->where('stocks.location_id', '=', $location_id)
            ->selectRaw("
                items.id as item_id, items.name as item_name, items.unit as item_unit,
                stock_histories.quantity as opening_quantity, stock_histories.unit_price as opening_unit_price,
                0 as inbound_quantity, 0 as inbound_unit_price,
                0 as consumption_quantity,
                'stock' as type

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

                    'inbound_quantity' => (isset($item[0]) && $item[0]->type == 'inbound') ?
                        $item[0]->inbound_quantity : (
                        (isset($item[1]) && $item[1]->type == 'inbound') ? $item[1]->inbound_quantity : null
                        ),
                    'inbound_unit_price' => (isset($item[0]) && $item[0]->type == 'inbound') ?
                        $item[0]->inbound_unit_price : (
                        (isset($item[1]) && $item[1]->type == 'inbound') ? $item[1]->inbound_unit_price : null
                        ),

                    'consumption_quantity' => (isset($item[0]) && $item[0]->type == 'consumption') ?
                        $item[0]->consumption_quantity : (
                        (isset($item[1]) && $item[1]->type == 'consumption') ? $item[1]->consumption_quantity :
                            (isset($item[2]) && $item[2]->type == 'consumption' ? $item[2]->consumption_quantity : null)
                        ),
                ];
            });
    }
}
