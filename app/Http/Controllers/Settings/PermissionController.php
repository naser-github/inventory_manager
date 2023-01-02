<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Permission\PermissionStoreRequest;
use App\Http\Services\setting\PermissionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{

    /**
     * @param PermissionService $permissionService
     * @return Factory|View|Application
     */
    public function index(PermissionService $permissionService): Factory|View|Application
    {
        $permissions = $permissionService->index();

        return view('pages.settings.permission.index', compact('permissions'));
    }

    /**
     * @param PermissionStoreRequest $request
     * @param PermissionService $permissionService
     * @return RedirectResponse
     */
    public function store(PermissionStoreRequest $request, PermissionService $permissionService): RedirectResponse
    {
        $validateData = $request->validated();

        $permissionService->store($validateData['name']);

        Session::flash('success', 'Permission has been created');
        return back();
    }


    /**
     * @param $id
     * @param PermissionService $permissionService
     * @return RedirectResponse
     */
    public function destroy($id, PermissionService $permissionService): RedirectResponse
    {
        $permissionAlreadyAssign = $permissionService->findByIdWR($id);

        if (count($permissionAlreadyAssign->roles) > 0)
            Session::flash('error', 'Permission denied');
        else {
            $permissionService->destroy($id);
            Session::flash('success', 'Permission has been deleted');
        }
        return back();
    }
}
