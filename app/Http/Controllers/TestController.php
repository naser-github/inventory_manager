<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInboundItem;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function test()
    {
        $consumption_time = '2023-01-29 15:23:26';
        $item_id = 1;
        $location_id = 1;

        return PurchaseInboundItem::query()
            ->whereHas('purchaseInbound', function ($query) use ($location_id) {
                $query->where('location_id', '=', $location_id);
            })
            ->where('item_id', $item_id)
            ->where('updated_at', '>=', $consumption_time)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
