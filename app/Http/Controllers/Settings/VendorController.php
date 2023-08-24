<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Vendor\VendorStoreRequest;
use App\Http\Requests\Setting\Vendor\VendorUpdateRequest;
use App\Http\Services\setting\VendorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{

    public function index(VendorService $vendorService)
    {
        $vendors = $vendorService->index();

        return view('pages.settings.vendor.index', compact('vendors'));
    }

    /**
     * @param VendorStoreRequest $request
     * @param VendorService $vendorService
     * @return RedirectResponse
     */
    public function store(VendorStoreRequest $request, VendorService $vendorService): RedirectResponse
    {
        $validateData = $request->validated();

        $vendorService->store($validateData);

        Session::flash('success', 'Vendor has been created');
        return back();
    }

    public function edit(Request $request, VendorService $vendorService)
    {
        $vendor = $vendorService->findById($request->id);

        if ($vendor) return view('pages.settings.vendor.edit', compact('vendor'));
        else return back();
    }


    /**
     * @param $id
     * @param VendorUpdateRequest $request
     * @param VendorService $vendorService
     * @return RedirectResponse
     */
    public function update($id, VendorUpdateRequest $request, VendorService $vendorService): RedirectResponse
    {
        $validateData = $request->validated();

        $vendor = $vendorService->findById($id);

        if ($vendor) {
            $vendorService->update($vendor, $validateData);
        }
        Session::flash('success', 'Vendor has been updated');
        return redirect()->back();
    }

    public function destroy($id, VendorService $vendorService)
    {
        $vendorService->destroy($id);
        Session::flash('success', 'Vendor has been deleted');

        return back();
    }
}
