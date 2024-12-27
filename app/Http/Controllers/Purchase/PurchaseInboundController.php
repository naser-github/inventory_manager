<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Enums\PurchaseInboundStatusEnum;
use App\Http\Requests\Purchase\PurchaseInboundStoreRequest;
use App\Http\Services\Purchase\PurchaseInboundService;
use App\Http\Services\setting\ItemService;
use App\Http\Services\setting\LocationService;
use App\Http\Services\setting\VendorService;
use App\Http\Traits\HelperFunctionTrait;
use App\Models\PurchaseInboundStatus;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PurchaseInboundController extends Controller
{
    use HelperFunctionTrait;

    /**
     * @param PurchaseInboundService $purchaseInboundService
     * @return Factory|View|Application
     */
    public function index(PurchaseInboundService $purchaseInboundService): Factory|View|Application
    {
        $purchase_inbounds = $purchaseInboundService->index();

        $purchase_inbound_status_enum = PurchaseInboundStatusEnum::getAllStatus();

        return view('pages.purchase_inbound.index', compact('purchase_inbounds', 'purchase_inbound_status_enum'));
    }

    /**
     * @param ItemService $itemService
     * @param LocationService $locationService
     * @param VendorService $vendorService
     * @return Factory|View|Application
     */
    public function create(ItemService $itemService, LocationService $locationService, VendorService $vendorService): Factory|View|Application
    {
        $items = $itemService->itemList();
        $locations = $locationService->locationList();
        $vendors = $vendorService->vendorList();

        return view('pages.purchase_inbound.create', compact('items', 'locations', 'vendors'));
    }

    /**
     * @param PurchaseInboundStoreRequest $request
     * @param LocationService $locationService
     * @param PurchaseInboundService $purchaseInboundService
     * @return RedirectResponse
     */
    public function store(
        PurchaseInboundStoreRequest $request,
        LocationService             $locationService,
        PurchaseInboundService      $purchaseInboundService
    ): RedirectResponse
    {
        $validateData = $request->validated();

        $location = $locationService->findById($validateData['location_id']);

        if ($location) {
            $latest_purchase_inbound_number = $purchaseInboundService->findLatestPurchaseInboundByLocationId($location->id);

            if ($latest_purchase_inbound_number) {
                $explode = explode('/', $latest_purchase_inbound_number);
                $inbound_serial_number = end($explode);
            } else $inbound_serial_number = 00000;

            $purchase_inbound_number = $this->generate_purchase_inbound_name(
                $inbound_serial_number, $location->name, $validateData['raised_date']
            );

            DB::beginTransaction();
            try {
                $user_id = Auth::id();
                $purchase_inbound = $purchaseInboundService->store($validateData, $purchase_inbound_number, $user_id);
                $purchaseInboundService->storePurchaseInboundItems($validateData['purchase_inbound_items'], $purchase_inbound->id);
                $purchaseInboundService->storePurchaseInboundStatus($purchase_inbound->id, $user_id);

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Process failed try again!!');
            }
        }
        return redirect()->route('purchase_inbound.index')->with('success', 'Inbound Registered');
    }

    public function approve($id, PurchaseInboundService $purchaseInboundService)
    {
        $purchase_inbound = $purchaseInboundService->findById($id);

        if ($purchase_inbound == null) {
            return redirect()->back()->with('error', 'Purchase Inbound Not Found');
        }

        DB::beginTransaction();
        try {
            $purchaseInboundService->inbound_to_stock($purchase_inbound);
            $purchaseInboundService->approvePurchaseInboundStatus($id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to Approve');
        }
        return redirect()->back()->with('success', 'Inbound Approved');
    }

    public function cancel($id, PurchaseInboundService $purchaseInboundService)
    {
        $purchase_inbound = $purchaseInboundService->findById($id);
        if ($purchase_inbound) {
            $purchaseInboundService->cancelPurchaseInboundStatus($id);
            return redirect()->back()->with('success', 'Inbound Cancelled');
        } else {
            return redirect()->back()->with('error', 'No Purchase Inbound Found');
        }
    }

    public function show($id, PurchaseInboundService $purchaseInboundService)
    {
        $purchase_inbound = $purchaseInboundService->findByIdWPIV($id);
        if ($purchase_inbound)
            return view('pages.purchase_inbound.show', compact('purchase_inbound'));
        else
            return redirect()->back()->with('error', 'No Purchase Inbound Found');

    }

    public function destroy($id, PurchaseInboundService $purchaseInboundService)
    {
        $purchase_inbound = collect($purchaseInboundService->findByIdWPI($id));

        $location_id = $purchase_inbound['location_id'];
        $inbound_time = $purchase_inbound['updated_at'];

        DB::beginTransaction();

        try {
            foreach ($purchase_inbound['purchase_inbound_items'] as $item) {
                $is_consumed_already = $purchaseInboundService->consumedAlready($item['item_id'], $location_id, $inbound_time);
                if ($is_consumed_already) {
                    return redirect()->back()->with('error', 'Items are already consumed');
                }
            }
            $purchaseInboundService->stock_to_inbound($purchase_inbound['purchase_inbound_items'], $location_id);
            $purchaseInboundService->destroyInboundItems($id);
            $purchaseInboundService->destroy($id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
        }

        return back()->with('success', 'Inbound Deleted!!');

    }
}
