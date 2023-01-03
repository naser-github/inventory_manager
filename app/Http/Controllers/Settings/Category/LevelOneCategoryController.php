<?php

namespace App\Http\Controllers\Settings\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Category\LevelOneCategory\LevelOneCategoryStoreRequest;
use App\Http\Requests\Setting\Category\LevelOneCategory\LevelOneCategoryUpdateRequest;
use App\Http\Services\setting\Category\LevelOneCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LevelOneCategoryController extends Controller
{
    /**
     * @param LevelOneCategoryService $levelOneCategoryService
     * @return Factory|View|Application
     */
    public function index(LevelOneCategoryService $levelOneCategoryService): Factory|View|Application
    {
        $level_one_categories = $levelOneCategoryService->index();

        return view('pages.settings.category.level_one_category.index', compact('level_one_categories'));
    }


    /**
     * @param LevelOneCategoryStoreRequest $request
     * @param LevelOneCategoryService $levelOneCategoryService
     * @return RedirectResponse
     */
    public function store(LevelOneCategoryStoreRequest $request, LevelOneCategoryService $levelOneCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $levelOneCategoryService->store($validateData);

        Session::flash('success', 'Level One Category has been created');
        return back();
    }

    /**
     * @param Request $request
     * @param LevelOneCategoryService $levelOneCategoryService
     * @return View|Factory|Application|RedirectResponse
     */
    public function edit(Request $request, LevelOneCategoryService $levelOneCategoryService): View|Factory|Application|RedirectResponse
    {
        $level_one_category = $levelOneCategoryService->findById($request->id);

        if ($level_one_category) return view('pages.settings.category.level_one_category.edit', compact('level_one_category'));
        else return back();
    }

    /**
     * @param $id
     * @param LevelOneCategoryUpdateRequest $request
     * @param LevelOneCategoryService $levelOneCategoryService
     * @return RedirectResponse
     */
    public function update($id, LevelOneCategoryUpdateRequest $request, LevelOneCategoryService $levelOneCategoryService): RedirectResponse
    {
        $validateData = $request->validated();

        $level_one_category = $levelOneCategoryService->findById($id);

        if ($level_one_category) {
            $levelOneCategoryService->update($level_one_category, $validateData);
        }
        Session::flash('success', 'Level One Category has been updated');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
