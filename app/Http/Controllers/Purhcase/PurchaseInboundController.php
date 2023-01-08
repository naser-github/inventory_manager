<?php

namespace App\Http\Controllers\Purhcase;

use App\Http\Controllers\Controller;
use App\Http\Services\setting\ItemService;
use App\Http\Services\setting\LocationService;
use App\Http\Services\setting\VendorService;
use Illuminate\Http\Request;

class PurchaseInboundController extends Controller
{
    public function create(ItemService $itemService, LocationService $locationService, VendorService $vendorService)
    {
        $items = $itemService->itemList();
        $locations = $locationService->locationList();
        $vendors = $vendorService->vendorList();

        return [$items,$locations,$vendors];

        return view('pages.purchase_inbound.create', compact('items', 'locations', 'vendors'));
    }
}
