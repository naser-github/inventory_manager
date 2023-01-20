<?php

namespace App\Http\Services\Purchase;

use App\Models\PurchaseInbound;
use App\Models\PurchaseInboundItem;
use App\Models\Setting\Item;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PurchaseInboundService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return PurchaseInbound::query()->with('vendor')->orderBy('id','DESC')->get();
    }

    /**
     * @param $payload
     * @param $purchase_inbound_number
     * @return PurchaseInbound
     */
    public function store($payload, $purchase_inbound_number): PurchaseInbound
    {
        $purchase_inbound = new PurchaseInbound();
        $purchase_inbound->raised_date = date('Y-m-d', strtotime($payload['raised_date']));
        $purchase_inbound->purchase_inbound_number = $purchase_inbound_number;
        $purchase_inbound->reference_invoice_number = $payload['reference_invoice_number'];
        $purchase_inbound->sub_total = $payload['sub_total'];
        $purchase_inbound->others = $payload['others'];
        $purchase_inbound->grand_total = $payload['total'];

        $purchase_inbound->location_id = $payload['location_id'];
        $purchase_inbound->user_id = Auth::id();
        $purchase_inbound->vendor_id = $payload['vendor_id'];
        $purchase_inbound->save();

        return $purchase_inbound;
    }

    /**
     * @param $payload
     * @param $purchase_inbound_id
     * @return void
     */
    public function storePurchaseInboundItems($payload, $purchase_inbound_id): void
    {
        foreach ($payload as $item) {
            $purchase_inbound_item = new PurchaseInboundItem();
            $purchase_inbound_item->purchase_inbound_id = $purchase_inbound_id;
            $purchase_inbound_item->item_id = $item['item_id'];

            $purchase_inbound_item->quantity = $item['quantity'];
            $purchase_inbound_item->unit_price = $item['unit_price'];
            $purchase_inbound_item->sub_total = $item['sub_total'];
            $purchase_inbound_item->vat = $item['vat'];
            $purchase_inbound_item->total = $item['total'];
            $purchase_inbound_item->remarks = array_key_exists("remark", $item) ? $item['remark'] : null;
            $purchase_inbound_item->save();
        }
    }

    /**
     * @param $payload
     * @return void
     */
    public function inbound_to_stock($payload): void
    {
        $inbound_items = $payload['purchase_inbound_items'];
        foreach ($inbound_items as $item) {

            $item_exist = Stock::query()
                ->where('location_id', $payload['location_id'])
                ->where('item_id', $item['item_id'])
                ->first();

            if ($item_exist) {
                $item_exist->quantity += $item['quantity'];
                $item_exist->save();
            } else {
                $inbound_to_stock = new Stock();
                $inbound_to_stock->location_id = $payload['location_id'];
                $inbound_to_stock->item_id = $item['item_id'];
                $inbound_to_stock->quantity = $item['quantity'];
                $inbound_to_stock->save();
            }
        }
    }

    /**
     * @param $payload
     * @return object|null
     * WPIV means [PI => PurchaseInbound, V => with vendor]
     */
    public function findByIdWPIV($payload): object|null
    {
        return PurchaseInbound::query()
            ->with(['purchaseInboundItems.item', 'vendor'])
            ->where('id', $payload)
            ->first();
    }

    /**
     * @param $payload
     * @return mixed
     */
    public function findLatestPurchaseInboundByLocationId($payload): mixed
    {
        return PurchaseInbound::query()
            ->where('location_id', $payload)
            ->latest()->pluck('purchase_inbound_number')->first();
    }
}
