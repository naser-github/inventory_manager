<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Vendor\VendorStoreRequest;
use App\Http\Requests\Setting\Vendor\VendorUpdateRequest;
use App\Http\Services\setting\VendorService;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{

    public function index(VendorService $vendorService)
    {
        $vendors = $vendorService->index();

        return view('pages.settings.vendor.index', compact('vendors'));
    }

    public function create()
    {
        //
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


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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

    public function destroy($id)
    {
        //
    }
}
