<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Role\RoleStoreRequest;
use App\Http\Requests\Setting\Role\RoleUpdateRequest;
use App\Http\Services\setting\PermissionService;
use App\Http\Services\setting\RoleService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{

    /**
     * @param RoleService $roleService
     * @return Factory|View|Application
     */
    public function index(RoleService $roleService): Factory|View|Application
    {
        $roles = $roleService->index();

        return view('pages.settings.role.index', compact('roles'));
    }

    /**
     * @param PermissionService $permissionService
     * @return Factory|View|Application
     */
    public function create(PermissionService $permissionService): Factory|View|Application
    {
        $permissions = $permissionService->permissionList();

        return view('pages.settings.role.create', compact('permissions'));
    }

    /**
     * @param RoleStoreRequest $request
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function store(RoleStoreRequest $request, RoleService $roleService): RedirectResponse
    {
        $validateData = $request->validated();

        DB::beginTransaction();
        try {
            $role = $roleService->store($validateData['name']); // storing user data on the user table

            $role->syncPermissions($validateData['permissions']); // syncing all the permissions to role

            DB::commit();
            Session::flash('success', 'Role has been created');
            return Redirect::route('roles.index');
        } catch (Exception $error) {
            DB::rollback();
            Session::flash('error', 'Role creation failed');
            return redirect()->back();
        }
    }


    public function show($id, RoleService $roleService)
    {
        $role = $roleService->findByIdWP($id);
        return view('pages.settings.role.show', compact('role'));
    }


    /**
     * @param $id
     * @param PermissionService $permissionService
     * @param RoleService $roleService
     * @return View|Factory|Application|RedirectResponse
     */
    public function edit($id, PermissionService $permissionService, RoleService $roleService): View|Factory|Application|RedirectResponse
    {
        $role = $roleService->findByIdWP($id);

        if ($role) {
            $permissions = $permissionService->permissionList();
            return view('pages.settings.role.edit', compact('permissions', 'role'));
        } else {
            Session::flash('error', 'No User Found');
            return redirect()->back();
        }

    }


    /**
     * @param $id
     * @param RoleUpdateRequest $request
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function update($id, RoleUpdateRequest $request, RoleService $roleService): RedirectResponse
    {
        $validateData = $request->validated();

        $role = $roleService->findById($id);

        if ($role) {
            DB::beginTransaction();
            try {
                $roleService->update($role, $validateData['name']);
                $role->syncPermissions($validateData['permissions']); // syncing all the permissions to role

                DB::commit();
                return redirect()->route('roles.show', $id);
            } catch (Exception $error) {
                DB::rollback();
            }
        }
        Session::flash('error', 'Role update failed');
        return redirect()->back();
    }

//    public function destroy($id)
//    {
//        //
//    }
}
