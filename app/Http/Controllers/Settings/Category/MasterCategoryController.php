<?php

namespace App\Http\Controllers\Settings\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Category\MasterCategory\MasterCategoryStoreRequest;
use App\Http\Requests\Setting\Category\MasterCategory\MasterCategoryUpdateRequest;
use App\Http\Services\setting\Category\MasterCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterCategoryController extends Controller
{

    /**
     * @param MasterCategoryService $masterCategoryService
     * @return Factory|View|Application
     */
    public function index(MasterCategoryService $masterCategoryService): Factory|View|Application
    {
        $master_categories = $masterCategoryService->index();

        return view('pages.settings.category.master_category.index', compact('master_categories'));
    }

    /**
     * @param MasterCategoryStoreRequest $request
     * @param MasterCategoryService $masterCategoryService
     * @return RedirectResponse
     */
    public function store(MasterCategoryStoreRequest $request, MasterCategoryService $masterCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $masterCategoryService->store($validateData);

        Session::flash('success', 'Master Category has been created');
        return back();
    }

    /**
     * @param Request $request
     * @param MasterCategoryService $masterCategoryService
     * @return View|Factory|Application|RedirectResponse
     */
    public function edit(Request $request, MasterCategoryService $masterCategoryService): View|Factory|Application|RedirectResponse
    {
        $master_category = $masterCategoryService->findById($request->id);

        if ($master_category) return view('pages.settings.category.master_category.edit', compact('master_category'));
        else return back();
    }

    /**
     * @param $id
     * @param MasterCategoryUpdateRequest $request
     * @param MasterCategoryService $masterCategoryService
     * @return RedirectResponse
     */
    public function update($id, MasterCategoryUpdateRequest $request, MasterCategoryService $masterCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $master_category = $masterCategoryService->findById($id);

        if ($master_category) {
            $masterCategoryService->update($master_category, $validateData);
        }
        Session::flash('success', 'Master Category has been updated');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
