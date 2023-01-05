<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Location\LocationStoreRequest;
use App\Http\Requests\Setting\Location\LocationUpdateRequest;
use App\Http\Services\setting\LocationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{

    public function index(LocationService $locationService)
    {
        $locations = $locationService->index();

        return view('pages.settings.location.index', compact('locations'));
    }

    public function create()
    {
        //
    }

    /**
     * @param LocationStoreRequest $request
     * @param LocationService $locationService
     * @return RedirectResponse
     */
    public function store(LocationStoreRequest $request, LocationService $locationService): RedirectResponse
    {
        $validateData = $request->validated();

        $locationService->store($validateData);

        Session::flash('success', 'Location has been created');
        return back();
    }

//    public function show($id)
//    {
//        //
//    }

    public function edit(Request $request, LocationService $locationService)
    {
        $location = $locationService->findById($request->id);

        if ($location) return view('pages.settings.location.edit', compact('location'));
        else return back();
    }

    /**
     * @param $id
     * @param LocationUpdateRequest $request
     * @param LocationService $locationService
     * @return RedirectResponse
     */
    public function update($id, LocationUpdateRequest $request, LocationService $locationService): RedirectResponse
    {
        $validateData = $request->validated();

        $location = $locationService->findById($id);

        if ($location) {
            $locationService->update($location, $validateData);
        }
        Session::flash('success', 'Vendor has been updated');
        return redirect()->back();
    }

    public function destroy($id, LocationService $locationService)
    {
//        $locationAlreadyAssign = $locationService->findByIdWR($id);
//
//        if (count($locationAlreadyAssign->roles) > 0)
//            Session::flash('error', 'Permission denied');
//        else {
//            $locationService->destroy($id);
//            Session::flash('success', 'Permission has been deleted');
//        }
//        return back();
    }
}
