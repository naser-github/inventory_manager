<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\User\UserStoreRequest;
use App\Http\Requests\Setting\User\UserUpdateRequest;
use App\Http\Services\setting\RoleService;
use App\Http\Services\setting\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use function Symfony\Component\String\u;

class UserController extends Controller
{

    /**
     * @param UserService $userService
     * @return Factory|View|Application
     */
    public function index(UserService $userService): Factory|View|Application
    {
        $users = $userService->index();

        return view('pages.settings.user.index', compact('users'));
    }

    /**
     * @param RoleService $roleService
     * @return Factory|View|Application
     */
    public function create(RoleService $roleService): Factory|View|Application
    {
        $roles = $roleService->roleList();

        return view('pages.settings.user.create', compact('roles'));
    }

    /**
     * @param UserStoreRequest $request
     * @param UserService $userService
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request, UserService $userService): RedirectResponse
    {
        $validateData = $request->validated();

        DB::beginTransaction();
        try {
            $user = $userService->store($validateData); // storing user data on the user table

            $userService->storeProfile($user->id, $validateData['phone']); // storing user profile data

            $user->roles()->sync([$validateData['role']]); // syncing user with a role

            DB::commit();
            Session::flash('success', 'User has been created');
            return Redirect::route('users.index');
        } catch (Exception $error) {
            DB::rollback();
            Session::flash('error', 'User creation failed');
            return redirect()->back();
        }
    }


    public function show($id, UserService $userService)
    {
        $user = $userService->findByIdWPR($id);

        if ($user) {
            return view('pages.settings.user.show', compact( 'user'));
        } else {
            Session::flash('error', 'No User Found');
            return redirect()->back();
        }

    }

    /**
     * @param $id
     * @param RoleService $roleService
     * @param UserService $userService
     * @return View|Factory|Application|RedirectResponse
     */
    public function edit($id, RoleService $roleService, UserService $userService): View|Factory|Application|RedirectResponse
    {
        $user = $userService->findByIdWPR($id);

        if ($user) {
            $roles = $roleService->roleList();
            return view('pages.settings.user.edit', compact('roles', 'user'));
        } else {
            Session::flash('error', 'No User Found');
            return redirect()->back();
        }

    }

    /**
     * @param $id
     * @param UserUpdateRequest $request
     * @param UserService $userService
     * @return RedirectResponse
     */
    public function update($id, UserUpdateRequest $request, UserService $userService): RedirectResponse
    {
        $validateData = $request->validated();

        $user = $userService->findById($id);

        if ($user) {
            DB::beginTransaction();
            try {
                $userService->update($user, $validateData);
                $userService->updateProfile($id, $validateData['phone']);
                $user->roles()->sync([$validateData['role']]); // syncing user with a role
                DB::commit();
                Session::flash('success', 'User has been Updated');
                return redirect()->route('users.show', $id);
            } catch (Exception $error) {
                DB::rollback();
            }
        }

        Session::flash('error', 'User update failed');
        return redirect()->back();

    }


//    public function destroy($id)
//    {
//        //
//    }
}
