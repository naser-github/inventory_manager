<?php

namespace App\Http\Controllers\Settings\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Category\LevelOneCategory\LevelOneCategoryUpdateRequest;
use App\Http\Requests\Setting\Category\LevelTwoCategory\LevelTwoCategoryStoreRequest;
use App\Http\Requests\Setting\Category\LevelTwoCategory\LevelTwoCategoryUpdateRequest;
use App\Http\Services\setting\Category\LevelOneCategoryService;
use App\Http\Services\setting\Category\LevelTwoCategoryService;
use App\Http\Services\setting\Category\MasterCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LevelTwoCategoryController extends Controller
{

    /**
     * @param LevelTwoCategoryService $levelTwoCategoryService
     * @return Factory|View|Application
     */
    public function index(LevelTwoCategoryService $levelTwoCategoryService): Factory|View|Application
    {
        $level_two_categories = $levelTwoCategoryService->index();

        return view('pages.settings.category.level_two_category.index', compact('level_two_categories'));
    }

    /**
     * @param LevelOneCategoryService $levelOneCategoryService
     * @param MasterCategoryService $masterCategoryService
     * @return Factory|View|Application
     */
    public function create(
        LevelOneCategoryService $levelOneCategoryService,
        MasterCategoryService   $masterCategoryService
    ): Factory|View|Application
    {
        $master_categories = $masterCategoryService->masterCategoryList();

        $level_one_categories = $levelOneCategoryService->levelOneCategoryList();

        return view('pages.settings.category.level_two_category.create', compact(
            'master_categories', 'level_one_categories'
        ));
    }

    /**
     * @param LevelTwoCategoryStoreRequest $request
     * @param LevelTwoCategoryService $levelTwoCategoryService
     * @return RedirectResponse
     */
    public function store(LevelTwoCategoryStoreRequest $request, LevelTwoCategoryService $levelTwoCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $levelTwoCategoryService->store($validateData);

        Session::flash('success', 'Level Two Category has been created');
        return back();
    }

    /**
     * @param Request $request
     * @param MasterCategoryService $masterCategoryService
     * @param LevelOneCategoryService $levelOneCategoryService
     * @param LevelTwoCategoryService $levelTwoCategoryService
     * @return View|Factory|Application|RedirectResponse
     */
    public function edit(
        Request                 $request,
        MasterCategoryService   $masterCategoryService,
        LevelOneCategoryService $levelOneCategoryService,
        LevelTwoCategoryService $levelTwoCategoryService,
    ): View|Factory|Application|RedirectResponse
    {
        $level_two_category = $levelTwoCategoryService->findById($request->id);

        if ($level_two_category) {
            $master_categories = $masterCategoryService->masterCategoryList();
            $level_one_categories = $levelOneCategoryService->levelOneCategoryList();

            return view('pages.settings.category.level_two_category.edit', compact('master_categories', 'level_one_categories', 'level_two_category'));
        } else return back();
    }

    /**
     * @param $id
     * @param LevelTwoCategoryUpdateRequest $request
     * @param LevelTwoCategoryService $levelTwoCategoryService
     * @return RedirectResponse
     */
    public function update($id, LevelTwoCategoryUpdateRequest $request, LevelTwoCategoryService $levelTwoCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $level_two_category = $levelTwoCategoryService->findById($id);

        if ($level_two_category) {
            $levelTwoCategoryService->update($level_two_category, $validateData);
        }
        Session::flash('success', 'Level Two Category has been updated');
        return redirect()->back();
    }

//    public function destroy($id)
//    {
//        //
//    }
}
